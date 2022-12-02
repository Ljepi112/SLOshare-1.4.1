<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tag_torrent', function (Blueprint $table) {
            $table->bigInteger('torrent_id')->unsigned();
            $table->integer('tag_id')->index('fk_torrents_tags_tags_1');
            $table->primary(['torrent_id', 'tag_id']);
        });
    }
};
