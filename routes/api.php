<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
if (config('sloshare.proxy_scheme')) {
    URL::forceScheme(config('sloshare.proxy_scheme'));
}
if (config('sloshare.root_url_override')) {
    URL::forceRootUrl(config('sloshare.root_url_override'));
}
// Torrents System
Route::group(['middleware' => ['auth:api', 'banned'], 'prefix' => 'torrents'], function () {
    Route::get('/', [App\Http\Controllers\API\TorrentController::class, 'index'])->name('torrents.index');
    Route::get('/filter', [App\Http\Controllers\API\TorrentController::class, 'filter']);
    Route::get('/{id}', [App\Http\Controllers\API\TorrentController::class, 'show'])->where('id', '[0-9]+');
    Route::post('/upload', [App\Http\Controllers\API\TorrentController::class, 'store']);
});
