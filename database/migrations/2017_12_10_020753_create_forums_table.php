<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('forums', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('position')->nullable();
            $table->integer('num_topic')->nullable();
            $table->integer('num_post')->nullable();
            $table->integer('last_topic_id')->nullable();
            $table->string('last_topic_name')->nullable();
            $table->string('last_topic_slug')->nullable();
            $table->integer('last_post_user_id')->nullable();
            $table->string('last_post_user_username')->nullable();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->text('description', 65535)->nullable();
            $table->integer('parent_id')->nullable();
            $table->timestamps();
        });
    }
};
