<?php

namespace App\Notifications;

use App\Models\TorrentRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class NewRequestBounty extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * NewRequestBounty Constructor.
     */
    public function __construct(public string $type, public string $sender, public $amount, public TorrentRequest $torrentRequest)
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
            'title' => $this->sender.' Dal vam je darilo '.$this->amount.' Na zahtevani Torrent',
            'body'  => $this->sender.' je dodal nagrado enemu od vaših zahtevanih Torrentov '.$this->torrentRequest->name,
            'url'   => \sprintf('/requests/%s', $this->torrentRequest->id),
        ];
    }
}
