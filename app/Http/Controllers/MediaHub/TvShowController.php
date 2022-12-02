<?php

namespace App\Http\Controllers\MediaHub;

use App\Http\Controllers\Controller;
use App\Models\Tv;

class TvShowController extends Controller
{
    /**
     * Display All TV Shows.
     */
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return \view('mediahub.tv.index');
    }

    /**
     * Show A TV Show.
     */
    public function show(int $id): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $show = Tv::with(['seasons', 'genres', 'networks', 'companies', 'torrents'])->withCount('torrents')->findOrFail($id);

        return \view('mediahub.tv.show', [
            'show' => $show,
        ]);
    }
}
