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
        Schema::create('applications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('email')->unique();
            $table->longText('referrer')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->dateTime('moderated_at')->nullable();
            $table->integer('moderated_by')->nullable()->index();
            $table->integer('accepted_by')->nullable()->index();
            $table->timestamps();
        });
    }
};
