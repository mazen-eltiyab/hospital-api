<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id', 
        'doctor_id', 
        'appointment_date', 
        'start_time', 
        'status', 
        'notes',
        'department',   // الحقل الجديد
        'patient_name',  // الحقل الجديد
        'doctor_name', // أضف هذا السطر
    ];



    

    public function doctor()
{
    return $this->belongsTo(Doctor::class);
    // تأكد أن اسم الجدول 'doctors' وأن الربط بـ 'doctor_id'
    return $this->belongsTo(Doctor::class, 'doctor_id');
}


// داخل كلاس Appointment
public function medicalReport()
{
    // العلاقة هنا إن الموعد له تقرير واحد فقط
    return $this->hasOne(MedicalReport::class, 'appointment_id');
}
    // الموعد ينتمي لمريض
   public function patient()
{
    // تأكد أن patient_id هو اسم العمود في جدول appointments
    return $this->belongsTo(Patient::class, 'patient_id');
}


}