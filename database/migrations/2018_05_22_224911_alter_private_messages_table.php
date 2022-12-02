<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('private_messages', function ($table) {
            $table->renameColumn('reciever_id', 'receiver_id');
        });
    }
};
