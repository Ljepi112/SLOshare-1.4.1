<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ban', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('owned_by')->index('owned_by');
            $table->integer('created_by')->nullable()->index('created_by');
            $table->text('ban_reason', 65535)->nullable();
            $table->text('unban_reason', 65535)->nullable();
            $table->dateTime('removed_at')->nullable();
            $table->timestamps();
        });
    }
};
