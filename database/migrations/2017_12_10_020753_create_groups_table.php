<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name');
            $table->string('slug');
            $table->integer('position');
            $table->string('color');
            $table->string('icon');
            $table->string('effect')->default('none');
            $table->boolean('is_admin')->default(0);
            $table->boolean('is_modo')->default(0);
            $table->boolean('is_trusted')->default(0);
            $table->boolean('is_immune')->default(0);
            $table->boolean('is_freeleech')->default(0);
            $table->boolean('autogroup')->default(0);
        });
    }
};
