<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class ChatbotController extends Controller
{
    public function handleChat(Request $request)
    {
        try {
            $userMessage = trim($request->input('message', ''));
            $patientId = Auth::id() ?? $request->input('patient_id', 1);

            // 1. جلب التخصصات النشطة
            $services = Service::where('status', 'active')->pluck('service_name', 'id')->toArray();
            $availableServicesStr = count($services) > 0 ? implode(' - ', $services) : "العيادات الخارجية";

            // 2. طلب AJAX لجلب الساعات المتاحة (يستخدمه التقويم لعرض الساعات فوراً)
            if ($request->has('check_date')) {
                $requestedDate = $request->input('check_date');
                $selectedDoctorId = $request->input('doctor_id') ?? Session::get('chatbot_doctor_id');
                
                Session::put('chatbot_date', $requestedDate);
                if ($selectedDoctorId) {
                    Session::put('chatbot_doctor_id', $selectedDoctorId);
                }
                $serviceId = $request->input('service_id') ?? Session::get('chatbot_service_id');
                if ($serviceId) {
                    Session::put('chatbot_service_id', $serviceId);
                }

                $slots = $this->fetchAvailableSlots($selectedDoctorId, $requestedDate);

                if (empty($slots)) {
                    return response()->json([
                        'reply' => "⚠️ لا توجد مواعيد متاحة في هذا اليوم. يرجى اختيار تاريخ آخر.",
                        'status' => 'pending',
                        'show_date_picker' => true,
                        'doctor_id' => $selectedDoctorId,
                        'service_id' => $serviceId
                    ]);
                }

                $slotsList = implode(' - ', $slots);
                $reply = "✅ تم اختيار تاريخ {$requestedDate}. الساعات المتاحة:\n[ {$slotsList} ]\n\nيرجى كتابة الساعة التي تريدها (مثل 10:00 AM) أو اختر من الأزرار أدناه.";
                
                return response()->json([
                    'reply' => $reply,
                    'status' => 'pending',
                    'step' => 'time',
                    'doctor_id' => $selectedDoctorId,
                    'service_id' => $serviceId,
                    'date' => $requestedDate,
                    'slots' => $slots
                ]);
            }

            // 3. استرجاع بيانات الحجز من الجلسة
            $chosenServiceId = Session::get('chatbot_service_id', $request->input('service_id'));
            $chosenDoctorId   = Session::get('chatbot_doctor_id', $request->input('doctor_id'));
            $chosenDate       = Session::get('chatbot_date', $request->input('selected_date'));

            // 4. التعرف على اختيار الساعة
            if (preg_match('/\b(AM|PM)\b/i', $userMessage)) {
                $missing = [];
                if (!$chosenServiceId) $missing[] = 'التخصص';
                if (!$chosenDoctorId) $missing[] = 'الدكتور';
                if (!$chosenDate) $missing[] = 'التاريخ';

                if (!empty($missing)) {
                    $reply = "❌ لم تكتمل بيانات الحجز، الرجاء اختيار: " . implode('، ', $missing) . ".";
                    if (in_array('التاريخ', $missing)) {
                        $reply .= "\nيرجى اختيار تاريخ من التقويم أدناه.";
                        return response()->json([
                            'reply' => $reply,
                            'status' => 'pending',
                            'show_date_picker' => true,
                            'doctor_id' => $chosenDoctorId,
                            'service_id' => $chosenServiceId
                        ]);
                    }
                    return response()->json(['reply' => $reply, 'status' => 'pending']);
                }

                // حفظ الموعد
                try {
                    $appointmentController = app(\App\Http\Controllers\AppointmentController::class);
                    $fakeRequest = Request::create(route('appointments.store'), 'POST', [
                        'patient_id'       => $patientId,
                        'service_id'       => $chosenServiceId,
                        'doctor_id'        => $chosenDoctorId,
                        'appointment_date' => $chosenDate,
                        'start_time'       => $userMessage,
                    ]);
                    $appointmentController->store($fakeRequest);

                    Session::forget(['chatbot_service_id', 'chatbot_doctor_id', 'chatbot_date']);

                    return response()->json([
                        'reply' => "🎉 **تم تسجيل الحجز بنجاح!** الموعد يوم {$chosenDate} الساعة {$userMessage}. نتمنى لك الشفاء العاجل!",
                        'status' => 'success'
                    ]);
                } catch (\Exception $e) {
                    Log::error('Booking Error: ' . $e->getMessage());
                    return response()->json([
                        'reply' => "⚠️ حدث خطأ أثناء الحجز: " . $e->getMessage(),
                        'status' => 'error'
                    ]);
                }
            }

            // 5. التعرف على التاريخ
            $selectedDate = $request->input('selected_date');
            if (!$selectedDate && preg_match('/^\d{4}-\d{2}-\d{2}$/', $userMessage)) {
                $selectedDate = $userMessage;
            }

            if ($selectedDate) {
                if (!$chosenDoctorId) {
                    return response()->json([
                        'reply' => "❌ يرجى اختيار الدكتور أولاً قبل تحديد التاريخ.",
                        'status' => 'pending'
                    ]);
                }
                if (!$chosenServiceId) {
                    return response()->json([
                        'reply' => "❌ يرجى اختيار التخصص أولاً.",
                        'status' => 'pending'
                    ]);
                }

                Session::put('chatbot_date', $selectedDate);
                $slots = $this->fetchAvailableSlots($chosenDoctorId, $selectedDate);

                if (empty($slots)) {
                    return response()->json([
                        'reply' => "⚠️ لا توجد مواعيد متاحة في هذا اليوم. يرجى اختيار تاريخ آخر.",
                        'status' => 'pending',
                        'show_date_picker' => true,
                        'doctor_id' => $chosenDoctorId,
                        'service_id' => $chosenServiceId
                    ]);
                }

                $slotsList = implode(' - ', $slots);
                $reply = "✅ تم اختيار تاريخ {$selectedDate}. الساعات المتاحة:\n[ {$slotsList} ]\n\nيرجى كتابة الساعة التي تريدها (مثل 10:00 AM) أو اختر من الأزرار أدناه.";
                return response()->json([
                    'reply' => $reply,
                    'status' => 'pending',
                    'step' => 'time',
                    'doctor_id' => $chosenDoctorId,
                    'service_id' => $chosenServiceId,
                    'date' => $selectedDate,
                    'slots' => $slots
                ]);
            }

            // 6. اختيار التخصص
            $selectedServiceId = null;
            $selectedServiceName = '';
            foreach ($services as $id => $name) {
                if (mb_strpos(mb_strtolower($userMessage), mb_strtolower($name)) !== false ||
                    mb_strpos(mb_strtolower($name), mb_strtolower($userMessage)) !== false) {
                    $selectedServiceId = $id;
                    $selectedServiceName = $name;
                    break;
                }
            }

            if (in_array(mb_strtolower($userMessage), ['أهلاً', 'هيلو', 'عايز احجز', 'اهلاً', 'سلام', 'hello', 'hi', 'start'])) {
                Session::forget(['chatbot_service_id', 'chatbot_doctor_id', 'chatbot_date']);
                $reply = "أهلاً بك في مساعد مستشفى MediCare! 🌟\nالتخصصات المتاحة:\n[ {$availableServicesStr} ]\n\nيرجى اختيار التخصص المطلوب.";
                return response()->json(['reply' => $reply, 'status' => 'pending']);
            }

            if ($selectedServiceId) {
                Session::put('chatbot_service_id', $selectedServiceId);
                $doctorsList = [];
                $serviceModel = Service::find($selectedServiceId);
                if ($serviceModel) {
                    $associatedDoctors = $serviceModel->doctors()->select('doctors.id', 'firstname', 'lastname')->get();
                    foreach ($associatedDoctors as $doc) {
                        $doctorsList[] = "د. " . $doc->firstname . " " . $doc->lastname . " (ID:" . $doc->id . ")";
                    }
                }
                if (count($doctorsList) == 0) {
                    $allDoctors = Doctor::select('id', 'firstname', 'lastname')->get();
                    foreach ($allDoctors as $doc) {
                        $doctorsList[] = "د. " . $doc->firstname . " " . $doc->lastname . " (ID:" . $doc->id . ")";
                    }
                }
                if (count($doctorsList) > 0) {
                    $docsListStr = implode(' - ', $doctorsList);
                    $reply = "✅ اخترت قسم ({$selectedServiceName}). يرجى اختيار الدكتور من القائمة:\n[ {$docsListStr} ]";
                    return response()->json([
                        'reply' => $reply,
                        'status' => 'pending',
                        'service_id' => $selectedServiceId,
                        'doctors' => $doctorsList
                    ]);
                } else {
                    $reply = "⚠️ لا يوجد أطباء مسجلون في هذا التخصص حالياً.";
                    return response()->json(['reply' => $reply, 'status' => 'pending']);
                }
            }

            // 7. اختيار الدكتور
            if (str_starts_with($userMessage, 'د. ') || preg_match('/\(ID:\s*(\d+)\)/', $userMessage, $matches)) {
                $doctorId = null;
                if (preg_match('/\(ID:\s*(\d+)\)/', $userMessage, $matches)) {
                    $doctorId = $matches[1];
                } else {
                    $namePart = str_replace('د. ', '', $userMessage);
                    $doctor = Doctor::whereRaw("CONCAT(firstname, ' ', lastname) LIKE ?", ["%{$namePart}%"])->first();
                    if ($doctor) {
                        $doctorId = $doctor->id;
                    }
                }
                if ($doctorId) {
                    Session::put('chatbot_doctor_id', $doctorId);
                    return response()->json([
                        'reply' => "✅ تم اختيار الدكتور. الرجاء اختيار التاريخ المناسب من التقويم أدناه:",
                        'status' => 'pending',
                        'step' => 'date',
                        'show_date_picker' => true,
                        'doctor_id' => $doctorId,
                        'service_id' => Session::get('chatbot_service_id')
                    ]);
                } else {
                    return response()->json([
                        'reply' => "❌ لم نتمكن من التعرف على الدكتور. يرجى اختياره من القائمة أعلاه.",
                        'status' => 'pending'
                    ]);
                }
            }

            $reply = "عذراً، لم أفهم طلبك. يرجى اختيار تخصص من القائمة:\n[ {$availableServicesStr} ]";
            return response()->json(['reply' => $reply, 'status' => 'pending']);

        } catch (\Exception $e) {
            Log::error('Chatbot Error: ' . $e->getMessage());
            return response()->json([
                'reply' => '⚙️ حدث خطأ في السيرفر، يرجى المحاولة لاحقاً.',
                'status' => 'error'
            ]);
        }
    }

    /**
     * جلب الساعات المتاحة بنفس منطق AppointmentController@getAvailableSlots
     * لضمان عدم ظهور الساعات المحجوزة أو الماضية
     */
    private function fetchAvailableSlots($doctorId, $date)
    {
        try {
            $date = Carbon::parse($date)->format('Y-m-d');
            $today = Carbon::today('Africa/Cairo')->format('Y-m-d');
            $now = Carbon::now('Africa/Cairo');

            // قائمة الساعات الثابتة (نفس القائمة في AppointmentController)
            $allSlots = [
                '09:00 AM', '10:00 AM', '11:00 AM', '12:00 PM',
                '01:00 PM', '02:00 PM', '03:00 PM', '04:00 PM',
                '05:00 PM', '06:00 PM', '07:00 PM', '08:00 PM'
            ];

            // جلب المواعيد المحجوزة (pending أو confirmed) لهذا اليوم
            $bookedSlots = Appointment::where('doctor_id', $doctorId)
                ->whereDate('appointment_date', $date)
                ->whereIn('status', ['pending', 'confirmed'])
                ->pluck('start_time')
                ->map(function ($time) {
                    return Carbon::parse($time)->format('h:i A');
                })
                ->toArray();

            // فلترة الساعات المتاحة (استبعاد المحجوزة والماضية)
            $availableSlots = array_values(array_filter($allSlots, function ($slot) use ($bookedSlots, $date, $today, $now) {
                // استبعاد إذا كانت محجوزة
                if (in_array($slot, $bookedSlots)) {
                    return false;
                }
                // استبعاد إذا كان التاريخ اليوم والساعة مضت
                if ($date === $today) {
                    $slotTime = Carbon::parse($date . ' ' . $slot);
                    if ($slotTime->isBefore($now)) {
                        return false;
                    }
                }
                return true;
            }));

            return $availableSlots;

        } catch (\Exception $e) {
            Log::error("Slots Error: " . $e->getMessage());
            return [];
        }
    }
}