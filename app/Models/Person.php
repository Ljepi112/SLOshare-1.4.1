<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public $table = 'person';

    public function tv(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Tv::class, 'person_tv', 'tv_id', 'person_id');
    }

    public function season(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Season::class, 'person_season', 'season_id', 'person_id');
    }

    public function episode(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Episode::class, 'episode_person', 'episode_id', 'person_id');
    }

    public function movie(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Movie::class, 'person_movie', 'movie_id', 'person_id');
    }

    public function cartoon(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Cartoon::class, 'person_cartoon', 'cartoon_id', 'person_id');
    }
}
