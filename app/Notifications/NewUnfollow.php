<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class NewUnfollow extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * NewUnfolllow Constructor.
     */
    public function __construct(public string $type, public User $sender, public User $target)
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
            'title' => $this->sender->username.' Nehal vas je spremljati!',
            'body'  => $this->sender->username.' vas je prenehal spremljati, zato ne bodo več prejemal obvestil o vaših dejavnostih.',
            'url'   => '/users/'.$this->sender->username,
        ];
    }
}
