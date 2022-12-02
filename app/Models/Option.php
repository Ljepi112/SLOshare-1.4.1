<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    use Auditable;

    /** The Attributes That Are Mass Assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Belongs To A Poll.
     */
    public function poll(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Poll::class);
    }
}
