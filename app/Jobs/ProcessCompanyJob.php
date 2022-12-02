<?php

namespace App\Jobs;

use App\Services\Tmdb\TMDBScraper;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessCompanyJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * ProcessCompanyJob Constructor.
     */
    public function __construct(public $company)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->company['movie'] as $movie) {
            $metadata = new TMDBScraper();
            $metadata->movie($movie['id']);
        }

        foreach ($this->company['tv'] as $tv) {
            $metadata = new TMDBScraper();
            $metadata->tv($tv['id']);
        }

        foreach ($this->company['cartoon'] as $cartoon) {
            $metadata = new TMDBScraper();
            $metadata->cartoon($cartoon['id']);
        }

        foreach ($this->company['cartoontv'] as $cartoontv) {
            $metadata = new TMDBScraper();
            $metadata->cartoontv($cartoontv['id']);
        }
    }
}
