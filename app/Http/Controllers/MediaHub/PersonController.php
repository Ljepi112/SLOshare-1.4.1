<?php

namespace App\Http\Controllers\MediaHub;

use App\Http\Controllers\Controller;
use App\Models\Person;

class PersonController extends Controller
{
    /**
     * Display All Persons.
     */
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return \view('mediahub.person.index');
    }

    /**
     * Show A Person.
     */
    public function show(int $id): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $details = Person::findOrFail($id);
        $credits = Person::with(['tv', 'season', 'episode', 'movie', 'cartoon', 'cartoontv'])->findOrFail($id);

        return \view('mediahub.person.show', ['credits' => $credits, 'details' => $details]);
    }
}
