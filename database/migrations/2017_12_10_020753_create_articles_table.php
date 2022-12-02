<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('title');
            $table->string('slug');
            $table->string('image')->nullable();
            $table->text('content', 65535);
            $table->timestamps();
            $table->integer('user_id')->index('fk_articles_users1_idx');
        });
    }
};
