<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Watchlist;
use Illuminate\Http\Request;

/**
 * @see \Tests\Todo\Feature\Http\Controllers\WatchlistControllerTest
 */
class WatchlistController extends Controller
{
    /**
     * Watchlist.
     */
    final public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return \view('Staff.watchlist.index');
    }

    /**
     * Store A New Watched User.
     */
    final public function store(Request $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $watchedUser = new Watchlist();
        $watchedUser->user_id = $id;
        $watchedUser->staff_id = $request->user()->id;
        $watchedUser->message = $request->input('message');

        $v = \validator($watchedUser->toArray(), [
            'user_id'  => 'required|exists:users,id',
            'staff_id' => 'required|exists:users,id',
            'message'  => 'required|min:3',
        ]);

        if ($v->fails()) {
            return \to_route('staff.watchlist.index')
                ->withErrors($v->errors());
        }

        $watchedUser->save();

        return \to_route('staff.watchlist.index')
            ->withSuccess('Uporabnik je uspešno nadzorovan');
    }

    /**
     * Delete A Watched User.
     *
     * @throws \Exception
     */
    final public function destroy(int $id): \Illuminate\Http\RedirectResponse
    {
        $watchedUser = Watchlist::findOrFail($id);
        $watchedUser->delete();

        return \to_route('staff.watchlist.index')
            ->withSuccess('Uporabnika je uspešno prenehalo nadzorovati');
    }
}
