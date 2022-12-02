<?php

namespace App\Http\Controllers;

use App\Mail\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

/**
 * @see \Tests\Feature\Http\Controllers\ContactControllerTest
 */
class ContactController extends Controller
{
    /**
     * Contact Form.
     */
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return \view('contact.index');
    }

    /**
     * Send A Contact Email To Owner/First User.
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        // Fetch owner account
        $user = User::where('username', \config('sloshare.owner-username'))->first();

        $input = $request->all();
        Mail::to($user->email)->send(new Contact($input));

        return \to_route('home.index')
            ->withSuccess(\trans('sloshare.success'));
    }
}
