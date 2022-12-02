<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

/**
 * @see \Tests\Todo\Feature\Http\Controllers\Staff\BackupControllerTest
 */
class BackupController extends Controller
{
    /**
     * Display All Backups.
     */
    public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $user = $request->user();
        \abort_unless($user->group->is_owner, 403);

        return \view('Staff.backup.index');
    }
}
