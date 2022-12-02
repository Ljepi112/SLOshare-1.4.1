<?php

namespace App\Notifications;

use App\Models\Torrent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class NewUploadTip extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * NewUploadTip Constructor.
     */
    public function __construct(public string $type, public string $tipper, public $amount, public Torrent $torrent)
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
            'title' => $this->tipper.' Dal vam je nagrado '.$this->amount.' BON za naloženi Torrent',
            'body'  => $this->tipper.' je dal nagrado enemu od vaših naloženih Torrentov '.$this->torrent->name,
            'url'   => \sprintf('/torrents/%s', $this->torrent->id),
        ];
    }
}
