<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UsernameReminder extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * UsernameReminderEmail constructor.
     */
    public function __construct()
    {
        // nothing special to do
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
        return (new MailMessage())
                    ->subject(\trans('common.your').' '.\config('app.name').' '.\trans('common.username'))
                    ->greeting(\trans('common.contact-header').', '.$notifiable->username)
                    ->line(\trans('email.username-reminder').' '.$notifiable->username)
                    ->action('Login as '.$notifiable->username, \route('login'))
                    ->line(\trans('email.thanks').' '.\config('app.name'));
    }
}
