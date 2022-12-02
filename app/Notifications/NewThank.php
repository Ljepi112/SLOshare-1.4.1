<?php

namespace App\Notifications;

use App\Models\Thank;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewThank extends Notification
{
    use Queueable;

    /**
     * NewThank Constructor.
     */
    public function __construct(public string $type, public Thank $thank)
    {
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable): array
    {
        return [
            'title' => $this->thank->user->username.' Zahvalil se je na vaš naloženi Torrent',
            'body'  => $this->thank->user->username.' vam je pustil zahvalo na vašem naloženem Torrentu '.$this->thank->torrent->name,
            'url'   => '/torrents/'.$this->thank->torrent->id,
        ];
    }
}
