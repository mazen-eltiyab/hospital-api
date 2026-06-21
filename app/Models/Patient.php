<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
       
        'firstname',
        'lastname',
        'age',      
        'email',
        'date_of_birth',
        'gender',
        'phone',
        'address',
        'avatar',
        'medical_report', 'report_file',
    ];

    /**
     * العلاقة: المريض ينتمي إلى مستخدم (User)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * العلاقة الجديدة: المريض يتابع مع طبيب محدد (Doctor)
     * هذه العلاقة هي التي كانت تسبب خطأ RelationNotFoundException
     */
   // علاقة المريض بالدكتور الأساسي
public function doctor()
{
    return $this->belongsTo(Doctor::class, 'doctor_id');
}

// علاقة المريض بتقاريره الطبية
public function medicalReports()
{
    return $this->hasMany(MedicalReport::class, 'patient_id');
}

    /**
     * العلاقة: مواعيد المريض (Appointments)
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * العلاقة: السجل الطبي (Medical reports)
     */
// داخل ملف Patient.php


    /**
     * دالة مساعدة لجلب الاسم الكامل للمريض
     */
    public function getFullNameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }
}