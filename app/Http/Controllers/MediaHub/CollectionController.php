<?php

namespace App\Http\Controllers\MediaHub;

use App\Http\Controllers\Controller;
use App\Models\Collection;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return \view('mediahub.collection.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $collection = Collection::with(['movie', 'cartoon', 'comments'])->findOrFail($id);

        return \view('mediahub.collection.show', [
            'collection' => $collection,
        ]);
    }
}
