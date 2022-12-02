<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('voters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('poll_id')->unsigned()->index('voters_poll_id_foreign');
            $table->integer('user_id')->unsigned()->default(0);
            $table->string('ip_address');
            $table->timestamps();
        });
    }
};
