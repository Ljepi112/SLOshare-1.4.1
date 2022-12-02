<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\FailedLoginAttempt;

/**
 * @see \Tests\Todo\Feature\Http\Controllers\Staff\AuthenticationControllerTest
 */
class AuthenticationController extends Controller
{
    /**
     * Authentications Log.
     */
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $attempts = FailedLoginAttempt::latest()->paginate(25);

        return \view('Staff.authentication.index', ['attempts' => $attempts]);
    }
}
