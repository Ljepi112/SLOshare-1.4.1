<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('private_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sender_id')->unsigned()->index();
            $table->integer('reciever_id')->unsigned()->index();
            $table->string('subject');
            $table->text('message');
            $table->boolean('read')->default(0);
            $table->integer('related_to')->nullable();
            $table->timestamps();
            $table->index(['sender_id', 'read']);
        });
    }
};
