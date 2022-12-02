<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatStatus extends Model
{
    use HasFactory;
    use Auditable;

    /**
     * A Status Has Many Users.
     */
    public function users(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(User::class, 'chat_status_id', 'id');
    }
}
