<?php

namespace App\Notifications;

use App\Models\Ban;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserBan extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Ban $ban)
    {
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        $chatdUrl = \config('sloshare.chat-link-url');

        return (new MailMessage())
            ->greeting('Prepovedani ste bili 😭')
            ->line('Prepovedali ste dostop '.\config('other.title').' za '.$this->ban->ban_reason)
            ->action('Potrebujem podporo?', $chatdUrl)
            ->line('Hvala za uporabo 🚀'.\config('other.title'));
    }
}
