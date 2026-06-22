<?php

use App\Http\Controllers\{
    MedicalReportController,
    LanguageController,
    ProfileController,
    ChatbotController,
    DoctorController,
    PatientController,
    AppointmentController,
    ContactController,
    AdminDashboardController,
    ServiceController,
    Auth\GoogleController,
    Auth\AuthenticatedSessionController,
};

use Illuminate\Support\Facades\Route;
use App\Models\Patient; // إضافة هذا السطر لحل مشكلة الخطأ P1009


/*
|--------------------------------------------------------------------------
| 1. Public & Guest Routes
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Public Frontend Routes
|--------------------------------------------------------------------------
*/
/*
*/



/*
*/
use App\Http\Controllers\FrontendController;

// تأكد أن السطور دي موجودة في آخر الملف أو في بدايته بعيداً عن أي Group
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/about', [FrontendController::class, 'about'])->name('about');


// المسار الخارجي لصفحة الخدمات اللي بيدخل عليها الناس بره
Route::get('/servicess', [ServiceController::class, 'showFrontendServices'])->name('servicess');

Route::get('/doctorss', [FrontendController::class, 'doctors'])->name('doctorss');
// عدل الـ Route اللي كان بيعمل redirect خليه كدة أو امسحه لو مش محتاجه
// Route::get('/home', fn() => redirect()->route('home'));

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.post');
});

/*
|--------------------------------------------------------------------------
| 2. Protected Routes (auth)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
// روت استقبال رسائل الشات بوت ومعالجتها
Route::post('/chatbot/message', [ChatbotController::class, 'handleChat'])->name('chatbot.message');

    // --- Profile ---
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    // --- Admin Pages ---
    Route::get('/index-2', fn() => view('admin.index-2'))->name('admin');
    Route::get('/settings', fn() => view('admin.settings'))->name('settings');
    Route::get('/reports', fn() => view('admin.reports'))->name('reports');

    // --- Doctors Management ---
    Route::get('/doctors', [DoctorController::class, 'index'])->name('admin.doctors');
    Route::get('/admin/add-doctor', [DoctorController::class, 'create'])->name('admin.add-doctor');
    Route::post('/admin/doctors/store', [DoctorController::class, 'store'])->name('doctors.store');
    Route::get('/admin/doctor/edit/{doctor}', [DoctorController::class, 'edit'])->name('doctor.edit');
    Route::put('/admin/doctor/update/{doctor}', [DoctorController::class, 'update'])->name('doctor.update');
    Route::delete('/doctor/delete/{doctor}', [DoctorController::class, 'destroy'])->name('doctor.destroy');

 // داخل مجموعة الـ middleware الخاصة بالدكتور
// مسار تعديل البروفايل الخاص بالدكتور
Route::get('/doctor/profile/edit', [DoctorController::class, 'editProfile'])->name('doctor.profile.edit');
Route::put('/doctor/profile/update', [DoctorController::class, 'updateProfile'])->name('doctor.profile.update');

      
    // --- Patients Management ---
  Route::get('/admin/patients', [PatientController::class, 'adminIndex'])->name('admin.patients');
    Route::get('/add-patient', [PatientController::class, 'create'])->name('admin.add-patient');
    Route::post('/admin/patients/store', [PatientController::class, 'store'])->name('admin.store-patient');
    Route::get('/admin/patients/{id}/edit', [PatientController::class, 'edit'])->name('admin.edit-patient');
    Route::put('/admin/update-patient/{id}', [PatientController::class, 'update'])->name('admin.update-patient');

    // --- Doctor Dashboard ---
    Route::get('/doctor', fn() => view('doctor.index'))->name('doctor');
    Route::get('/doctor/patients', [PatientController::class, 'doctorIndex'])->name('doctor.patients');
    Route::get('/addd-patient', [PatientController::class, 'create'])->name('doctor.addd-patient');

    Route::get('/doctor/my-profile', [DoctorController::class, 'showProfile'])->name('doctor.profile.show');

    

    // --- Patient Dashboard ---
    Route::get('/patient', fn() => view('patient.index'))->name('patient.index');
    Route::get('/appointments_patient', fn() => view('patient.appointments_patient'))->name('patient.appointments_patient');

Route::get('/medical_reports', [MedicalReportController::class, 'index'])->name('medical_reports');

Route::get('/patient/my-profile', [PatientController::class, 'myProfile'])->name('patient.profile');
// روت عرض صفحة التعديل
Route::get('/patient/profile/edit', [PatientController::class, 'myProfileEdit'])->name('patient.profile.edit');

// روت استقبال البيانات وتحديثها (اللي عملناه قبل كدة)
Route::post('/patient/profile/update', [PatientController::class, 'updateProfile'])->name('patient.profile.update');
  
  Route::get('/patient_doctors', [App\Http\Controllers\DoctorController::class, 'patientDoctors'])->name('patient.doctors');

    // --- Services Management ---
    Route::controller(ServiceController::class)->group(function () {
        Route::get('/services', 'index')->name('services.index');
        Route::get('/add-services', 'create')->name('services.create');
        Route::post('/services/store', 'store')->name('services.store');
        Route::get('/services/{id}/edit', 'edit')->name('services.edit');
        Route::put('/services/{id}', 'update')->name('services.update');
        Route::delete('/services/{id}', 'destroy')->name('services.destroy');
    });

    // --- Appointments Management ---
    Route::controller(AppointmentController::class)->group(function () {
        // روابط العرض
        Route::get('/appointments', 'index')->name('admin.appointments');
        Route::get('/doctor/appointments', 'index')->name('doctor.appointments');
        Route::get('/appointments/list', 'index')->name('appointments.index');
        
        // روابط الإجراءات
       Route::get('/book_appointments', [AppointmentController::class, 'bookAppointment'])->name('appointments.create');


Route::get('/doc_add_appoiment', [AppointmentController::class, 'addAppointment'])->name('appointment.create');


        Route::get('/add-appointment', 'create'); // رابط إضافي لنفس الدالة بدون Name مكرر
        Route::post('/appointments/store', 'store')->name('appointments.store');
        Route::get('/get-available-slots', 'getAvailableSlots')->name('get.slots');
        Route::post('/appointments/update-status', 'updateStatus')->name('appointments.updateStatus');
        
        
        // AJAX Helpers
        Route::get('/get-services', 'getServices')->name('get.services');
        Route::get('/get-doctors-by-service', 'getDoctorsByService')->name('get.doctors.by.service');
    });
});

/*
|--------------------------------------------------------------------------
| 3. Auth & External
|--------------------------------------------------------------------------
*/
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::get('/clear-cache', function () {
    Artisan::call('optimize:clear');
    return 'Cache cleared!';
});

