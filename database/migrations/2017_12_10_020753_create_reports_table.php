<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->integer('reporter_id')->index('reporter_id');
            $table->integer('staff_id')->nullable()->index('staff_id');
            $table->string('title');
            $table->text('message', 65535);
            $table->integer('solved');
            $table->text('verdict', 65535)->nullable();
            $table->timestamps();
        });
    }
};
