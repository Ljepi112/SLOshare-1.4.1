<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Invite;

/**
 * @see \Tests\Todo\Feature\Http\Controllers\InviteControllerTest
 */
class InviteController extends Controller
{
    /**
     * Invites Log.
     */
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $invites = Invite::latest()->paginate(25);
        $invitecount = Invite::count();

        return \view('Staff.invite.index', ['invites' => $invites, 'invitecount' => $invitecount]);
    }
}
