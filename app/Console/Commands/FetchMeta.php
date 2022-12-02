<?php

namespace App\Console\Commands;

use App\Models\Torrent;
use App\Services\Tmdb\TMDBScraper;
use Illuminate\Console\Command;

class FetchMeta extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'fetch:meta';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pridobite metapodatke za nov sistem na že obstoječih Torrentih';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->alert('Meta Pridobivanje se je začela');

        $tmdbScraper = new TMDBScraper();
        $torrents = Torrent::with('category')->select('tmdb', 'category_id')->whereNotNull('tmdb')->where('tmdb', '!=', 0)->oldest()->get();
        foreach ($torrents as $torrent) {
            if ($torrent->category->tv_meta) {
                $tmdbScraper->tv($torrent->tmdb);
                $this->info('TV je pridobljeno');
            }

            if ($torrent->category->cartoontv_meta) {
                $tmdbScraper->cartoontv($torrent->tmdb);
                $this->info('Serije Risank je pridobljeno');
            }

            if ($torrent->category->movie_meta) {
                $tmdbScraper->movie($torrent->tmdb);
                $this->info('Film je pridobljen');
            }

            if ($torrent->category->cartoon_meta) {
                $tmdbScraper->cartoon($torrent->tmdb);
                $this->info('Risanka je pridobljen');
            }
        }

        $this->alert('Meta Pridobivanje je končano');
    }
}
