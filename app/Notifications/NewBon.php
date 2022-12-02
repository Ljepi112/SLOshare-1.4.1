<?php

namespace App\Notifications;

use App\Models\BonTransactions;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class NewBon extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * NewBon Constructor.
     */
    public function __construct(public string $type, public string $sender, public BonTransactions $bonTransactions)
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
            'title' => $this->sender.' Ti je podarila '.$this->bonTransactions->cost.' BON',
            'body'  => $this->sender.' ti je podarila '.$this->bonTransactions->cost.' BON z naslednjo opombo: '.$this->bonTransactions->comment,
            'url'   => \sprintf('/users/%s', $this->bonTransactions->senderObj->username),
        ];
    }
}
