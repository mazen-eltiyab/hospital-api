<?php

namespace App\Http\Controllers;
use App\Notifications\NewMedicalReport;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Patient; // هذا السطر يخبر لارافيل أين يجد موديل المرضى
use App\Models\MedicalRecord;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    // 1. عرض قائمة الأطباء مع جلب الخدمات (Eager Loading) والبحث
   // 1. عرض قائمة الأطباء مع جلب الخدمات والبحث الذكي
public function index(Request $request)
{
    /** @var \App\Models\User $user */
    $user = Auth::user();

    if (!$user) {
        return redirect()->route('login');
    }

    $role = strtolower(trim($user->role));

    // 1. إذا كان المستخدم أدمن (هنا يتم تفعيل البحث)
    if ($role == 'admin') {
        // نبدأ بإنشاء الاستعلام مع جلب التخصصات
        $query = Doctor::with('services');

        // أ) البحث بالاسم (الأول أو الأخير)
        if ($request->filled('name')) {
            $searchTerm = $request->name;
            $query->where(function($q) use ($searchTerm) {
                $q->where('firstname', 'like', '%' . $searchTerm . '%')
                  ->orWhere('lastname', 'like', '%' . $searchTerm . '%');
            });
        }

        // ب) البحث بالتخصص (Speciality)
        if ($request->filled('speciality')) {
            $speciality = $request->speciality;
            $query->whereHas('services', function($q) use ($speciality) {
                $q->where('service_name', $speciality);
            });
        }

        // جلب النتائج مرتبة من الأحدث للأقدم
        $doctors = $query->orderBy('id', 'desc')->get();
        
        return view('admin.doctors', compact('doctors'));
    }

    // 2. إذا كان المستخدم دكتور (باقي الكود الخاص بك كما هو)
    if ($role == 'doctor') {
        $doctorData = \App\Models\Doctor::where('email', trim($user->email))->first();
        $finalDoctor = $doctorData ?: $user;

        return view('doctor.index', [
            'user' => $user,
            'doctor' => $finalDoctor,
            'rating' => $finalDoctor->rating ?? 0,
        ]);
    }

    dd("Your role is: " . $user->role . ". Please check your database."); 
}

    // 2. عرض صفحة إضافة دكتور جديد مع تمرير الخدمات
    public function create()
    {
        $services = Service::all(); 
        return view('admin.add-doctor', compact('services'));
    }

    // 3. تخزين بيانات الدكتور والمستخدم وربط الخدمات
    public function store(Request $request)
    {
        $request->validate([
            'firstname'   => 'required|string|max:255',
            'username'    => 'required|unique:doctors,username|unique:users,name',
            'email'       => 'required|email|unique:doctors,email|unique:users,email',
            'password'    => 'required|min:6|confirmed',
            'avatar'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'service_ids' => 'required|array|min:1', 
            'rating'      => 'nullable|numeric|min:0|max:5', // <-- ضفنا التحقق هنا
            'bio' => 'nullable|string|max:1000', // إضافة التحقق من الـ bio
              'salary' => 'nullable|numeric|min:0',
        ]);

        $newDoctor = null;

        DB::transaction(function () use ($request, &$newDoctor) {
            // معالجة الصورة
            $imageName = 'user.jpg';
            if ($request->hasFile('avatar')) {
                $imageName = time() . '.' . $request->avatar->extension();
                $request->avatar->move(public_path('assets/img'), $imageName);
                
            }

            // إنشاء المستخدم للـ Login
            User::create([
                'name'     => $request->username,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'role'     => 'doctor', 
            ]);

            // إنشاء الدكتور
            $newDoctor = Doctor::create([
                'firstname'  => $request->firstname,
                'lastname'   => $request->lastname,
                'username'   => $request->username,
                'email'      => $request->email,
                'password'   => Hash::make($request->password),
                'dob' => $request->filled('dob') ? \Carbon\Carbon::createFromFormat('d/m/Y', $request->dob)->format('Y-m-d') : null,
                'gender'     => $request->gender ?? 'Male',
                'address'    => $request->address,
                'city'       => $request->city,
                'phone'      => $request->phone,
                'avatar'     => $imageName,
                'status'     => ($request->status == 'active' || $request->status == '1') ? 1 : 0,
                'bio'        => $request->bio, // <--- ضيف السطر ده هنا عشان يتسجل
                'rating'     => $request->rating ?? 5.0, // <-- هنا القيمة اللي إنت بتحددها كأدمن
                'salary'     => $request->salary ?? 250.00, // <-- أضف هذا السطر

            ]);

            // ربط الدكتور بالخدمات في الجدول الوسيط
            $newDoctor->services()->attach($request->service_ids);
        });

        return redirect()->route('admin.doctors')->with('success', 'Doctor created successfully!');
    }

    // 4. عرض صفحة التعديل مع تمرير الخدمات
    public function edit($id) {
    $doctor = Doctor::with('services')->findOrFail($id);
    $services = Service::all(); // تأكد من استدعاء موديل Service في الأعلى
    return view('admin.edit-doctor', compact('doctor', 'services'));
}

    // 5. تحديث بيانات الدكتور والخدمات
 public function update(Request $request, $id) {
    // 1. جلب بيانات الدكتور
    $doctor = Doctor::findOrFail($id);

    // 2. تحديث البيانات الأساسية
    $doctor->update([
        'firstname' => $request->firstname,
        'lastname'  => $request->lastname,
        'email'     => $request->email,
        'phone'     => $request->phone,
        'gender'    => $request->gender ?? 'Male',
        'address'   => $request->address,
        'city'      => $request->city,
        'country'   => $request->country,
        'speciality'=> $request->speciality,
        'bio'       => $request->bio,
       'rating'    => $request->rating ?? $doctor->rating ?? 0, // السطر المعدل
        'status'    => $request->status,
        'salary'    => $request->salary ?? $doctor->salary ?? 250.00, // <-- أضف هذا السطر
    ]);

    // 3. تحديث كلمة المرور فقط إذا تم إدخالها
    if ($request->filled('password')) {
        $doctor->update(['password' => Hash::make($request->password)]);
    }

    // 4. معالجة التاريخ (تذكر مشكلة الـ Carbon السابقة)
    if ($request->filled('dob')) {
        try {
            $doctor->dob = \Carbon\Carbon::createFromFormat('Y-m-d', $request->dob)->format('Y-m-d');
            $doctor->save();
        } catch (\Exception $e) {
            // لو التاريخ جاي بصيغة مختلفة d/m/Y
            $doctor->dob = \Carbon\Carbon::parse($request->dob)->format('Y-m-d');
            $doctor->save();
        }
    }

    // 5. تحديث الصورة (Avatar) إذا رفعت صورة جديدة
    if ($request->hasFile('avatar')) {
        $imageName = time().'.'.$request->avatar->extension();  
        $request->avatar->move(public_path('assets/img'), $imageName);
        $doctor->update(['avatar' => $imageName]);
    }

    // 6. تحديث الخدمات (الجدول الوسيط) - دي أهم خطوة للربط
    $doctor->services()->sync($request->service_ids);

    return redirect()->route('admin.doctors')->with('success', 'Doctor updated successfully');
}

    public function destroy(Doctor $doctor)
    {
        DB::transaction(function () use ($doctor) {
            User::where('email', $doctor->email)->delete();
            $doctor->services()->detach(); // حذف الروابط في الجدول الوسيط أولاً
            $doctor->delete();
        });
        return redirect()->route('admin.doctors');
    }

    private function getUserIdByEmail($email) {
        $user = User::where('email', $email)->first();
        return $user ? $user->id : 0;
    }



   public function addReport($id)
{
    $patient = Patient::findOrFail($id); 
    
    // التأكد أن الذي يحاول إضافة التقرير هو دكتور مسجل
    $doctor = Doctor::where('email', Auth::user()->email)->first();
    
    if (!$doctor) {
        return redirect()->back()->with('error', 'غير مسموح لك بالدخول لهذه الصفحة.');
    }

    return view('doctor.add-report', compact('patient', 'doctor'));
}





