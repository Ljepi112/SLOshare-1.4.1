<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('album_id')->unsigned();
            $table->string('image');
            $table->string('description');
            $table->string('type');
            $table->integer('downloads')->nullable();
            $table->foreign('album_id')->references('id')->on('albums')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->timestamps();
        });
    }
};
