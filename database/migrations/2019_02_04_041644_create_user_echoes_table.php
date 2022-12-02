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
        Schema::create('user_echoes', function (Blueprint $table) {
            $table->integer('id', true)->signed();
            $table->integer('user_id')->signed()->index();
            $table->boolean('room_id')->nullable()->index();
            $table->boolean('target_id')->nullable()->index();
            $table->boolean('bot_id')->nullable()->index();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('CASCADE');
        });
    }
};
