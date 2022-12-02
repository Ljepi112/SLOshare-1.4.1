<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Torrent;
use Illuminate\Support\Facades\DB;

class CheatedTorrentController extends Controller
{
    /**
     * Cheated Torrents.
     */
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $cheatedTorrents = Torrent::query()
            ->select([
                'id',
                'name',
                'seeders',
                'leechers',
                'times_completed',
                'size',
                'balance',
                'balance_offset',
                'created_at',
            ])
            ->selectRaw('balance + balance_offset AS current_balance')
            ->selectRaw('(CAST((balance + balance_offset) AS float) / CAST((size + 1) AS float)) AS times_cheated')
            ->having('current_balance', '<>', '0')
            ->orderByDesc('times_cheated')
            ->paginate(25);

        return \view('Staff.cheated_torrent.index', ['torrents' => $cheatedTorrents]);
    }

    /**
     * Reset the balance of a cheated torrent.
     */
    public function destroy(int $id): \Illuminate\Http\RedirectResponse
    {
        Torrent::where('id', '=', $id)->update(['balance_offset' => DB::raw('balance * -1')]);

        return \to_route('staff.cheated_torrents.index')
            ->withSuccess('Stanje je uspešno ponastavljeno');
    }

    /**
     * Reset the balance of a cheated torrent.
     */
    public function massDestroy(): \Illuminate\Http\RedirectResponse
    {
        Torrent::query()->update(['balance_offset' => DB::raw('balance * -1')]);

        return \to_route('staff.cheated_torrents.index')
            ->withSuccess('Vsa stanja so bila uspešno ponastavljena');
    }
}
