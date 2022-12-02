<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('playlist_torrents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('position')->nullable();
            $table->integer('playlist_id')->default(0)->index();
            $table->integer('torrent_id')->default(0)->index();
            $table->integer('tmdb_id')->default(0)->index();

            $table->unique(['playlist_id', 'torrent_id', 'tmdb_id']);
        });
    }
};
