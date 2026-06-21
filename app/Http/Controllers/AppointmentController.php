<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Appointment; 
use App\Models\Doctor;      
use App\Models\Patient;
use App\Models\Service; 
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AppointmentController extends Controller
{
    /**
     * عرض قائمة المواعيد
     */
public function index()
{
    $user = Auth::user();

    // 1. لو دكتور: يعرض مواعيده فقط
    if ($user->role === 'doctor') {
        $doctor = Doctor::where('email', $user->email)->first();
        if (!$doctor) return back()->with('error', 'بيانات الطبيب غير موجودة.');

        $appointments = Appointment::where('doctor_id', $doctor->id)
    ->orderBy('id', 'asc') // التعديل هنا: asc بدل desc أو بدل التاريخ
    ->get();
        return view('doctor.appointments', compact('appointments'));
    }

    // 2. لو مريض: يعرض مواعيده الشخصية + (تصفير التنبيهات)
    if ($user->role === 'patient') {
        
        // --- السطر الجديد هنا ---
        // تحويل كل تنبيهات المريض غير المقروءة إلى "مقروءة" بمجرد دخول الصفحة
        $user->unreadNotifications->markAsRead();
        // -----------------------

        $patient = Patient::where('user_id', $user->id)->first();
        if (!$patient) return back()->with('error', 'بيانات المريض غير موجودة.');

        $appointments = Appointment::with('doctor') 
      ->where('patient_id', $patient->id)
               ->orderBy('appointment_date', 'desc')
             ->get();

        return view('patient.appointments_patient', compact('appointments'));
    }

    // 3. لو آدمن: يشوف كل حاجة
    // لو عايز الأدمن كمان يشوف الجديد تحت خالص، عدلها كدا:
$appointments = Appointment::with(['doctor', 'patient'])->orderBy('id', 'asc')->get();
    return view('admin.appointments', compact('appointments'));
}

    /**
     * فتح صفحة إضافة موعد جديد (للمريض والآدمن)
     */
  public function create(Request $request, $doctor_id = null)
{
    $services = Service::where('status', 'active')->get(); 
    $patients = Patient::all();

    // السطرين دول هم السر
    $preSelectedDoctor = null; //ده متغير ة اديتله نلل
    if ($doctor_id) {
        $preSelectedDoctor = Doctor::with('services')->find($doctor_id);
    }

    if (Auth::user()->role === 'patient') {
        return view('patient.book_appointments', compact('services', 'preSelectedDoctor'));
    }

    return view('admin.add-appointment', compact('patients', 'services'));
}









/**
 * عرض صفحة حجز المريض
 */
public function bookAppointment()
{
    $services = Service::where('status', 'active')->get();
    return view('patient.book_appointments', compact('services'));
}

/**
 * عرض صفحة حجز الأدمن/الدكتور
 */
public function addAppointment()
{
    $services = Service::where('status', 'active')->get();

    if (Auth::user()->role === 'doctor') {
        $doctor = Doctor::where('email', Auth::user()->email)->first();
        // يمكن فلترة المرضى حسب الدكتور إذا أردت
        $patients = Patient::all(); // أو Patient::where('doctor_id', $doctor->id)->get();
        return view('doctor.doc_add_appoiment', compact('services', 'patients'));
    }

    // للأدمن
    $patients = Patient::all();
    return view('admin.add-appointment', compact('patients', 'services'));
}


















    /**
     * جلب الأطباء بناءً على الخدمة (AJAX)
     */
    public function getDoctorsByService(Request $request)
    {
        $service = Service::find($request->service_id);
        if (!$service) return response()->json([]);

        $doctors = $service->doctors()->select('doctors.id', 'firstname', 'lastname')->get();
        return response()->json($doctors);
    }

    /**
     * جلب المواعيد المتاحة (AJAX)
     */
public function getAvailableSlots(Request $request)
{
    try {
        $date = \Carbon\Carbon::parse($request->date)->format('Y-m-d');
        $doctorId = $request->doctor_id;
       $today = \Carbon\Carbon::today('Africa/Cairo')->format('Y-m-d');
        $now = \Carbon\Carbon::now('Africa/Cairo'); // الوقت الحالي

        // 1. قائمة المواعيد الثابتة
        $allSlots = [
            '09:00 AM', '10:00 AM', '11:00 AM', '12:00 PM', 
            '01:00 PM', '02:00 PM', '03:00 PM', '04:00 PM'
            ,'05:00 PM', '06:00 PM', '07:00 PM', '08:00 PM'
        ];

        // 2. جلب المواعيد المحجوزة مسبقاً من قاعدة البيانات
        $bookedSlots = \App\Models\Appointment::where('doctor_id', $doctorId)
            ->whereDate('appointment_date', $date)
            ->whereIn('status', ['pending', 'confirmed'])
            ->pluck('start_time')
            ->map(function($time) {
                return \Carbon\Carbon::parse($time)->format('h:i A');
            })
            ->toArray();

        // 3. فلترة المواعيد
        $availableSlots = array_values(array_filter($allSlots, function($slot) use ($bookedSlots, $date, $today, $now) {
            
            // أولاً: التأكد أن الموعد غير محجوز
            if (in_array($slot, $bookedSlots)) {
                return false;
            }

            // ثانياً: إذا كان التاريخ هو "اليوم"، نتحقق أن الساعة لم تمر بعد
            if ($date === $today) {
                $slotTime = \Carbon\Carbon::parse($date . ' ' . $slot);
                // إذا كان وقت الموعد أصغر من وقتنا الحالي، نستبعده
                if ($slotTime->isBefore($now)) {
                    return false;
                }
            }

            return true;
        }));

        return response()->json($availableSlots);

    } catch (\Exception $e) {
        \Log::error("Slots Error: " . $e->getMessage());
        return response()->json([]);
    }
}

    /**
     * حفظ الموعد
     */
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id'        => 'required|exists:doctors,id',
            'appointment_date' => 'required|date|after_or_equal:today', 


            'start_time'       => 'required',
            'service_id'       => 'required|exists:services,id', 
        ]);

        try {
            DB::beginTransaction();

            // تحديد المريض: لو مريض  ياخد بياناته من اليوزر، لو آدمن ياخد الـ ID المختار
            if (Auth::user()->role === 'patient') {
                $patientRecord = Patient::where('user_id', Auth::user()->id)->first();
            } else {
                $patientRecord = Patient::find($request->patient_id);
            }

            if (!$patientRecord) {
                return back()->with('error', 'بيانات المريض غير مكتملة.');
            }

            $service = Service::find($request->service_id);
            $doctor = Doctor::find($request->doctor_id);
            
            $formattedDate = Carbon::parse($request->appointment_date)->format('Y-m-d');
            $formattedTime = Carbon::parse($request->start_time)->format('H:i:s');

            // فحص التكرار
            $isBooked = Appointment::where('doctor_id', $request->doctor_id)
                ->where('appointment_date', $formattedDate)
                ->where('start_time', $formattedTime)
                ->where('status', '!=', 'cancelled')
                ->exists();

            if ($isBooked) {
                return back()->with('error', 'نعتذر، هذا الموعد محجوز مسبقاً.');
            }

            Appointment::create([
                'doctor_id'        => $request->doctor_id,
                'doctor_name'      => $doctor->firstname . ' ' . $doctor->lastname,
                'patient_id'       => $patientRecord->id,
                'patient_name'     => $patientRecord->firstname . ' ' . $patientRecord->lastname,
                'appointment_date' => $formattedDate,
                'start_time'       => $formattedTime,
                'department'       => $service->service_name,
                'service_id'       => $request->service_id,
                'status'           => Auth::user()->role === 'patient' ? 'pending' : ($request->status ?? 'pending'),
            ]);

            DB::commit();
            // التوجيه الذكي بناءً على دور المستخدم
            if (Auth::user()->role === 'patient') {
                return redirect()->route('patient.appointments_patient')
                                 ->with('success', 'تم حجز موعدك بنجاح، يمكنك متابعته من هنا.');
            }



            return redirect()->route('appointments.index')->with('success', 'تم حجز الموعد بنجاح.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'حدث خطأ: ' . $e->getMessage());
        }
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:appointments,id',
            'status' => 'required|in:pending,confirmed,cancelled'
        ]);

        $appointment = Appointment::find($request->id);
        if ($appointment) {
            $appointment->status = $request->status;
            $appointment->save();
            return response()->json(['message' => 'Status updated successfully!']);
        }
        return response()->json(['message' => 'Appointment not found!'], 404);
    }



    public function destroy($id)
{
    $appointment = Appointment::find($id);

    if ($appointment) {
        $appointment->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }

    return response()->json(['message' => 'Not found'], 404);
}
}