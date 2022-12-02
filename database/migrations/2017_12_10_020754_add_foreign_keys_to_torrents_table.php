<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('torrents', function (Blueprint $table) {
            $table->foreign('category_id', 'category_id')->references('id')->on('categories')->onUpdate('RESTRICT')->onDelete('CASCADE');
        });
    }
};