require __DIR__.'/auth.php';




// الصح إنه يروح لـ index جوه الـ Controller عشان ينفذ الكود اللي بيجيب البيانات
Route::get('/appointments_patient', [App\Http\Controllers\AppointmentController::class, 'index'])->name('patient.appointments_patient');



Route::get('/doctor/add-report/{id}', [DoctorController::class, 'addReport'])->name('doctor.add-report');

Route::post('/doctor/store-report/{id}', [DoctorController::class, 'storeReport'])->name('doctor.store-report');

// مسار قائمة المرضى (تأكد من وجوده ليعمل زر Cancel)



Route::post('/appointments/update-status', [AppointmentController::class, 'updateStatus'])->name('appointments.updateStatus');

// مسار الحذف (هذا هو السطر الناقص)
Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');


// التعديل: جعل الرابط يذهب لدالة index في الـ PatientController





Route::delete('/doctor/patients/{id}', [PatientController::class, 'destroy'])->name('doctor.delete-patient');


// مسار حفظ التقرير الطبي الجديد
Route::post('/doctor/store-report/{id}', [App\Http\Controllers\DoctorController::class, 'storeReport'])->name('doctor.store-report');



Route::post('/doctor/{id}/rate', [App\Http\Controllers\DoctorController::class, 'rateDoctor'])->name('doctor.rate');



// الـ {doctor_id?} تعني أن الـ ID اختياري ولن يسبب خطأ إذا دخل المريض مباشرة
Route::get('/book-appointment/{doctor_id?}', [App\Http\Controllers\AppointmentController::class, 'create'])->name('appointments.book');



Route::get('/get-available-slots', [AppointmentController::class, 'getAvailableSlots'])->name('get.slots');






// أضفنا ->name('doctor') في نهاية السطر
Route::get('/doctor', [DoctorController::class, 'index'])->middleware('auth')->name('doctor');






Route::get('/doctor/patients', [DoctorController::class, 'doctorPatients'])->name('doctor.patients');




use Illuminate\Support\Facades\Auth; // تأكد إن السطر ده موجود فوق خالص

Route::post('/notifications/mark-all-read', function () {
    $user = Auth::user(); // استخدام الكلاس Auth مباشرة يحل مشكلة الـ Undefined method
    
    if ($user) {
        $user->unreadNotifications->markAsRead();
        return response()->json(['success' => true]);
    }
    
    return response()->json(['success' => false], 401);
})->middleware('auth');







Route::get('/doctor/edit-report/{id}', [DoctorController::class, 'editReport'])->name('doctor.edit-report');
Route::put('/doctor/update-report/{id}', [DoctorController::class, 'updateReport'])->name('doctor.update-report');







Route::delete('/admin/patient/delete/{id}', [PatientController::class, 'destroy'])->name('admin.delete-patient');























Route::get('lang/{locale}', function ($locale) {
    session(['locale' => $locale]);
    return redirect()->back();
})->name('lang.switch');




// Tasks
Route::get('/admin/tasks', fn() => view('admin.tasks'))->name('admin.tasks');

// Staff schedule
Route::get('/admin/staff', fn() => view('admin.staff'))->name('admin.staff');

// Wards
Route::get('/admin/wards', fn() => view('admin.wards'))->name('admin.wards');

// Departments
Route::get('/admin/departments', fn() => view('admin.departments'))->name('admin.departments');

// Notifications create
Route::get('/admin/notifications/create', fn() => view('admin.notifications.create'))
    ->name('admin.notifications.create');












    // مسار لعرض الصفحة اللي فيها الفورم بتاعتك
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');

// مسار استقبال البيانات لما المستخدم يدوس على زرار Send Message
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


// --- 2. مسارات لوحة تحكم الأدمن (Admin Dashboard) ---
// مجمعة تحت كلمة 'admin' ومحمية بـ auth (لازم يكون عامل تسجيل دخول)

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // صفحة جدول الرسائل الرئيسية (البحث والفلترة)
    Route::get('/messages', [AdminDashboardController::class, 'index'])->name('messages');
    
    // صفحة عرض تفاصيل رسالة معينة لتغيير حالتها لـ Read
    Route::get('/messages/{id}', [AdminDashboardController::class, 'show'])->name('messages.show');
    
    // مسار حذف الرسالة نهائياً
    Route::delete('/messages/{id}', [AdminDashboardController::class, 'destroy'])->name('messages.destroy');
    
});









Route::get('/clear', function () { \Illuminate\Support\Facades\Artisan::call('optimize:clear'); return 'Cache Cleared!'; });
Route::get('/migrate', function () { try { \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]); \Illuminate\Support\Facades\Artisan::call('storage:link'); return 'Database Migrated and Storage Linked Successfully!'; } catch (\Exception $e) { return 'Error: ' . $e->getMessage(); } });
