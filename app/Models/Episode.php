<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    protected $guarded = [];

    protected string $orderBy = 'order';

    protected string $orderDirection = 'ASC';

    public $table = 'episodes';

    public function season(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Season::class)
            ->oldest('season_id')
            ->oldest('episode_id');
    }

    public function person(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Person::class);
    }

    public function cast(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Cast::class)
            ->oldest('order');
    }

    public function crew(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Crew::class, 'crew_episode', 'person_id', 'episode_id');
    }

    public function guest_star(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(GuestStar::class, 'episode_guest_star', 'person_id', 'episode_id');
    }
}
