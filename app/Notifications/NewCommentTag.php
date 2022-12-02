<?php

namespace App\Notifications;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class NewCommentTag extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * NewCommentTag Constructor.
     */
    public function __construct(public string $type, public string $tagger, public Comment $comment)
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
        if ($this->type == 'torrent') {
            return [
                'title' => $this->tagger.' Označil vas je v komentarju Torrenta',
                'body'  => $this->tagger.' vas je označil v komentarju Torrenta '.$this->comment->torrent->name,
                'url'   => \sprintf('/torrents/%s', $this->comment->torrent->id),
            ];
        }

        if ($this->type == 'request') {
            return [
                'title' => $this->tagger.' Vas je označil v komentarju za zahtevo',
                'body'  => $this->tagger.' vas je označil v komentarju za zahtevo '.$this->comment->request->name,
                'url'   => \sprintf('/requests/%s', $this->comment->request->id),
            ];
        }

        return [
            'title' => $this->tagger.' Vas je označil v komentarju članka',
            'body'  => $this->tagger.' vas je označil v komentarju članeka '.$this->comment->article->title,
            'url'   => \sprintf('/articles/%s', $this->comment->article->id),
        ];
    }
}
