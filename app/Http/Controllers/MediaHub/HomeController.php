<?php

namespace App\Http\Controllers\MediaHub;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\Company;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Cartoon;
use App\Models\Network;
use App\Models\Person;
use App\Models\Tv;

class HomeController extends Controller
{
    /**
     * Display Media Hubs.
     */
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $tv = Tv::count();
        $movies = Movie::count();
        $cartoons = Cartoon::count();
        $collections = Collection::count();
        $persons = Person::whereNotNull('still')->count();
        $genres = Genre::count();
        $networks = Network::count();
        $companies = Company::count();

        return \view('mediahub.index', [
            'tv'          => $tv,
            'movies'      => $movies,
            'cartoons'    => $cartoons,
            'collections' => $collections,
            'persons'     => $persons,
            'genres'      => $genres,
            'networks'    => $networks,
            'companies'   => $companies,
        ]);
    }
}
