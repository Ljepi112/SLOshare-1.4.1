<?php

namespace App\Notifications;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class NewPostTip extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * NewPostTip Constructor.
     */
    public function __construct(public string $type, public string $tipper, public $amount, public Post $post)
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
            'title' => $this->tipper.' Dal vam je darilo '.$this->amount.' BON za objavo na forumu',
            'body'  => $this->tipper.' je nakazal eno od vaših objav na forumu '.$this->post->topic->name,
            'url'   => \sprintf('/forums/topics/%s?page=%s#post-%s', $this->post->topic->id, $this->post->getPageNumber(), $this->post->id),
        ];
    }
}
