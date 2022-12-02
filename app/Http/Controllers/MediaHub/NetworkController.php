<?php

namespace App\Http\Controllers\MediaHub;

use App\Http\Controllers\Controller;
use App\Models\Network;

class NetworkController extends Controller
{
    /**
     * Display All Networks.
     */
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return \view('mediahub.network.index');
    }

    /**
     * Show A Network.
     */
    public function show(int $id): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $network = Network::withCount('tv')->findOrFail($id);
        $shows = $network->tv()->oldest('name')->paginate(25);

        return \view('mediahub.network.show', [
            'network' => $network,
            'shows'   => $shows,
        ]);
    }
}
