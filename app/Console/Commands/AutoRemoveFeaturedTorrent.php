<?php

namespace App\Console\Commands;

use App\Models\FeaturedTorrent;
use App\Models\Torrent;
use App\Repositories\ChatRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

/**
 * @see \Tests\Unit\Console\Commands\AutoRemoveFeaturedTorrentTest
 */
class AutoRemoveFeaturedTorrent extends Command
{
    /**
     * AutoRemoveFeaturedTorrent Constructor.
     */
    public function __construct(private readonly ChatRepository $chatRepository)
    {
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:remove_featured_torrent';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Samodejno odstrani predstavljene torrente, če je potekel';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $current = Carbon::now();
        $featuredTorrents = FeaturedTorrent::where('created_at', '<', $current->copy()->subDays(7)->toDateTimeString())->get();

        foreach ($featuredTorrents as $featuredTorrent) {
            // Find The Torrent
            $torrent = Torrent::where('featured', '=', 1)->where('id', '=', $featuredTorrent->torrent_id)->first();
            if (isset($torrent)) {
                $torrent->free = 0;
                $torrent->doubleup = 0;
                $torrent->featured = 0;
                $torrent->save();

                // Auto Announce Featured Expired
                $appurl = \config('app.url');

                $this->chatRepository->systemMessage(
                    \sprintf('Dame in gospodje, [url=%s/torrents/%s]%s[/url] ni več predstavljen. :poop:', $appurl, $torrent->id, $torrent->name)
                );
            }

            // Delete The Record From DB
            $featuredTorrent->delete();
        }

        $this->comment('Ukaz za samodejno odstranjevanje predstavljenih torrentov je končan');
    }
}
