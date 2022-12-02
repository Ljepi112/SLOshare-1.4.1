<?php

namespace App\Notifications;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class NewFollow extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * NewFollow Constructor.
     */
    public function __construct(public string $type, public User $sender, public User $target, public Follow $follow)
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
            'title' => $this->sender->username.' Imate novega sledilca!',
            'body'  => $this->sender->username.' vas je začel spremljati, tako, da bo prejemal obvestila o vaših dejavnostih.',
            'url'   => \sprintf('/users/%s', $this->sender->username),
        ];
    }
}
