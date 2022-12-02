<?php

namespace App\Console\Commands;

use App\Models\History;
use App\Models\Peer;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

/**
 * @see \Tests\Unit\Console\Commands\AutoFlushPeersTest
 */
class AutoFlushPeers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:flush_peers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Splahne Ghost Peers';

    /**
     * Execute the console command.
     *
     * @throws \Exception
     */
    public function handle(): void
    {
        $carbon = new Carbon();
        $peers = Peer::select(['id', 'torrent_id', 'user_id', 'updated_at'])->where('updated_at', '<', $carbon->copy()->subHours(2)->toDateTimeString())->get();

        foreach ($peers as $peer) {
            $history = History::where('torrent_id', '=', $peer->torrent_id)->where('user_id', '=', $peer->user_id)->first();
            if ($history) {
                $history->active = false;
                $history->save();
            }

            $peer->delete();
        }

        $this->comment('Avtomatiziran ukaz Flush Ghost Peers je dokončan');
    }
}
