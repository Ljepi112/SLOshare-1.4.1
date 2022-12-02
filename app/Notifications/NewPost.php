<?php

namespace App\Notifications;

use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class NewPost extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * NewPost Constructor.
     */
    public function __construct(public string $type, public User $user, public Post $post)
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
        if ($this->type == 'subscription') {
            return [
                'title' => $this->user->username.' Je objavil v naročeni temi',
                'body'  => $this->user->username.' je napisal novo objavo v naročeni temi '.$this->post->topic->name,
                'url'   => \sprintf('/forums/topics/%s?page=%s#post-%s', $this->post->topic->id, $this->post->getPageNumber(), $this->post->id),
            ];
        }

        if ($this->type == 'staff') {
            return [
                'title' => $this->user->username.' Je objavil v temi foruma za osebje',
                'body'  => $this->user->username.' je napisal novo objavo v temi osebja '.$this->post->topic->name,
                'url'   => \sprintf('%s?page=%s#post-%s', \route('forum_topic', ['id' => $this->post->topic->id]), $this->post->getPageNumber(), $this->post->id),
            ];
        }

        return [
            'title' => $this->user->username.' Je objavil v temi, ki ste jo objavili',
            'body'  => $this->user->username.' je napisal novo objavo v vaši temi '.$this->post->topic->name,
            'url'   => \sprintf('/forums/topics/%s?page=%s#post-%s', $this->post->topic->id, $this->post->getPageNumber(), $this->post->id),
        ];
    }
}
