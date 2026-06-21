<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalReport extends Model
{
    protected $fillable = [
    'appointment_id', // لازم يكون موجود هنا عشان updateOrCreate تشتغل
    'doctor_id',
    'patient_id',
    'report_content',
    'file_path'
];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    // داخل كلاس MedicalReport
// داخل كلاس MedicalReport
public function doctor()
{
    // الربط الصحيح: كل تقرير ينتمي لدكتور واحد
    return $this->belongsTo(Doctor::class, 'doctor_id');
}
}
