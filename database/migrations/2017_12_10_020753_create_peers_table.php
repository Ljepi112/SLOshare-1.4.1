<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peers', function (Blueprint $table) {
            $table->bigInteger('id', true)->unsigned();
            $table->string('peer_id', 60)->nullable();
            $table->string('md5_peer_id')->nullable();
            $table->string('hash')->nullable();
            $table->string('ip')->nullable();
            $table->smallInteger('port')->unsigned()->nullable();
            $table->string('agent')->nullable();
            $table->bigInteger('uploaded')->unsigned()->nullable();
            $table->bigInteger('downloaded')->unsigned()->nullable();
            $table->bigInteger('left')->unsigned()->nullable();
            $table->boolean('seeder')->nullable();
            $table->timestamps();
            $table->bigInteger('torrent_id')->unsigned()->nullable()->index('fk_peers_torrents1_idx');
            $table->integer('user_id')->nullable()->index('fk_peers_users1_idx');
        });
    }
};
