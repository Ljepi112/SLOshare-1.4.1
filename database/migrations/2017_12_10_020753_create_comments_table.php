<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->integer('id', true);
            $table->text('content', 65535);
            $table->smallInteger('anon')->default(0);
            $table->bigInteger('torrent_id')->unsigned()->nullable()->index('fk_comments_torrents_1');
            $table->integer('article_id')->nullable()->index('fk_comments_articles_1');
            $table->integer('requests_id')->nullable();
            $table->integer('user_id')->nullable()->index('fk_comments_users_1');
            $table->timestamps();
        });
    }
};
