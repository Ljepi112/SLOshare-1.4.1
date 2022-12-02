<?php

namespace App\Console\Commands;

use App\Models\Movie;
use App\Models\Cartoon;
use App\Models\Torrent;
use App\Models\Tv;
use App\Models\Cartoontv;
use Illuminate\Console\Command;

/**
 * @see \Tests\Todo\Unit\Console\Commands\FetchReleaseYearsTest
 */
class FetchReleaseYears extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:release_years';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pridobite leta izdaje za torrente v DB';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $appurl = \config('app.url');

        $torrents = Torrent::withAnyStatus()
            ->with(['category'])
            ->select(['id', 'name', 'category_id', 'tmdb', 'release_year'])
            ->whereNull('release_year')
            ->get();

        $withyear = Torrent::withAnyStatus()
            ->whereNotNull('release_year')
            ->count();

        $withoutyear = Torrent::withAnyStatus()
            ->whereNull('release_year')
            ->count();

        $this->alert(\sprintf('%s Torrenti že imajo vrednost leta izdaj!', $withyear));
        $this->alert(\sprintf('%s Torrentom manjka vrednost leta izdaje!', $withoutyear));

        foreach ($torrents as $torrent) {
            $meta = null;
            if ($torrent->category->tv_meta && $torrent->tmdb && $torrent->tmdb != 0) {
                $meta = Tv::where('id', '=', $torrent->tmdb)->first();
                if (isset($meta->first_air_date) && \substr($meta->first_air_date, 0, 4) > '1900') {
                    $torrent->release_year = \substr($meta->first_air_date, 0, 4);
                    $torrent->save();
                    $this->info(\sprintf('(%s) Leto izdaje pridobljeno za Torrent %s ', $torrent->category->name, $torrent->name));
                } else {
                    $this->warn(\sprintf('(%s) Za Torrent ni bilo najdenega leta izdaje %s %s/torrents/%s', $torrent->category->name, $torrent->name, $appurl, $torrent->id));
                }
            }

            if ($torrent->category->cartoontv_meta && $torrent->tmdb && $torrent->tmdb != 0) {
                $meta = Cartoontv::where('id', '=', $torrent->tmdb)->first();
                if (isset($meta->first_air_date) && \substr($meta->first_air_date, 0, 4) > '1900') {
                    $torrent->release_year = \substr($meta->first_air_date, 0, 4);
                    $torrent->save();
                    $this->info(\sprintf('(%s) Leto izdaje pridobljeno za Torrent %s ', $torrent->category->name, $torrent->name));
                } else {
                    $this->warn(\sprintf('(%s) Za Torrent ni bilo najdenega leta izdaje %s %s/torrents/%s', $torrent->category->name, $torrent->name, $appurl, $torrent->id));
                }
            }

            if ($torrent->category->movie_meta && $torrent->tmdb && $torrent->tmdb != 0) {
                $meta = Movie::where('id', '=', $torrent->tmdb)->first();
                if (isset($meta->release_date) && \substr($meta->release_date, 0, 4) > '1900') {
                    $torrent->release_year = \substr($meta->release_date, 0, 4);
                    $torrent->save();
                    $this->info(\sprintf('(%s) Leto izdaje pridobljeno za Torrent %s ', $torrent->category->name, $torrent->name));
                } else {
                    $this->warn(\sprintf('(%s) Za Torrent ni bilo najdenega leta izdaje %s %s/torrents/%s', $torrent->category->name, $torrent->name, $appurl, $torrent->id));
                }
            }

            if ($torrent->category->cartoon_meta && $torrent->tmdb && $torrent->tmdb != 0) {
                $meta = Cartoon::where('id', '=', $torrent->tmdb)->first();
                if (isset($meta->release_date) && \substr($meta->release_date, 0, 4) > '1900') {
                    $torrent->release_year = \substr($meta->release_date, 0, 4);
                    $torrent->save();
                    $this->info(\sprintf('(%s) Leto izdaje pridobljeno za Torrent %s ', $torrent->category->name, $torrent->name));
                } else {
                    $this->warn(\sprintf('(%s) Za Torrent ni bilo najdenega leta izdaje %s %s/torrents/%s', $torrent->category->name, $torrent->name, $appurl, $torrent->id));
                }
            }
        }

        $this->comment('Ukaz za leto izdaje Torrenta je končan');
    }
}
