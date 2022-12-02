<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rss', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('userID')->index('userID');
            $table->string('category')->nullable();
            $table->timestamps();
        });
    }
};
