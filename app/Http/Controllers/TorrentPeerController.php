<?php

namespace App\Http\Controllers;

use App\Models\Peer;
use App\Models\Torrent;

class TorrentPeerController extends Controller
{
    /**
     * Display Peers Of A Torrent.
     */
    public function index(int $id): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $torrent = Torrent::withAnyStatus()->findOrFail($id);
        $peers = Peer::query()
            ->with(['user'])
            ->where('torrent_id', '=', $id)
            ->latest('seeder')
            ->get()
            ->map(function ($peer) use ($torrent) {
                $progress = 100 * (1 - $peer->left / $torrent->size);
                $peer['progress'] = match (true) {
                    0 < $progress && $progress < 1    => 1,
                    99 < $progress && $progress < 100 => 99,
                    default                           => round($progress),
                };

                return $peer;
            });

        return \view('torrent.peers', ['torrent' => $torrent, 'peers' => $peers]);
    }
}
