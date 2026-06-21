<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Models\Appointment;
use App\Models\User;
use App\Notifications\AppointmentReminder;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
*/

// أمر افتراضي في لارافل (يمكنك تركه أو حذفه)
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// المجدول الزمني لتنبيهات المواعيد
Schedule::call(function () {
    // 1. تحديد تاريخ الغد
    $tomorrow = Carbon::tomorrow()->format('Y-m-d');
    
    dump("جاري البحث عن مواعيد تاريخ: " . $tomorrow);

    // 2. جلب مواعيد الغد التي تبدأ في تمام الساعة 8 مساءً (20:00)
    // استخدمنا start_time كما هو موجود في جدولك
    $appointments = Appointment::whereDate('appointment_date', $tomorrow)
                               ->whereTime('start_time', '>=', '20:00:00')
                               ->whereTime('start_time', '<', '21:00:00')
                               ->get();

    dump("عدد المواعيد المكتشفة: " . $appointments->count());

   foreach ($appointments as $appointment) {
        // 1. ابحث عن المريض في جدول المرضى أولاً
        $patient = \App\Models\Patient::find($appointment->patient_id);

        if ($patient) {
            // 2. ابحث عن المستخدم (User) المرتبط بهذا المريض
            // نفترض هنا أن جدول المرضى فيه عمود اسمه user_id أو نستخدم الإيميل للربط
            $patientUser = \App\Models\User::where('email', $patient->email)->first();

            if ($patientUser) {
                $patientUser->notify(new AppointmentReminder());
                dump("✅ تم إرسال التنبيه بنجاح للمريض: " . $patientUser->name);
            } else {
                dump("❌ المريض موجود ولكن لا يوجد له حساب مستخدم (User) بنفس الإيميل.");
            }
        } else {
            dump("❌ لا يوجد مريض في جدول Patients يحمل ID رقم: " . $appointment->patient_id);
        }
    }
})->everyMinute(); // الفحص يتم كل دقيقة لضمان الدقة