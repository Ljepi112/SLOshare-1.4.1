<?php

namespace App\Notifications;

use App\Models\Topic;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class NewTopic extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * NewTopic Constructor.
     */
    public function __construct(public string $type, public User $user, public Topic $topic)
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
        if ($this->type == 'staff') {
            return [
                'title' => $this->user->username.' Je objavil na forumu osebja',
                'body'  => $this->user->username.' je začel novo kadrovsko temo v '.$this->topic->forum->name,
                'url'   => \route('forum_topic', ['id' => $this->topic->id]),
            ];
        }

        return [
            'title' => $this->user->username.' Objavil je na naročenem forumu',
            'body'  => $this->user->username.' je odprl novo temo v '.$this->topic->forum->name,
            'url'   => \sprintf('/forums/topics/%s', $this->topic->id),
        ];
    }
}
