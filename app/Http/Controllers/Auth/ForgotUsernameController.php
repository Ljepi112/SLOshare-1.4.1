<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\UsernameReminder;
use Illuminate\Http\Request;

/**
 * @see \Tests\Feature\Http\Controllers\Auth\ForgotUsernameControllerTest
 */
class ForgotUsernameController extends Controller
{
    /**
     * Forgot Username Form.
     */
    public function showForgotUsernameForm(): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return \view('auth.username');
    }

    /**
     * Send Username Reminder.
     */
    public function sendUsernameReminder(Request $request): \Illuminate\Http\RedirectResponse
    {
        $email = $request->get('email');

        if (! \config('captcha.enabled')) {
            $v = \validator($request->all(), [
                'email' => 'required',
            ]);
        } else {
            $v = \validator($request->all(), [
                'email'   => 'required',
                'captcha' => 'hiddencaptcha',
            ]);
        }

        if ($v->fails()) {
            return \to_route('username.request')
                ->withErrors($v->errors());
        }

        $user = User::where('email', '=', $email)->first();
        if (empty($user)) {
            return \to_route('username.request')
                ->withErrors(\trans('email.no-email-found'));
        }

        //send username reminder notification
        $user->notify(new UsernameReminder());

        return \to_route('login')
            ->withSuccess(\trans('email.username-sent'));
    }
}
