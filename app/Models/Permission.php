<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    use Auditable;

    /**
     * Tells Laravel To Not Maintain The Timestamp Columns.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Belongs To A Group.
     */
    public function group(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * Belongs To A Forum.
     */
    public function forum(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Forum::class);
    }
}
