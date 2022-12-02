<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('polls', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->default(0);
            $table->string('title');
            $table->string('slug');
            $table->boolean('ip_checking')->default(0);
            $table->boolean('multiple_choice')->default(0);
            $table->timestamps();
        });
    }
};
