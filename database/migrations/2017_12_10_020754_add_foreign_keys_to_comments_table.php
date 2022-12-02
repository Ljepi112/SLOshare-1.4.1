<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('article_id', 'fk_comments_articles_1')->references('id')->on('articles')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign('user_id', 'fk_comments_users_1')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }
};
