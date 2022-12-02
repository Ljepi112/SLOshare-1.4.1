<?php

namespace App\Http\Middleware;

use Closure;

class UpdateLastAction
{
    /**
     * Handle an incoming request.
     */
    public function handle(\Illuminate\Http\Request $request, Closure $next): mixed
    {
        if (! $user = $request->user()) {
            return $next($request);
        }

        $user->last_action = \now();
        $user->save();

        return $next($request);
    }
}
