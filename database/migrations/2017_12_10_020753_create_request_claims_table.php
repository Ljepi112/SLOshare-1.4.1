<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('request_claims', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('request_id')->index('request_id');
            $table->string('username')->nullable()->index('user_id');
            $table->smallInteger('anon')->default(0);
            $table->timestamps();
        });
    }
};
