<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use App\Notifications\NewFollow;
use App\Notifications\NewUnfollow;
use Illuminate\Http\Request;

/**
 * @see \Tests\Feature\Http\Controllers\FollowControllerTest
 */
class FollowController extends Controller
{
    /**
     * Follow A User.
     */
    public function store(Request $request, string $username): \Illuminate\Http\RedirectResponse
    {
        $user = User::where('username', '=', $username)->firstOrFail();

        if ($request->user()->id == $user->id) {
            return \to_route('users.show', ['username' => $user->username])
                ->withErrors(\trans('user.follow-yourself'));
        }

        if (! $request->user()->isFollowing($user->id)) {
            $follow = new Follow();
            $follow->user_id = $request->user()->id;
            $follow->target_id = $user->id;
            $follow->save();
            if ($user->acceptsNotification($request->user(), $user, 'account', 'show_account_follow')) {
                $user->notify(new NewFollow('user', $request->user(), $user, $follow));
            }

            return \to_route('users.show', ['username' => $user->username])
                ->withSuccess(\sprintf(\trans('user.follow-user'), $user->username));
        }

        return \to_route('users.show', ['username' => $user->username])
            ->withErrors(\trans('user.follow-already'));
    }

    /**
     * Un Follow A User.
     */
    public function destroy(Request $request, string $username): \Illuminate\Http\RedirectResponse
    {
        $user = User::where('username', '=', $username)->firstOrFail();

        if ($request->user()->isFollowing($user->id)) {
            $follow = $request->user()->follows()->where('target_id', '=', $user->id)->first();
            $follow->delete();
            if ($user->acceptsNotification($request->user(), $user, 'account', 'show_account_unfollow')) {
                $user->notify(new NewUnfollow('user', $request->user(), $user, $follow));
            }

            return \to_route('users.show', ['username' => $user->username])
                ->withSuccess(\sprintf(\trans('user.follow-revoked'), $user->username));
        }

        return \to_route('users.show', ['username' => $user->username])
            ->withErrors(\trans('user.follow-not-to-begin-with'));
    }
}
