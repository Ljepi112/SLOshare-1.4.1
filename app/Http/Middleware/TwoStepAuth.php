<?php

namespace App\Http\Middleware;

use App\Traits\TwoStep;
use Closure;
use Illuminate\Http\Request;

class TwoStepAuth
{
    use TwoStep;

    /**
     * Handle an incoming request.
     *
     * @throws \Exception
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $response = $next($request);
        $uri = $request->path();
        $nextUri = \config('app.url').'/'.$uri;
        $user = $request->user();

        switch ($uri) {
            case 'twostep/needed':
            case 'password/reset':
            case 'register':
            case 'logout':
            case 'login':
                break;

            default:
                \session(['nextUri' => $nextUri]);

                if (\config('auth.TwoStepEnabled') && $user->twostep == 1 && ! $this->twoStepVerification()) {
                    return \to_route('verificationNeeded');
                }

                break;
        }

        return $response;
    }
}
