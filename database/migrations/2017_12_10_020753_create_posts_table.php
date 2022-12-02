<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->integer('id', true);
            $table->text('content');
            $table->timestamps();
            $table->integer('user_id')->index('fk_forum_posts_users1_idx');
            $table->integer('topic_id')->index('fk_posts_topics1_idx');
        });
    }
};
