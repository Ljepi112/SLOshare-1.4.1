<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserMaxWarningsReached extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public User $user)
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
        $profileUrl = \href_profile($this->user);

        return (new MailMessage())
            ->greeting('Hit in Run Maksimalna dosežena opozorila!')
            ->line('Dosegli ste omejitev aktivnih Hit in Run Opozoril! Vaše pravice do prenosa so onemogočene!')
            ->action('Oglejte si nezadovoljene torrente, da odstranite svoja opozorila ali počakajte, da potečejo!', $profileUrl)
            ->line('Hvala za uporabo 🚀'.\config('other.title'));
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable): array
    {
        return [
            'title' => 'Hit in Run Maksimalna Dosežena opozorila!',
            'body'  => 'Dosegli ste omejitev aktivnih Hit in Run Opozoril! Vaše pravice do prenosa so onemogočene!',
            'url'   => \sprintf('/users/%s', $this->user->username),
        ];
    }
}
