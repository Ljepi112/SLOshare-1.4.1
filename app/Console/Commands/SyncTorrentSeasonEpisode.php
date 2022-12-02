<?php

namespace App\Console\Commands;

use App\Models\Torrent;
use Illuminate\Console\Command;

class SyncTorrentSeasonEpisode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:sync_torrent_season_episode';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sinhronizira številke sezone in epizod iz torrent naslovov v zbirko podatkov';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        foreach (Torrent::withAnyStatus()->with(['category'])->whereNull('season_number')->orWhereNull('episode_number')->get() as $torrent) {
            // Skip if not TV
            if (! $torrent->category->tv_meta) {
                continue;
            }

            if (preg_match('~\.{0,1}S(?<season>\d+)\.{0,1}( ){0,1}E(?<episode>\d+)~', (string) $torrent->name, $match)) {
                // Match SxxExx, Sxx.Exx, Sxx Exx (Single Episodes)
                $torrent->season_number = (int) $match['season'];
                $torrent->episode_number = (int) $match['episode'];
                $torrent->save();
            } elseif (preg_match('~\.{0,1}S(?<season>\d+)\.{0,1}( )~', (string) $torrent->name, $match)) {
                // Match Sxx (Complete Seasons)
                $torrent->season_number = (int) $match['season'];
                $torrent->episode_number = 0;
                $torrent->save();
            } elseif (preg_match('~\.{0,1}( ){0,1}E(?<episode>\d+)~', (string) $torrent->name, $match)) {
                // Match Exx (Single Episode without Season Number)
                $torrent->season_number = 1;
                $torrent->episode_number = (int) $match['episode'];
                $torrent->save();
            }
        }

        $this->comment('Torrent Sezone in Epizode sinhronizacija je ukaz dokončan');
    }
}
