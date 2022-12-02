<?php

namespace App\Http\Controllers\MediaHub;

use App\Http\Controllers\Controller;
use App\Models\Genre;

class GenreController extends Controller
{
    /**
     * Display All Genres.
     */
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $genres = Genre::paginate(25);

        return \view('mediahub.genre.index', ['genres' => $genres]);
    }

    /**
     * Show A Genre.
     */
    public function show(int $id): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $genre = Genre::withCount(['tv', 'movie', 'cartoon', 'cartoontv'])->findOrFail($id);
        $shows = $genre->tv()->oldest('name')->paginate(25);
        $movies = $genre->movie()->oldest('title')->paginate(25);
        $cartoons = $genre->cartoon()->oldest('title')->paginate(25);
        $showscartoon = $genre->cartoontv()->oldest('name')->paginate(25);

        return \view('mediahub.genre.show', [
            'genre'  => $genre,
            'shows'  => $shows,
            'movies' => $movies,
            'cartoons' => $cartoons,
            'showscartoon'  => $showscartoon,
        ]);
    }
}
