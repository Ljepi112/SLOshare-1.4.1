<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index('clients_user_id_foreign');
            $table->string('name')->index('clients_name_unique');
            $table->string('ip')->unique();
            $table->timestamps();
        });
    }
};
