<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChatUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id'             => $this->id,
            'username'       => $this->username,
            'chat_status'    => $this->whenLoaded('chatStatus'),
            'chat_status_id' => $this->chat_status_id,
            'chatroom_id'    => $this->chatroom_id,
            'group'          => $this->whenLoaded('group'),
            'echoes'         => $this->whenLoaded('echoes'),
            'group_id'       => $this->group_id,
            'title'          => $this->title,
            'image'          => $this->image,
        ];
    }
}
