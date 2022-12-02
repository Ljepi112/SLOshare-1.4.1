<?php

namespace App\Observers;

use App\Models\Torrent;

class TorrentObserver
{
    /**
     * Handle the Torrent "created" event.
     */
    public function created(Torrent $torrent): void
    {
        \cache()->put(\sprintf('torrent:%s', $torrent->info_hash), $torrent);
    }

    /**
     * Handle the Torrent "updated" event.
     */
    public function updated(Torrent $torrent): void
    {
        \cache()->forget(\sprintf('torrent:%s', $torrent->info_hash));
        \cache()->put(\sprintf('torrent:%s', $torrent->info_hash), $torrent);
    }

    /**
     * Handle the Torrent "deleted" event.
     */
    public function deleted(Torrent $torrent): void
    {
        \cache()->forget(\sprintf('torrent:%s', $torrent->info_hash));
    }

    /**
     * Handle the Torrent "restored" event.
     */
    public function restored(Torrent $torrent): void
    {
        \cache()->put(\sprintf('torrent:%s', $torrent->info_hash), $torrent);
    }
}
