<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // الحقول اللي مسموح لـ mass assignment
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    // الحقول المخفية عند التحويل إلى JSON
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // تعريف الـ casts بشكل صحيح
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // ===== Relations =====
    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }

    public function patient()
    {
        return $this->hasOne(Patient::class);
    }

protected static function booted()
{
    static::created(function ($user) {
        if ($user->role === 'patient') {
            // بنحاول نجيب أول دكتور متاح في السيستم
            $doctor = \App\Models\Doctor::first();

            \App\Models\Patient::create([
                'user_id'   => $user->id,
                'firstname' => $user->name,
                'age'       => request('age') ?? 30, // Default to 30 if not sent
                'phone'     => request('phone') ?? '0000000000',
                'email'     => $user->email,
                'address'   => request('address') ?? 'Unknown',
                // لو لقينا دكتور هنحط الـ ID بتاعه، لو ملقيناش هنبعت null والقاعدة هتقبلها
                'doctor_id' => $doctor ? $doctor->id : null, 
                'gender'    => request('gender') ?? 'Male',
            ]);
        }
    });
}

// داخل كلاس User في ملف app/Models/User.php
public function services()
{
    return $this->hasMany(Service::class, 'doctor_id');
}
}
