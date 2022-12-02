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
        Schema::table('categories', function (Blueprint $table) {
            $table->string('image')->nullable()->after('slug');
            $table->boolean('movie_meta')->default(0)->after('meta');
            $table->boolean('tv_meta')->default(0)->after('meta');
            $table->boolean('game_meta')->default(0)->after('meta');
            $table->boolean('music_meta')->default(0)->after('meta');
            $table->boolean('no_meta')->default(0)->after('meta');
            $table->dropColumn('meta');
        });
    }
};
