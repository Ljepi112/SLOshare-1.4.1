<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\PrivateMessage;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * @see \Tests\Feature\Http\Controllers\Staff\GiftControllerTest
 */
class GiftController extends Controller
{
    /**
     * Send Gift Form.
     */
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return \view('Staff.gift.index');
    }

    /**
     * Send The Gift.
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $staff = $request->user();

        $username = $request->input('username');
//        $seedbonus = $request->input('seedbonus');
//        $invites = $request->input('invites');
//        $flTokens = $request->input('fl_tokens');
        $uploaded = $request->input('uploaded');

        $v = \validator($request->all(), [
            'username'  => 'required|exists:users,username|max:180',
//            'seedbonus' => 'required|numeric|min:0',
//            'invites'   => 'required|numeric|min:0',
//            'fl_tokens' => 'required|numeric|min:0',
            'uploaded' => 'required|numeric|min:0',
        ]);

        if ($v->fails()) {
            return \to_route('staff.gifts.index')
                ->withErrors($v->errors());
        }

        $recipient = User::where('username', '=', $username)->first();
        if (! $recipient) {
            return \to_route('staff.gifts.index')
                ->withErrors('Določenega uporabnika ni mogoče najti');
        }

//        $recipient->seedbonus += $seedbonus;
//        $recipient->invites += $invites;
//        $recipient->fl_tokens += $flTokens;
        $recipient->uploaded += $uploaded;
        $recipient->save();
        // Send Private Message
        $privateMessage = new PrivateMessage();
        $privateMessage->sender_id = 1;
        $privateMessage->receiver_id = $recipient->id;
        $privateMessage->subject = 'Prejeli ste sistemsko ustvarjeno darilo';
        $privateMessage->message = \sprintf('Želeli smo vas samo obvestiti o nagradi, %s prijeli ste na vaš račun %s (Bytes) Uploaded.
                                [color=red][b]TO JE AVTOMATIZOVANO SISTEMSKO SPOROČILO, PROSIMO, NE ODGOVARAJTE![/b][/color]', $staff->username, $uploaded);
        $privateMessage->save();

        return \to_route('staff.gifts.index')
            ->withSuccess('Darilo poslano');
    }
}
