<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TwoStepAuth extends Model
{
    use HasFactory;
    use Auditable;

    /**
     * The Database Table Used By The Model.
     *
     * @var string
     */
    protected $table = 'twostep_auth';

    /**
     * Indicates If The Model Should Be Timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The Attributes That Are Not Mass Assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * The Attributes That Should Be Mutated To Dates.
     *
     * @var array
     */

    /**
     * The Attributes That Are Mass Assignable.
     *
     * @var array
     */
    protected $fillable = [
        'userId',
        'authCode',
        'authCount',
        'authStatus',
        'requestDate',
        'authDate',
    ];

    /**
     * The Attributes That Should Be Casted To Native Types.
     *
     * @var array
     */
    protected $casts = [
        'requestDate' => 'datetime',
        'authDate'    => 'datetime',
        'userId'      => 'integer',
        'authCode'    => 'string',
        'authCount'   => 'integer',
        'authStatus'  => 'boolean',    ];

    /**
     * Get a validator for an incoming Request.
     */
    public static function rules(array $merge = []): array
    {
        return \array_merge(
            [
                'userId'     => 'required|integer',
                'authCode'   => 'required|string|max:4|min:4',
                'authCount'  => 'required|integer',
                'authStatus' => 'required|boolean',
            ],
            $merge
        );
    }
}
