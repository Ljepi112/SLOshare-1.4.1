<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FailedLoginAttempt extends Model
{
    use HasFactory;

    /**
     * The Attributes That Are Mass Assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'username',
        'ip_address',
    ];

    public static function record($user, $username, $ip): mixed
    {
        return static::create([
            'user_id'    => \is_null($user) ? null : $user->id,
            'username'   => $username,
            'ip_address' => $ip,
        ]);
    }
}
