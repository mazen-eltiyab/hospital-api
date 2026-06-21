<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewMedicalReport extends Notification
{
    use Queueable;

    // متغير لحفظ حالة التقرير (جديد أم تعديل)
    protected $isUpdate;

    /**
     * نمرر قيمة true لو كان تعديلاً، و false (افتراضي) لو كان جديداً
     */
    public function __construct($isUpdate = false)
    {
        $this->isUpdate = $isUpdate;
    }

    /**
     * إخبار لارافل أن التنبيه سيُخزن في قاعدة البيانات
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * البيانات التي ستظهر في "الجرس" للمريض بشكل ديناميكي
     */
    public function toArray($notifiable)
    {
        return [
            // العنوان يتغير حسب الحالة
            'title' => $this->isUpdate ? 'تعديل في التقرير الطبي' : 'تقرير طبي جديد',
            
            // الرسالة تتغير حسب الحالة
            'message' => $this->isUpdate 
                ? 'قام الطبيب بتحديث بيانات تقريرك الطبي الأخير.' 
                : 'قام الطبيب بإضافة تقرير طبي جديد لملفك.',
            
            'url' => url('/medical_reports'), 
        ];
    }
}