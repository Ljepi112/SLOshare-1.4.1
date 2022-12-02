<?php

namespace App\Jobs;

use App\Services\Tmdb\TMDBScraper;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessCollectionJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * ProcessCollectionJob Constructor.
     */
    public function __construct(public $collection)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->collection['parts'] as $parts) {
            $metadata = new TMDBScraper();
            $metadata->movie($parts['id']);
            $metadata->tv($parts['id']);
            $metadata->cartoon($parts['id']);
            $metadata->cartoontv($parts['id']);
        }
    }
}
