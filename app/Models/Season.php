<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public $table = 'seasons';

    /**
     * Has Many Torrents.
     */
    public function torrents(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Torrent::class, 'tmdb', 'tv_id')->whereHas('category', function ($q) {
            $q->where('tv_meta', '=', true);
        });
    }

    public function tv(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Tv::class);
    }

    public function episodes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Episode::class)
            ->oldest('episode_number');
    }

    public function person(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Person::class);
    }

    public function cast(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Cast::class);
    }

    public function crew(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Crew::class);
    }
}
