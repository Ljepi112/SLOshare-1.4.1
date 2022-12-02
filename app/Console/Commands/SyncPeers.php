<?php

namespace App\Console\Commands;

use App\Models\Peer;
use App\Models\Torrent;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

/**
 * @see \Tests\Unit\Console\Commands\SyncPeersTest
 */
class SyncPeers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:sync_peers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Popravi štetje torrent Seeders/Leechers (Peers) zaradi nesprejemanja zaustavljenega dogodka od stranke.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Torrent::withAnyStatus()
            ->leftJoinSub(
                Peer::query()
                    ->select('torrent_id')
                    ->addSelect(DB::raw('sum(case when peers.left = 0 then 1 else 0 end) as updated_seeders'))
                    ->addSelect(DB::raw('sum(case when peers.left <> 0 then 1 else 0 end) as updated_leechers'))
                    ->groupBy('torrent_id'),
                'seeders_leechers',
                fn ($join) => $join->on('torrents.id', '=', 'seeders_leechers.torrent_id')
            )
            ->update([
                'seeders'  => DB::raw('COALESCE(seeders_leechers.updated_seeders, 0)'),
                'leechers' => DB::raw('COALESCE(seeders_leechers.updated_leechers, 0)'),
            ]);

        $this->comment('Ukaz za sinhronizacijo Torrentov je končan');
    }
}
