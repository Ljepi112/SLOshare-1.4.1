<?php

namespace App\Http\Middleware;

use Closure;

class CheckForOwner
{
    /**
     * Handle an incoming request.
     */
    public function handle(\Illuminate\Http\Request $request, Closure $next): mixed
    {
        \abort_unless($request->user()->group->is_owner, 403);

        return $next($request);
    }
}
