<?php

namespace App\Models;

use App\Helpers\StringHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TorrentFile extends Model
{
    use HasFactory;

    /**
     * Indicates If The Model Should Be Timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The Database Table Used By The Model.
     *
     * @var string
     */
    protected $table = 'files';

    /**
     * Belongs To A Torrent.
     */
    public function torrent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Torrent::class);
    }

    /**
     * Return Size In Human Format.
     */
    public function getSize(): string
    {
        $bytes = $this->size;

        return StringHelper::formatBytes($bytes, 2);
    }
}
