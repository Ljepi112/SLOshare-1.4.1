<?php

namespace App\Http\Controllers;

class MissingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    final public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return \view('missing.index');
    }
}
