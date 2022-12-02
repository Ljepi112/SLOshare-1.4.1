<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('files', function (Blueprint $table) {
            $table->bigInteger('id', true)->unsigned();
            $table->string('name');
            $table->bigInteger('size')->unsigned();
            $table->bigInteger('torrent_id')->unsigned()->index('fk_files_torrents1_idx');
        });
    }
};
