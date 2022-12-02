<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('peers', function (Blueprint $table) {
            $table->foreign('torrent_id', 'fk_peers_torrents1')->references('id')->on('torrents')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('user_id', 'fk_peers_users1')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }
};
