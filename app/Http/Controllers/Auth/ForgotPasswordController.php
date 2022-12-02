<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validateEmail(Request $request): void
    {
        if (! \config('captcha.enabled')) {
            $request->validate(['email' => 'required|email']);
        } else {
            $request->validate([
                'email'   => 'required|email',
                'captcha' => 'hiddencaptcha',
            ]);
        }
    }
}
