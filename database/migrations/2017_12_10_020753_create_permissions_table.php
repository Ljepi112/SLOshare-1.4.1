<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('forum_id')->index('fk_permissions_forums1_idx');
            $table->integer('group_id')->index('fk_permissions_groups1_idx');
            $table->boolean('show_forum');
            $table->boolean('read_topic');
            $table->boolean('reply_topic');
            $table->boolean('start_topic');
        });
    }
};
