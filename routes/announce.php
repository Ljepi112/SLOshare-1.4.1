<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

/*
|--------------------------------------------------------------------------
| Announce Routes
|--------------------------------------------------------------------------
*/
if (config('sloshare.proxy_scheme')) {
    URL::forceScheme(config('sloshare.proxy_scheme'));
}
if (config('sloshare.root_url_override')) {
    URL::forceRootUrl(config('sloshare.root_url_override'));
}
// Announce System
Route::get('{passkey}', [App\Http\Controllers\AnnounceController::class, 'index'])->name('announce');
