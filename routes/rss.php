<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

if (config('sloshare.proxy_scheme')) {
    URL::forceScheme(config('sloshare.proxy_scheme'));
}
if (config('sloshare.root_url_override')) {
    URL::forceRootUrl(config('sloshare.root_url_override'));
}

Route::group(['before' => 'auth'], function () {
    // RSS (RSS Key Auth)
    Route::get('/rss/{id}.{rsskey}', [App\Http\Controllers\RssController::class, 'show'])->name('rss.show.rsskey');
    Route::get('/torrent/download/{id}.{rsskey}', [App\Http\Controllers\TorrentDownloadController::class, 'store'])->name('torrent.download.rsskey');
});
