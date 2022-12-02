<?php

namespace App\Notifications;

use App\Models\Torrent;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserWarning extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public User $user, public Torrent $torrent)
    {
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(mixed $notifiable): array
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(mixed $notifiable): \Illuminate\Notifications\Messages\MailMessage
    {
        $profileUrl = \href_profile($this->user);

        return (new MailMessage())
            ->greeting('Opozorilo Hit in Run!')
            ->line('Prejeli ste opozorilo o Hit in Run na enem ali več torrentih!')
            ->action('Oglejte si nezadovoljene torrente, da odstranite svoja opozorila ali počakajte, da potečejo!', $profileUrl)
            ->line('Hvala za uporabo 🚀'.\config('other.title'));
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(mixed $notifiable): array
    {
        return [
            'title' => $this->torrent->name.' Prejeto opozorilo',
            'body'  => 'Od sistema ste prejeli samodejno OPOZORILO, ker niste upoštevali pravil Hit and Run v zvezi s Torrentom '.$this->torrent->name,
            'url'   => \sprintf('/torrents/%s', $this->torrent->id),
        ];
    }
}
