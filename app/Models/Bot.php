<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bot extends Model
{
    use HasFactory;
    use Auditable;

    /**
     * Indicates If The Model Should Be Timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The Attributes That Should Be Cast To Native Types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
    ];
}
