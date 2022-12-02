<?php

namespace App\Helpers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class EmailBlacklistUpdater
{
    public static function update(): bool|int
    {
        $url = \config('email-blacklist.source');
        if ($url === null) {
            return false;
        }

        // Define parameters for the cache
        $key = \config('email-blacklist.cache-key');
        $duration = Carbon::now()->addMonth();

        $domains = Http::get($url)->json();
        $count = \is_countable($domains) ? \count($domains) : 0;

        // Retrieve blacklisted domains
        \cache()->put($key, $domains, $duration);

        return $count;
    }
}
