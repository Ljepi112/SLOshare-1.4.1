<?php

namespace App\Models;

use App\Helpers\Bbcode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use voku\helper\AntiXSS;

class Message extends Model
{
    use HasFactory;

    /**
     * The Attributes That Are Mass Assignable.
     *
     * @var array
     */
    protected $fillable = [
        'message',
        'user_id',
        'chatroom_id',
        'receiver_id',
        'bot_id',
    ];

    /**
     * Belongs To A Bot.
     */
    public function bot(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Bot::class);
    }

    /**
     * Belongs To A User.
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A message belongs to a receiver.
     */
    public function receiver(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    /**
     * Belongs To A Chat Room.
     */
    public function chatroom(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Chatroom::class);
    }

    /**
     * Set The Chat Message After Its Been Purified.
     */
    public function setMessageAttribute(string $value): void
    {
        $this->attributes['message'] = \htmlspecialchars((new AntiXSS())->xss_clean($value), ENT_NOQUOTES);
    }

    /**
     * Parse Content And Return Valid HTML.
     */
    public static function getMessageHtml($message): string
    {
        return (new Bbcode())->parse($message, true);
    }
}
