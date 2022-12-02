<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\UserActivation;

/**
 * @see \Tests\Feature\Http\Controllers\Auth\ActivationControllerTest
 */
class ActivationController extends Controller
{
    public function activate($token): \Illuminate\Http\RedirectResponse
    {
        $bannedGroup = \cache()->rememberForever('banned_group', fn () => Group::where('slug', '=', 'banned')->pluck('id'));
        $memberGroup = \cache()->rememberForever('member_group', fn () => Group::where('slug', '=', 'user')->pluck('id'));

        $activation = UserActivation::with('user')->where('token', '=', $token)->firstOrFail();
        if ($activation->user->id && $activation->user->group->id != $bannedGroup[0]) {
            $activation->user->active = 1;
            $activation->user->can_upload = 1;
            $activation->user->can_download = 1;
            $activation->user->can_request = 1;
            $activation->user->can_comment = 1;
            $activation->user->can_invite = 1;
            $activation->user->group_id = $memberGroup[0];
            $activation->user->save();

            $activation->delete();

            return \to_route('login')
                ->withSuccess(\trans('auth.activation-success'));
        }

        return \to_route('login')
            ->withErrors(\trans('auth.activation-error'));
    }
}
