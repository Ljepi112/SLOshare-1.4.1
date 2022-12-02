<?php

namespace App\Console\Commands;

use App\Models\Torrent;
use App\Models\History;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AutoTorrentBalance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:torrent_balance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Izračunaj stanje za vse torrente.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Torrent::joinSub(
            History::query()
                ->select('torrent_id')
                ->selectRaw('SUM(actual_uploaded) - SUM(actual_downloaded) AS balance')
                ->groupBy('torrent_id'),
            'balances',
            fn ($join) => $join->on('balances.torrent_id', '=', 'torrents.id')
        )
            ->update(['torrents.balance' => DB::raw('balances.balance')]);

        $this->comment('Izračun stanja torrenta je končan.');
    }
}
