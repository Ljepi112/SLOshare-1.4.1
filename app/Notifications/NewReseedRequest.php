<?php

namespace App\Notifications;

use App\Models\Torrent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class NewReseedRequest extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * NewReseedRequest Constructor.
     */
    public function __construct(public Torrent $torrent)
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
        $appurl = \config('app.url');

        return [
            'title' => 'Nova zahteva za ponovno nalaganje',
            'body'  => \sprintf('Pred časom ste prenesli: %s. Zdaj je mrtev in nekdo je zahteval ponovno sejanje. Če imate ta Torrent še vedno v shrambi, razmislite o ponovni uporabi!', $this->torrent->name),
            'url'   => \sprintf('%s/torrents/%s', $appurl, $this->torrent->id),
        ];
    }
}
