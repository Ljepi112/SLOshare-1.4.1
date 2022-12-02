<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuestStar extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public $table = 'person';

    public function episode(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Episode::class, 'episode_guest_star', 'episode_id', 'person_id');
    }
}
