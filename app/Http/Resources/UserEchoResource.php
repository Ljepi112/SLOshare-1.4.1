<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserEchoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id'         => $this->id,
            'user_id'    => $this->user_id,
            'user'       => $this->user,
            'target'     => $this->target,
            'room'       => $this->room,
            'bot'        => $this->bot,
        ];
    }
}
