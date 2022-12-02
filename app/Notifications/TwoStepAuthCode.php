<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TwoStepAuthCode extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * TwoStepAuthCode Constructor.
     */
    public function __construct(protected $user, protected $code)
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
        return (new MailMessage())
            ->from(\config('auth.verificationEmailFrom'), \config('auth.verificationEmailFromName'))
            ->subject(\trans('auth.verificationEmailSubject'))
            ->greeting(\trans('auth.verificationEmailGreeting', ['username' => $this->user->name]))
            ->line(\trans('auth.verificationEmailMessage'))
            ->line($this->code)
            ->action(\trans('auth.verificationEmailButton'), \route('verificationNeeded'));
    }
}
