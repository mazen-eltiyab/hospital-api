<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';

    /**
     * الحقول القابلة للتعبئة
     * ملحوظة: حذفنا doctor_id لأنه لم يعد حقلًا في هذا الجدول
     */
    protected $fillable = [
        'service_name',
        'price',
        'status',
    ];

    /**
     * علاقة الخدمة بالأطباء (متعدد لمتعدد)
     * الخدمة الواحدة مرتبطة بأكثر من دكتور
     */
    public function doctors() 
    {
        // تم تغيير الاسم للجمع 'doctors' واستخدام belongsToMany
        return $this->belongsToMany(Doctor::class, 'doctor_service');
    }

    protected $casts = [
    'doctor_ids' => 'array', // سيقوم لارافل بتحويل المصفوفة لـ JSON عند الحفظ والعكس عند الجلب
];


    /**
     * دالة لعرض السعر بتنسيق العملة
     */
    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 2) . ' EGP';
    }
}