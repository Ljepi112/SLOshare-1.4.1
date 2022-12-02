<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Seedbox;
use Illuminate\Http\Request;

/**
 * @see \Tests\Todo\Feature\Http\Controllers\SeedboxControllerTest
 */
class SeedboxController extends Controller
{
    /**
     * Display All Registered Seedboxes.
     */
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $seedboxes = Seedbox::with('user')->latest()->paginate(50);

        return \view('Staff.seedbox.index', ['seedboxes' => $seedboxes]);
    }

    /**
     * Delete A Registered Seedbox.
     *
     * @throws \Exception
     */
    public function destroy(Request $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $user = $request->user();
        $seedbox = Seedbox::findOrFail($id);

        \abort_unless($user->group->is_modo, 403);
        $seedbox->delete();

        return \to_route('staff.seedboxes.index')
            ->withSuccess('Seedbox zapis je bil uspešno izbrisan');
    }
}
