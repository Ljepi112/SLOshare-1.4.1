<?php

namespace App\Http\Controllers\MediaHub;

use App\Http\Controllers\Controller;
use App\Models\Company;

class CompanyController extends Controller
{
    /**
     * Display All Companies.
     */
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return \view('mediahub.company.index');
    }

    /**
     * Show A Company.
     */
    public function show(int $id): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $company = Company::withCount('tv', 'movie', 'cartoon', 'cartoontv')->findOrFail($id);
        $shows = $company->tv()->oldest('name')->paginate(25);
        $movies = $company->movie()->oldest('title')->paginate(25);
        $cartoons = $company->cartoon()->oldest('title')->paginate(25);
        $showscartoon = $company->cartoontv()->oldest('name')->paginate(25);

        return \view('mediahub.company.show', [
            'company' => $company,
            'shows'   => $shows,
            'movies'  => $movies,
            'cartoons'=> $cartoons,
            'showscartoon'   => $showscartoon,
        ]);
    }
}
