<?php

namespace App\Http\Middleware;

use Closure;

class CheckForModo
{
    /**
     * Handle an incoming request.
     */
    public function handle(\Illuminate\Http\Request $request, Closure $next): mixed
    {
        \abort_unless($request->user()->group->is_modo, 403);

        return $next($request);
    }
}
