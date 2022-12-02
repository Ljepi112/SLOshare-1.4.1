<?php

namespace App\Console\Commands;

use App\Models\Peer;
use App\Models\Seedbox;
use App\Models\Torrent;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

/**
 * @see \Tests\Unit\Console\Commands\AutoHighspeedTagTest
 */
class AutoHighspeedTag extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:highspeed_tag';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Posodobitve Torrents Highspeed Tag, ki temeljijo na registriranih Seedboxes.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $seedboxIps = Seedbox::all()->pluck('ip')->filter(fn ($ip) => filter_var($ip, FILTER_VALIDATE_IP));

        Torrent::withAnyStatus()
            ->leftJoinSub(
                Peer::distinct()
                    ->select('torrent_id')
                    ->whereRaw("ip IN ('".$seedboxIps->implode("','")."')"),
                'highspeed_torrents',
                fn ($join) => $join->on('torrents.id', '=', 'highspeed_torrents.torrent_id')
            )
            ->update([
                'highspeed' => DB::raw('CASE WHEN highspeed_torrents.torrent_id IS NOT NULL THEN 1 ELSE 0 END'),
            ]);

        $this->comment('Ukaz za avtomatizirane hitre torrente je dokončan');
    }
}
