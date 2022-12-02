<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bon_exchange', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description')->nullable();
            $table->bigInteger('value')->unsigned()->default(0);
            $table->integer('cost')->unsigned()->default(0);
            $table->boolean('upload')->default(0);
            $table->boolean('download')->default(0);
            $table->boolean('personal_freeleech')->default(0);
            $table->boolean('invite')->default(0);
        });
    }
};
