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
        Schema::create('playlists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->index();
            $table->string('name');
            $table->text('description');
            $table->string('cover_image')->nullable();
            $table->integer('position')->nullable();
            $table->boolean('is_private')->default(0)->index();
            $table->boolean('is_pinned')->default(0)->index();
            $table->boolean('is_featured')->default(0)->index();
            $table->timestamps();
        });
    }
};
