<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('log_activities');

        Schema::create('audits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable()->default(null);
            $table->string('model_name');
            $table->unsignedBigInteger('model_entry_id');
            $table->string('action');
            $table->json('record');
            $table->timestamps();
        });
    }
};
