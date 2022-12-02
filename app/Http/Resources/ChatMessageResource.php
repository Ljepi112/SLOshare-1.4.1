<?php

namespace App\Http\Resources;

use App\Helpers\Bbcode;
use sloyakuza\LaravelJoyPixels\LaravelJoyPixels;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatMessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function toArray($request): array
    {
        $emojiOne = \app()->make(LaravelJoyPixels::class);

        $logger = null;
        $bbcode = new Bbcode();
        if ($this->user_id == 1) {
            $logger = $bbcode->parse('<div class="align-left"><div class="chatTriggers">'.$this->message.'</div></div>');
            $logger = $emojiOne->toImage($logger);
            $logger = \str_replace('a href="/#', 'a trigger="bot" class="chatTrigger" href="/#', $logger);
        } else {
            $logger = $bbcode->parse('<div class="align-left">'.$this->message.'</div>');
            $logger = $emojiOne->toImage($logger);
        }
        $logger = \htmlspecialchars_decode($logger);

        return [
            'id'         => $this->id,
            'bot'        => new BotResource($this->whenLoaded('bot')),
            'user'       => new ChatUserResource($this->whenLoaded('user')),
            'receiver'   => new ChatUserResource($this->whenLoaded('receiver')),
            'chatroom'   => new ChatRoomResource($this->whenLoaded('chatroom')),
            'message'    => \clean($logger),
            'created_at' => $this->created_at->toIso8601String(),
            'updated_at' => $this->updated_at->toIso8601String(),
        ];
    }
}
