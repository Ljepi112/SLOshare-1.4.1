<?php

namespace App\Notifications;

use App\Models\TorrentRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class NewRequestClaim extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * NewRequestClaim Constructor.
     */
    public function __construct(public string $type, public string $sender, public TorrentRequest $torrentRequest)
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
            'title' => $this->sender.' Je prenesel enega od vaših zahtevanih Torrentov',
            'body'  => $this->sender.' je zahteval vaš zahtevani Torrent '.$this->torrentRequest->name,
            'url'   => \sprintf('/requests/%s', $this->torrentRequest->id),
        ];
    }
}
