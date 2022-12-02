<?php

namespace App\Notifications;

use App\Models\Torrent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class NewUpload extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * NewUpload Constructor.
     */
    public function __construct(public string $type, public Torrent $torrent)
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
            'title' => $this->torrent->user->username.' Naložil je nov Torrent',
            'body'  => \sprintf('%s, ki ga spremljate je naložil Torrent %s', $this->torrent->user->username, $this->torrent->name),
            'url'   => \sprintf('/torrents/%s', $this->torrent->id),
        ];
    }
}
