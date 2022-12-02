<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

/*
 * |--------------------------------------------------------------------------
 * | Broadcast Channels
 * |--------------------------------------------------------------------------
 * |
 * | Here you may register all of the event broadcasting channels that your
 * | application supports. The given channel authorization callbacks are
 * | used to check if an authenticated user can listen to the channel.
 * |
 */

Broadcast::channel('chatroom.{id}', fn ($user, $id) => User::with(['chatStatus', 'chatroom', 'echoes', 'group'])
    ->find($user->id));
Broadcast::channel('chatter.{id}', fn ($user, $id) => $user->id == $id);
