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
        Schema::table('bon_transactions', function (Blueprint $table) {
            $table->integer('post_id')->nullable()->index()->after('torrent_id');
        });
    }
};
