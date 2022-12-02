<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonExchange extends Model
{
    use HasFactory;

    /**
     * The Database Table Used By The Model.
     *
     * @var string
     */
    protected $table = 'bon_exchange';

    /**
     * Indicates If The Model Should Be Timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The Attributes That Should Be Casted To Native Types.
     *
     * @var array
     */
    protected $casts = [
        'upload'             => 'boolean',
        'download'           => 'boolean',
        'personal_freeleech' => 'boolean',
        'invite'             => 'boolean',
    ];
}
