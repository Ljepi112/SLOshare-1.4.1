<?php

namespace App\Events;

use App\Http\Resources\ChatMessageResource;
use App\Models\Message;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcastNow
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    /**
     * Message details.
     *
     * @var Message
     */
    public $message;

    /**
     * Create a new event instance.
     */
    public function __construct(Message $message)
    {
        $message = Message::with([
            'bot',
            'user.group',
            'user.chatStatus',
            'receiver.group',
            'receiver.chatStatus',
        ])->find($message->id);

        $this->message = new ChatMessageResource($message);
    }

    /**
     * Get the channels the event should broadcast on.
     */
    public function broadcastOn(): PresenceChannel
    {
        // $this->dontBroadcastToCurrentUser();

        return new PresenceChannel('chatroom.'.$this->message->chatroom_id);
    }

    public function broadcastAs(): string
    {
        return 'new.message';
    }
}
