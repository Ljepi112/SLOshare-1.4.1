<?php

namespace App\Http\Controllers\MediaHub;

use App\Http\Controllers\Controller;
use App\Models\Cartoontv;

class CartoontvShowController extends Controller
{
    /**
     * Display All Cartoon TV Shows.
     */
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return \view('mediahub.cartoontv.index');
    }

    /**
     * Show A Cartoon TV Show.
     */
    public function show(int $id): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $show = Cartoontv::with(['seasons', 'genres', 'networks', 'companies', 'torrents'])->withCount('torrents')->findOrFail($id);

        return \view('mediahub.cartoontv.show', [
            'show' => $show,
        ]);
    }
}
