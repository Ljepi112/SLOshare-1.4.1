<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name');
            $table->string('slug');
            $table->string('icon')->default('none');
            $table->string('meta')->default(0);
            $table->integer('num_torrent')->default(0);
        });
    }
};
