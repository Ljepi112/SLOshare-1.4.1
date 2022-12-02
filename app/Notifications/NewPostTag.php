<?php

namespace App\Notifications;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class NewPostTag extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * NewPostTag Constructor.
     */
    public function __construct(public string $type, public string $tagger, public Post $post)
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
            'title' => $this->tagger.' Vas je označil v objavi',
            'body'  => $this->tagger.' vas je označil v objavi v temi '.$this->post->topic->name,
            'url'   => \sprintf('/forums/topics/%s?page=%s#post-%s', $this->post->topic->id, $this->post->getPageNumber(), $this->post->id),
        ];
    }
}