public function storeReport(Request $request, $id)
{
    $request->validate([
        'appointment_id' => 'required', // ضروري جداً لربط التقرير بالزيارة
        'medical_report' => 'required|string', 
        'report_file'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $doctorUser = Auth::user();
    $doctor = \App\Models\Doctor::where('email', $doctorUser->email)->first();
    if (!$doctor) {
        return redirect()->back()->with('error', 'Doctor record not found.');
    }

    $doctorRealId = $doctor->id; 

    // البحث عن تقرير مرتبط بهذا الموعد (Appointment) تحديداً
    // هذا يمنع تداخل التقارير لو المريض له أكثر من كشف
    $report = \App\Models\MedicalReport::where('appointment_id', $request->appointment_id)
                                       ->first();

    $data = [
        'report_content' => $request->medical_report,
        'patient_id'     => $id,
        'doctor_id'      => $doctorRealId,
        'appointment_id' => $request->appointment_id, // حفظ رقم الموعد
    ];

    if ($request->hasFile('report_file')) {
        $imageName = time() . '.' . $request->report_file->extension();
        $request->report_file->move(public_path('assets/img/reports'), $imageName);
        $data['file_path'] = 'assets/img/reports/' . $imageName; 
    }

    if ($report) {
        // إذا وجد تقرير لنفس الموعد، نقوم بتحديثه
        $report->update($data);
        $isUpdate = true;
    } else {
        // إذا لم يجد، ننشئ تقرير جديد لهذه الزيارة
        \App\Models\MedicalReport::create($data);
        $isUpdate = false;
        // إرسال التنبيه للمريض (بطريقة متوافقة مع تطبيق الموبايل API)
        $patientData = \App\Models\Patient::find($id);
        if ($patientData) {
            $notificationId = \Illuminate\Support\Str::uuid()->toString();
            \Illuminate\Support\Facades\DB::table('notifications')->insert([
                'id' => $notificationId,
                'type' => 'App\Notifications\NewMedicalReport',
                'notifiable_type' => 'App\Models\Patient',
                'notifiable_id' => $patientData->id,
                'data' => json_encode([
                    'title' => $isUpdate ? 'تعديل في التقرير الطبي' : 'تقرير طبي جديد',
                    'message' => $isUpdate ? 'قام الطبيب بتحديث بيانات تقريرك الطبي.' : 'قام الطبيب بإضافة تقرير طبي جديد لملفك.',
                    'doctor_id' => $doctor ? $doctor->id : null,
                    'doctor_name' => $doctor ? $doctor->firstname . ' ' . $doctor->lastname : 'Doctor',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    return redirect()->route('doctor.patients')->with('success', $isUpdate ? 'تم تحديث التقرير بنجاح!' : 'تم إضافة تقرير جديد!');
}



// دالة لعرض الدكاترة للمرضى (الصفحة الجديدة)
// دالة لعرض الدكاترة للمرضى (الصفحة الجديدة)
public function patientDoctors(Request $request)
{
    $query = Doctor::with('services');

    // 1. منطق البحث الموحد (الاسم)
    if ($request->filled('name')) {
        $searchTerm = $request->name;
        $query->where(function($q) use ($searchTerm) {
            $q->where('firstname', 'like', '%' . $searchTerm . '%')
              ->orWhere('lastname', 'like', '%' . $searchTerm . '%')
              ->orWhereRaw("CONCAT(firstname, ' ', lastname) LIKE ?", ['%' . $searchTerm . '%']);
        });
    }

    // 2. إضافة البحث بالتخصص للمريض أيضاً (اختياري)
    if ($request->filled('speciality')) {
        $query->whereHas('services', function($q) use ($request) {
            $q->where('service_name', $request->speciality);

        });
    }

    $doctors = $query->orderBy('firstname', 'asc')->get();

    // 3. عرض الصفحة
    return view('patient.patient_doctors', compact('doctors')); 
}
















    // أضف هذه الدالة بدقة:
public function editProfile()
{
    // 1. جلب إيميل المستخدم الحالي بطريقة مباشرة (المحرر بيفهم auth()->id() و Auth::id())
    $userEmail = \Illuminate\Support\Facades\Auth::user()->email;

    // 2. البحث في جدول الـ doctors باستخدام هذا الإيميل
    // استخدمنا المسار الكامل للموديل عشان Intelephense يشوفه صح
    $doctor = \App\Models\Doctor::with('services')->where('email', $userEmail)->first();

    // 3. التحقق لو الدكتور مش موجود
    if (!$doctor) {
        return redirect()->back()->with('error', 'تعذر العثور على بيانات الطبيب.');
    }

    // 4. جلب الخدمات
    $services = \App\Models\Service::all(); 

    // 5. إرسال البيانات للـ View
    return view('doctor.edit-profile_doctor', compact('doctor', 'services'));
}

    // دالة التحديث (Update)
// تم حذف $id من الباراميترز لأننا سنحدث بروفايل المستخدم الحالي
 // تأكد من إضافة هذا السطر في أعلى الملف

public function updateProfile(Request $request) 
{
    /** @var \App\Models\User $user */
    $user = \Illuminate\Support\Facades\Auth::user();
    $doctor = \App\Models\Doctor::where('email', $user->email)->firstOrFail();

    // مصفوفة البيانات الأساسية
    $data = [
        'firstname' => $request->firstname,
        'lastname'  => $request->lastname,
        'email'     => $request->email ?? $user->email,
        'phone'     => $request->phone,
        'address'   => $request->address,
        'bio'       => $request->bio, // ضيف السطر ده هنا كمان
        'dob'       => $request->dob ? \Carbon\Carbon::parse($request->dob)->format('Y-m-d') : null,
    ];

    // --- منطق رفع الصورة ---
    if ($request->hasFile('avatar')) {
        $file = $request->file('avatar');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        // نقل الملف لمجلد assets/img الموجود في public
        $file->move(public_path('assets/img'), $filename);
        
        // إضافة اسم الملف الجديد للمصفوفة لتحديثه في قاعدة البيانات
        $data['avatar'] = $filename;
    }

    // تحديث بيانات الدكتور
    $doctor->update($data);

    // تحديث جدول الـ User
    $user->update([
        'name'  => $request->firstname,
        'email' => $request->email ?? $user->email
    ]);

   return redirect()->route('doctor.profile.show')->with('success', 'Profile updated successfully!');
}




public function showProfile() 
{
    /** @var \App\Models\User $user */
    $user = \Illuminate\Support\Facades\Auth::user();
    
    $doctor = \App\Models\Doctor::with('services')
                ->where('email', $user->email)
                ->firstOrFail();
    
    // جلب التقييمات الخاصة بهذا الطبيب مع بيانات المريض
    $ratings = \App\Models\Rating::with('patient')->where('doctor_id', $doctor->id)->orderBy('created_at', 'desc')->get();
    
    return view('doctor.my-profile', compact('doctor', 'ratings'));
}



public function rateDoctor(Request $request, $id)
{
    $request->validate([
        'stars' => 'required|integer|min:1|max:5',
    ]);

    $doctor = Doctor::findOrFail($id);
    $oldRating = $doctor->rating > 0 ? $doctor->rating : $request->stars;
    $newAverage = ($oldRating + $request->stars) / 2;
    $doctor->rating = number_format($newAverage, 1);
    $doctor->save();

    return response()->json([
        'new_rating' => $doctor->rating
    ]);
}
































public function doctorPatients() // تأكد من اسم الدالة في ملف الـ routes
{
    // 1. جلب بيانات الدكتور الحالي
    $doctor = \App\Models\Doctor::where('email', Auth::user()->email)->first();

    if (!$doctor) {
        return redirect()->back()->with('error', 'بيانات الطبيب غير موجودة.');
    }

    // 2. جلب المواعيد المؤكدة (confirmed) فقط لهذا الدكتور
    // مع جلب بيانات المريض والتقارير المرتبطة (Eager Loading)
    $appointments = \App\Models\Appointment::with(['patient', 'medicalReport'])
        ->where('doctor_id', $doctor->id)
        ->where('status', 'confirmed') // هنا الشرط اللي بيخليها تظهر بعد الـ Confirm
        ->orderBy('appointment_date', 'desc')
        ->get();

    return view('doctor.patients', compact('appointments'));
}



















public function editReport($id)
{
    $report = \App\Models\MedicalReport::findOrFail($id);
    $patient = \App\Models\Patient::findOrFail($report->patient_id);
    return view('doctor.edit_report', compact('report', 'patient'));
}

public function updateReport(Request $request, $id)
{
    $report = \App\Models\MedicalReport::findOrFail($id);
    
    $report->report_content = $request->medical_report;
    
    if ($request->hasFile('report_file')) {
        $file = $request->file('report_file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('assets/img/reports'), $filename);
        $report->file_path = 'assets/img/reports/' . $filename;
    }
    
    $report->save();
    
    return redirect()->route('doctor.patients')->with('success', 'Report updated successfully.');
}

}
