<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cartoon extends Model
{
    protected $guarded = [];

    public $table = 'cartoon';

    public function genres(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }

    public function cast(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Cast::class, 'cast_cartoon', 'cast_id', 'cartoon_id');
    }

    public function crew(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Crew::class, 'crew_cartoon', 'person_id', 'cartoon_id');
    }

    public function companies(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Company::class);
    }

    public function countries(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Company::class);
    }

    public function collection(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Collection::class)->take(2);
    }

    public function recommendations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Recommendation::class, 'cartoon_id', 'id');
    }

    public function torrents(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Torrent::class, 'tmdb', 'id')->whereHas('category', function ($q) {
            $q->where('cartoon_meta', '=', true);
        });
    }
}
