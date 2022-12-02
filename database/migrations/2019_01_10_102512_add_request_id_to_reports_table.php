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
        Schema::table('reports', function (Blueprint $table) {
            $table->integer('request_id')->unsigned()->default(0)->after('torrent_id');
            $table->integer('torrent_id')->unsigned()->default(0)->change();
        });
    }
};
