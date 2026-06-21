<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    // الحقول المسموح بتعبئتها (يجب أن تطابق الـ Migration الخاص بك)
    protected $fillable = [
        'user_id', 
        'salary',
        'experience',
        'firstname', 
        'lastname', 
        'username', 
        'email', 
        'rating',
        'password', 
        'dob', 
        'gender', 
        'address', 
        'country', 
        'city', 
        'phone', 
        'avatar', 
        'bio', 
        'status'
    ];

    /**
     * (many to one) علاقة الطبيب بالمستخدم 
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * علاقة الطبيب بالمواعيد
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }


    // app/Models/Doctor.php

public function services()
{
    //   (many to many ) هذه هي العلاقة 
   
    return $this->belongsToMany(Service::class, 'doctor_service');
}
}