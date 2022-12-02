<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\UserActivation;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected string $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function resetPassword($user, $password): void
    {
        $validatingGroup = \cache()->rememberForever('validating_group', fn () => Group::where('slug', '=', 'validating')->pluck('id'));
        $memberGroup = \cache()->rememberForever('member_group', fn () => Group::where('slug', '=', 'user')->pluck('id'));
        $user->password = \bcrypt($password);
        $user->remember_token = Str::random(60);

        if ($user->group_id === $validatingGroup[0]) {
            $user->group_id = $memberGroup[0];
        }

        $user->active = true;
        $user->save();

        UserActivation::where('user_id', '=', $user->id)->delete();

        $this->guard()->login($user);
    }
}
