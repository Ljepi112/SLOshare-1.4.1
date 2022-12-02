<?php

namespace App\Http\Controllers\MediaHub;

use App\Http\Controllers\Controller;
use App\Models\Cartoon;
use App\Models\PersonalFreeleech;
use Illuminate\Http\Request;

class CartoonController extends Controller
{
    /**
     * Display All Cartoon.
     */
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return \view('mediahub.cartoon.index');
    }

    /**
     * Show A Cartoon.
     */
    public function show(Request $request, int $id): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $user = $request->user();
        $personalFreeleech = PersonalFreeleech::where('user_id', '=', $user->id)->first();
        $cartoon = Cartoon::with(['cast', 'collection', 'genres', 'companies'])->findOrFail($id);

        return \view('mediahub.cartoon.show', [
            'cartoon'            => $cartoon,
            'user'               => $user,
            'personal_freeleech' => $personalFreeleech,
        ]);
    }
}
