<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class AppointmentReminder extends Notification
{
    use Queueable;

    public function __construct()
    {
        //
    }

    // تحديد قنوات الإرسال: قاعدة البيانات (للجرس) والإيميل
    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    // محتوى الإيميل اللي هيوصل للمريض
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('تذكير بموعدك القادم - Medicare')
                    ->greeting('مرحباً ' . $notifiable->name)
                    ->line('نود تذكيرك بأن لديك موعداً محجزاً غداً في نظام Medicare.')
                    ->action('عرض تفاصيل الموعد', url('/appointments_patient'))
                    ->line('نرجو الالتزام بالحضور في الموعد المحدد.')
                    ->line('شكراً لثقتك بنا!');
    }

    // البيانات اللي هتتخزن في الداتا بيز وتظهر في "الجرس"
    public function toArray($notifiable)
    {
        return [
            'title' => 'تذكير بالموعد',
            'message' => 'لديك موعد محجز غداً، نرجو مراجعة التفاصيل.',
            'url' => url('/appointments_patient'),
        ];
    }
}