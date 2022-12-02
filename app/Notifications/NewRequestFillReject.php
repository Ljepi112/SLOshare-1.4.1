<?php

namespace App\Notifications;

use App\Models\TorrentRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class NewRequestFillReject extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * NewRequestFillReject Constructor.
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
            'title' => $this->sender.' Je zavrnil vaše polnjenje zahtevanega Torrenta',
            'body'  => $this->sender.' je zavrnil vaš poln zahtevanega Torrenta '.$this->torrentRequest->name,
            'url'   => \sprintf('/requests/%s', $this->torrentRequest->id),
        ];
    }
}
