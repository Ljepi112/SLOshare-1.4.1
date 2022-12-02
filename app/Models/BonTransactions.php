<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonTransactions extends Model
{
    use HasFactory;

    /**
     * Indicates If The Model Should Be Timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The Storage Format Of The Model's Date Columns.
     *
     * @var string
     */
    protected $dateFormat = 'U';

    /**
     * Belongs To A Sender.
     */
    // Bad name to not conflict with sender (not sender_id)
    public function senderObj(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'sender', 'id')->withDefault([
            'username' => 'System',
            'id'       => '1',
        ]);
    }

    /**
     * Belongs To A Receiver.
     */
    // Bad name to not conflict with sender (not sender_id)
    public function receiverObj(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver', 'id')->withDefault([
            'username' => 'System',
            'id'       => '1',
        ]);
    }

    /**
     * Belongs To BonExchange.
     */
    public function exchange(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(BonExchange::class, 'itemID', 'id')->withDefault([
            'value' => 0,
            'cost'  => 0,
        ]);
    }
}
