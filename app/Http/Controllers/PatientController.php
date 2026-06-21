<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use App\Models\Patient;
use App\Models\User;
use App\Models\Doctor;
use App\Models\MedicalReport; // تأكد من استيراد موديل التقارير
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File; 
use Carbon\Carbon;

class PatientController extends Controller
{

    public function adminIndex()
{
    // جلب جميع المرضى مع علاقاتهم (المستخدم والتقارير)
    // التقارير مرتبة بحيث يظهر آخر تقرير مضاف
   $patients = Patient::with(['user', 'medicalReports' => function($query) {
    $query->latest();
}])->get();

    return view('admin.patients', compact('patients'));
}

    public function index()
    {
        $user = Auth::user();
        if (!$user) return redirect()->route('login');

        // التعديل هنا: جلب المريض مع تقاريره، وكل تقرير يجلب الدكتور الخاص به "فقط"
        $patient = Patient::with(['medicalReports' => function($query) {
                        $query->with('doctor'); // جلب دكتور التقرير
                    }])
                    ->where('email', $user->email)
                    ->first();

        if (!$patient) {
            return redirect()->back()->with('error', 'Medical record not found');
        }

        return view('patient.medical_reports', compact('patient'));
    }

public function edit($id)
{
    $patient = Patient::findOrFail($id);
    $doctors = Doctor::all();

    $view = (Auth::user()->role === 'doctor') ? 'doctor.edit-patient' : 'admin.edit-patients';
    return view($view, compact('patient', 'doctors'));
}

    public function update(Request $request, $id)
{
    $patient = Patient::findOrFail($id);
    
    // 1. الفاليديشن (لاحظ حذفنا doctor_id لأنه اتمسح من الداتابيز)
    $request->validate([
        'firstname' => 'required|string|max:255',
        'lastname'  => 'nullable|string|max:255',
        'phone'     => 'nullable|string',
        'age'       => 'nullable|integer',
        'gender'    => 'nullable|in:male,female',
        'address'   => 'nullable|string',
        'avatar'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // 2. تحديث البيانات الشخصية
    $patient->firstname = $request->firstname;
    $patient->lastname  = $request->lastname;
    $patient->phone     = $request->phone;
    $patient->age       = $request->age;
    $patient->gender    = $request->gender;
    $patient->address   = $request->address;

    // 3. معالجة صورة الملف الشخصي (Avatar)
    if ($request->hasFile('avatar')) {
        // حذف الصورة القديمة لو موجودة ومش هي الصورة الافتراضية
        if ($patient->avatar && $patient->avatar != 'user.jpg') {
            $oldAvatarPath = public_path('assets/img/' . $patient->avatar);
            if (File::exists($oldAvatarPath)) { File::delete($oldAvatarPath); }
        }
        
        $avatarName = 'avatar_' . time() . '.' . $request->avatar->extension();
        $request->avatar->move(public_path('assets/img'), $avatarName);
        $patient->avatar = $avatarName;
    }

    // 4. حفظ التعديلات في قاعدة البيانات
    $patient->save();

    // 5. التوجيه حسب الرتبة
    $route = (Auth::user()->role === 'doctor') ? 'doctor.patients' : 'admin.patients';
   return redirect()->route($route)->with('success', 'Patient updated successfully.');
}

    public function doctorIndex()
    {
        $user = Auth::user();
        $doctor = Doctor::where('email', $user->email)->first();

        if (!$doctor) {
            return view('doctor.patients', ['patients' => collect([])])
                   ->with('error', 'بيانات الطبيب غير موجودة');
        }

        $appointments = \App\Models\Appointment::where('doctor_id', $doctor->id)
                    ->where('status', 'confirmed')
                    ->with('patient') 
                    ->get();

        $patients = $appointments->pluck('patient')->filter()->unique('id');

        return view('doctor.patients', compact('patients'));
    }

    public function create()
    {
        $user = Auth::user();
        $doctors = Doctor::all();

        if ($user->role === 'doctor') {
            return view('doctor.addd_patient', compact('doctors'));
        }

        return view('admin.add-patient', compact('doctors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username'  => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:6',
            'firstname' => 'required|string',
            
        ]);

        try {
            DB::beginTransaction();

            $user = User::updateOrCreate(
                ['email' => $request->email],
                [
                    'name'     => $request->username,
                    'password' => Hash::make($request->password),
                    'role'     => 'patient', 
                ]
            );

            $patient = Patient::updateOrCreate(
                ['email' => $request->email],
                [
                    'user_id'   => $user->id,
                    'doctor_id' => $request->doctor_id,
                    'firstname' => $request->firstname,
                    'lastname'  => $request->lastname ?? '',
                    'phone'     => $request->phone ?? '',
                    'gender'    => $request->gender ?? 'male',
                    'age'       => $request->age ?? 0,
                    'address'   => $request->address ?? '',
                    'avatar'    => 'user.jpg', 
                ]
            );

            DB::commit();

            $route = (Auth::user()->role === 'doctor') ? 'doctor.patients' : 'admin.patients';
            return redirect()->route($route)->with('success', 'Patient added successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'حدث خطأ أثناء الحفظ.']);
        }
    }

    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();
        return redirect()->back()->with('success', 'Patient deleted successfully.');
    }



    public function myProfile()
{
    $user = Auth::user(); // لاحظ حرف A كبير
    $patient = \App\Models\Patient::where('email', $user->email)->first();
    return view('patient.my_profile', compact('user', 'patient'));
}

public function myProfileEdit()
{
    // 1. نجيب بيانات المستخدم اللي مسجل دخول حالياً
    $user = \Illuminate\Support\Facades\Auth::user();

    // 2. نجيب بيانات المريض المرتبطة بإيميله من جدول patients
    $patient = \App\Models\Patient::where('email', $user->email)->first();

    // 3. نفتح صفحة التعديل ونبعت لها البيانات
    // ملحوظة: تأكد أن الملف موجود في resources/views/patient/edit_profile.blade.php
    return view('patient.edit_profile', compact('user', 'patient'));
}


public function updateProfile(\Illuminate\Http\Request $request)
{
    $user = \Illuminate\Support\Facades\Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string',
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // 1. تحديث الاسم في جدول الـ Users
    \Illuminate\Support\Facades\DB::table('users')
        ->where('id', $user->id)
        ->update(['name' => $request->name]);

    // مصفوفة البيانات الخاصة بجدول Patients
    $patientData = [
        'phone' => $request->phone,
        'address' => $request->address,
        'updated_at' => now(),
    ];

    // 2. معالجة رفع الصورة وحفظها في جدول Patients
    if ($request->hasFile('avatar')) {
        $image = $request->file('avatar');
        $fileName = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/assets/img');
        $image->move($destinationPath, $fileName);
        
        // إضافة اسم الصورة لمصفوفة بيانات البيشنت
        $patientData['avatar'] = $fileName;
    }

    // 3. تحديث جدول الـ Patients
    \Illuminate\Support\Facades\DB::table('patients')
        ->where('email', $user->email)
        ->update($patientData);

    return redirect()->route('patient.profile')->with('success', 'Profile updated successfully!');
}











}