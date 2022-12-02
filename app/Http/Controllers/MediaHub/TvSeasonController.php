<?php

namespace App\Http\Controllers\MediaHub;

use App\Http\Controllers\Controller;
use App\Models\Season;
use App\Models\Tv;

class TvSeasonController extends Controller
{
    /**
     * Show A TV Season.
     */
    public function show(int $id): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $season = Season::with(['episodes', 'torrents'])->findOrFail($id);
        $show = Tv::where('id', '=', $season->tv_id)->first();

        return \view('mediahub.tv.season.show', [
            'season' => $season,
            'show'   => $show,
        ]);
    }
}
