<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use App\Models\ContactMessage;

class NewContactMessage extends Notification
{
    use Queueable;

    protected $contactMessage;

    public function __construct(ContactMessage $contactMessage)
    {
        $this->contactMessage = $contactMessage;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'New Contact Message',
            'message' => 'You received a new message from ' . $this->contactMessage->name,
            'contact_message_id' => $this->contactMessage->id,
            'type' => 'contact_message'
        ];
    }
}
