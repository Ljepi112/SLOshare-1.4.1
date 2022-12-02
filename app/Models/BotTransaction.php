<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BotTransaction extends Model
{
    use HasFactory;
    use Auditable;

    /**
     * Indicates If The Model Should Be Timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Belongs To A User.
     */
    // Bad name to not conflict with sender (not sender_id)
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault([
            'username' => 'System',
            'id'       => '1',
        ]);
    }

    /**
     * Belongs To A Bot.
     */
    // Bad name to not conflict with sender (not sender_id)
    public function bot(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Bot::class)->withDefault([
            'username' => 'System',
            'id'       => '1',
        ]);
    }

    /**
     * Get the Bot transaction type answer as string.
     */
    public function forHumans(): string
    {
        if ($this->type == 'bon') {
            return 'BON';
        }

        return 'Unknown';
    }
}
