<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Ping implements ShouldBroadcastNow
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public array $ping;

    /**
     * Ping Constructor.
     */
    public function __construct(public $room, int $id)
    {
        $this->ping = ['type' => 'room', 'id' => $id];
    }

    /**
     * Get the channels the event should broadcast on.
     */
    public function broadcastOn(): PresenceChannel
    {
        return new PresenceChannel('chatroom.'.$this->room);
    }

    public function broadcastAs(): string
    {
        return 'new.ping';
    }
}
