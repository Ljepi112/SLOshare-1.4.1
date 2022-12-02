<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_activations', function (Blueprint $table) {
            $table->bigInteger('id', true)->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->string('token');
            $table->timestamps();
        });
    }
};
