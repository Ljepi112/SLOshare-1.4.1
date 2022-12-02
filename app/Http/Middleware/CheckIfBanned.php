<?php

namespace App\Http\Middleware;

use App\Models\Group;
use Closure;

class CheckIfBanned
{
    /**
     * Handle an incoming request.
     *
     * @throws \Exception
     */
    public function handle(\Illuminate\Http\Request $request, Closure $next, ?string $guard = null): mixed
    {
        $user = $request->user();
        $bannedGroup = \cache()->rememberForever('banned_group', fn () => Group::where('slug', '=', 'banned')->pluck('id'));

        if ($user && (is_countable($bannedGroup) ? count($bannedGroup) : 0) > 0 && $user->group_id === $bannedGroup[0]) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => __('auth.banned'),
                ]);
            }
            \auth()->logout();
            $request->session()->flush();

            return \to_route('login')
                ->withErrors(__('auth.banned'));
        }

        return $next($request);
    }
}
