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
        Schema::table('recommendations', function (Blueprint $table) {
            $table->unsignedBigInteger('cartoon_id')->nullable()->index();
            $table->foreign('cartoon_id')->references('id')->on('cartoon')->onDelete('cascade');

            $table->unsignedBigInteger('recommendation_cartoon_id')->nullable()->index();
            $table->foreign('recommendation_cartoon_id')->references('id')->on('cartoon')->onDelete('cascade');

            $table->unique(['cartoon_id', 'recommendation_cartoon_id']);
        });
    }
};
