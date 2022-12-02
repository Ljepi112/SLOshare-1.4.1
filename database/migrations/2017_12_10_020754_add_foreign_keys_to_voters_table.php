<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('voters', function (Blueprint $table) {
            $table->foreign('poll_id')->references('id')->on('polls')->onUpdate('RESTRICT')->onDelete('CASCADE');
        });
    }
};
