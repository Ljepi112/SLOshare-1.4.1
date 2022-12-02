<?php

namespace App\Console\Commands;

use App\Models\Torrent;
use App\Repositories\ChatRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

/**
 * @see \Tests\Unit\Console\Commands\AutoRemoveTimedTorrentBuffs
 */
class AutoRemoveTimedTorrentBuffs extends Command
{
    /**
     * AutoRemoveTimedTorrentBuffs Constructor.
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
    protected $signature = 'auto:remove_torrent_buffs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Samodejno odstrani torrent buffs, če je poteklo';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $appurl = \config('app.url');

        $flTorrents = Torrent::whereNotNull('fl_until')->where('fl_until', '<', Carbon::now()->toDateTimeString())->get();

        foreach ($flTorrents as $torrent) {
            if (isset($torrent)) {
                $torrent->free = 0;
                $torrent->fl_until = null;
                $torrent->save();

                // Announce To Chat
                $this->chatRepository->systemMessage(
                    \sprintf('Dame in Gospodje, [url=%s/torrents/%s]%s[/url] čas Freeleech buff je potekel.', $appurl, $torrent->id, $torrent->name)
                );
            }
        }

        $duTorrents = Torrent::whereNotNull('du_until')->where('du_until', '<', Carbon::now()->toDateTimeString())->get();

        foreach ($duTorrents as $torrent) {
            if (isset($torrent)) {
                $torrent->doubleup = 0;
                $torrent->du_until = null;
                $torrent->save();

                // Announce To Chat
                $this->chatRepository->systemMessage(
                    \sprintf('Dame in Gospodje, [url=%s/torrents/%s]%s[/url] časovno dvojno nalaganje buff je poteklo.', $appurl, $torrent->id, $torrent->name)
                );
            }
        }

        $this->comment('Samodejno odstranjevanje potekle Torrent buffs ukaz dokončan');
    }
}
