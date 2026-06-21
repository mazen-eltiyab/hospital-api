<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $guarded = []; // السطر ده مهم عشان الحفظ

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
