<?php

namespace App\Models;

use App\Helpers\StringHelper;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;

class Subtitle extends Model
{
    use Auditable;

    /**
     * Belongs To A User.
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault([
            'username' => 'System',
            'id'       => '1',
        ]);
    }

    /**
     * Belongs To A Torrent.
     */
    public function torrent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Torrent::class);
    }

    /**
     * Belongs To A Media Language.
     */
    public function language(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MediaLanguage::class);
    }

    /**
     * Returns The Size In Human Format.
     */
    public function getSize(): string
    {
        $bytes = $this->file_size;

        return StringHelper::formatBytes($bytes, 2);
    }
}
