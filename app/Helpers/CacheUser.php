<?php

namespace App\Helpers;

use App\Models\User;

class CacheUser
{
    public static function user($id)
    {
        if (! $id || $id <= 0 || ! is_numeric($id)) {
            return;
        }

        return \cache()->remember('cachedUser.'.$id, 30, fn () => User::find($id));
    }
}
