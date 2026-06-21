<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $guarded = []; // للسماح بالحفظ

    // علاقة الموعد بالدكتور
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    // علاقة الموعد بالمريض
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}