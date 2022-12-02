<?php

namespace App\Models;

use App\Helpers\Bbcode;
use App\Helpers\Linkify;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use voku\helper\AntiXSS;

class PrivateMessage extends Model
{
    use HasFactory;
    use Auditable;

    /**
     * Belongs To A User.
     */
    public function sender(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id')->withDefault([
            'username' => 'System',
            'id'       => '1',
        ]);
    }

    /**
     * Belongs To A User.
     */
    public function receiver(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id')->withDefault([
            'username' => 'System',
            'id'       => '1',
        ]);
    }

    /**
     * Set The PM Message After Its Been Purified.
     */
    public function setMessageAttribute(string $value): void
    {
        $this->attributes['message'] = \htmlspecialchars((new AntiXSS())->xss_clean($value), ENT_NOQUOTES);
    }

    /**
     * Parse Content And Return Valid HTML.
     */
    public function getMessageHtml(): string
    {
        $bbcode = new Bbcode();

        return (new Linkify())->linky($bbcode->parse($this->message, true));
    }
}
