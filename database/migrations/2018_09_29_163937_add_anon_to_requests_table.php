<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('requests', function (Blueprint $table) {
            $table->boolean('anon')->default(0)->after('claimed');
            $table->boolean('filled_anon')->default(0)->after('filled_when');
        });
    }
};
