<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('request_bounty', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id')->index('addedby');
            $table->float('seedbonus', 12)->unsigned()->default(0.00);
            $table->integer('requests_id')->index('request_id');
            $table->timestamps();
        });
    }
};
