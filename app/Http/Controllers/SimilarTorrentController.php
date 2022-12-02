<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Cartoon;
use App\Models\Torrent;
use App\Models\Tv;
use App\Models\Cartoontv;

class SimilarTorrentController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(int $categoryId, int $tmdbId): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $torrent = Torrent::where('category_id', '=', $categoryId)
            ->where('tmdb', '=', $tmdbId)
            ->first();

        \abort_if(! $torrent || $torrent->count() === 0, 404, 'Podobni Torrenti niso najdeni');

        $meta = null;
        if ($torrent->category->tv_meta) {
            $meta = Tv::with('genres', 'cast', 'networks', 'seasons')->where('id', '=', $tmdbId)->first();
        }

        if ($torrent->category->movie_meta) {
            $meta = Movie::with('genres', 'cast', 'companies', 'collection')->where('id', '=', $tmdbId)->first();
        }

        if ($torrent->category->cartoon_meta) {
            $meta = Cartoon::with('genres', 'cast', 'companies', 'collection')->where('id', '=', $tmdbId)->first();
        }

        if ($torrent->category->cartoontv_meta) {
            $meta = Cartoontv::with('genres', 'cast', 'companies', 'collection')->where('id', '=', $tmdbId)->first();
        }

        return \view('torrent.similar', [
            'meta'       => $meta,
            'torrent'    => $torrent,
            'categoryId' => $categoryId,
            'tmdbId'     => $tmdbId,
        ]);
    }
}
