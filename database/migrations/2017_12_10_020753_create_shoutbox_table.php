<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shoutbox', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user')->unsigned()->index('user');
            $table->text('message');
            $table->text('mentions');
            $table->timestamps();
        });
    }
};
