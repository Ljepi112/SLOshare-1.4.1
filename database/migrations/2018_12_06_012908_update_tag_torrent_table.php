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
        Schema::dropIfExists('tag_torrent');

        Schema::create('tag_torrent', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('torrent_id')->unsigned()->index();
            $table->string('tag_name')->index();
        });
    }
};
