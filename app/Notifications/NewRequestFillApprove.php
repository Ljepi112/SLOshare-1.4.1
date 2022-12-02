<?php

namespace App\Notifications;

use App\Models\TorrentRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class NewRequestFillApprove extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * NewRequestFillApprove Constructor.
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
        if ($this->torrentRequest->anon == 0) {
            return [
                'title' => $this->sender.' Je odobril vaše polnjenje zahtevanega Torrenta',
                'body'  => $this->sender.' je odobril vaše polnjenje zahtevanega Torrenta '.$this->torrentRequest->name,
                'url'   => \sprintf('/requests/%s', $this->torrentRequest->id),
            ];
        }

        return [
            'title' => 'Anonimni uporabnik je odobril vaše polnjenje zahtevanega Torrenta',
            'body'  => 'Anonimni uporabnik je odobril vaše polnjenje zahtevanega Torrenta '.$this->torrentRequest->name,
            'url'   => \sprintf('/requests/%s', $this->torrentRequest->id),
        ];
    }
}
