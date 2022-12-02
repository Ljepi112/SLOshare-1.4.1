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
        Schema::table('user_echoes', function (Blueprint $table) {
            $table->integer('room_id')->change();
            $table->integer('bot_id')->change();
            $table->integer('target_id')->change();
        });
        Schema::table('user_audibles', function (Blueprint $table) {
            $table->integer('room_id')->change();
            $table->integer('bot_id')->change();
            $table->integer('target_id')->change();
        });
    }
};
