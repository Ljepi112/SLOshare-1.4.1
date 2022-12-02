<?php

namespace App\Notifications;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewComment extends Notification
{
    use Queueable;

    /**
     * NewComment Constructor.
     */
    public function __construct(public string $type, public Comment $comment)
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
            if ($this->comment->anon == 0) {
                return [
                    'title' => 'Prejet nov komentar Torrenta',
                    'body'  => $this->comment->user->username.' vam je pustil komentar o Torrentu '.$this->comment->commentable->name,
                    'url'   => '/torrents/'.$this->comment->commentable->id,
                ];
            }

            return [
                'title' => 'Prejet nov komentar Torrenta',
                'body'  => 'Anonimnež vam je pustil komentar o Torrentu '.$this->comment->commentable->name,
                'url'   => '/torrents/'.$this->comment->torrent->id,
            ];
        }

        if ($this->type == 'torrentrequest') {
            if ($this->comment->anon == 0) {
                return [
                    'title' => 'Prejet je bil nov komentar o zahtevi',
                    'body' => $this->comment->user->username.' vam je pustil komentar zahtevo za Torrent '.$this->comment->commentable->name,
                    'url' => '/requests/'.$this->comment->commentable->id,
                ];
            }

            return [
                'title' => 'Prejet je bil nov komentar o zahtevi',
                'body' => 'Anonimnež vam je pustil komentar zahtevo za Torrent '.$this->comment->commentable->name,
                'url' => '/requests/'.$this->comment->commentable->id,
            ];
        }

        if ($this->type == 'ticket') {
            if ($this->comment->anon == 0) {
                return [
                    'title' => 'Prejet komentar o novem Ticketu',
                    'body' => $this->comment->user->username.' vam je pustil komentar na Ticketu '.$this->comment->commentable->subject,
                    'url' => '/tickets/'.$this->comment->commentable->id,
                ];
            }

            return [
                'title' => 'Prejet komentar o novem Ticketu',
                'body' => 'Anonimno vam je pustil komentar na Ticket '.$this->comment->commentable->subject,
                'url' => '/tickets/'.$this->comment->commentable->id,
            ];
        }

        if ($this->type == 'playlist') {
            if ($this->comment->anon == 0) {
                return [
                    'title' => 'Prejet komentar o novem seznamu predvajanja',
                    'body' => $this->comment->user->username.' vas je komentiral na seznamu predvajanja '.$this->comment->commentable->name,
                    'url' => '/playlists/'.$this->comment->commentable->id,
                ];
            }

            return [
                'title' => 'Prejet komentar o novem Playlist',
                'body' => 'Anonimno vam je pustil komentar na Playlist '.$this->comment->commentable->name,
                'url' => '/playlists/'.$this->comment->commentable->id,
            ];
        }

        if ($this->type == 'collection') {
            if ($this->comment->anon == 0) {
                return [
                    'title' => 'Prejet komentar o novi zbirki',
                    'body' => $this->comment->user->username.' vam je pustil komentar o zbirki '.$this->comment->commentable->name,
                    'url' => '/mediahub/collections/'.$this->comment->commentable->id,
                ];
            }

            return [
                'title' => 'Prejet komentar o novi zbirki',
                'body' => 'Anonimno vam je pustil komentar o zbirki '.$this->comment->commentable->name,
                'url' => '/mediahub/collections/'.$this->comment->commentable->id,
            ];
        }

        if ($this->comment->anon == 0) {
            return [
                'title' => 'Prejet komentar o novem članku',
                'body' => $this->comment->user->username.' vam je pustil komentar o članku '.$this->comment->commentable->title,
                'url' => '/articles/'.$this->comment->commentable->id,
            ];
        }

        return [
            'title' => 'Prejet komentar o novem članku',
            'body' => 'Anonimno vam je pustil komentar o članku '.$this->comment->commentable->title,
            'url' => '/articles/'.$this->comment->commentable->id,
        ];
    }
}
