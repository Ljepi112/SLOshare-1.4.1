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
        Schema::table('history', function (Blueprint $table) {
            $table->boolean('immune')->default(0)->index()->after('seedtime');
            $table->boolean('hitrun')->default(0)->index()->after('immune');
            $table->boolean('prewarn')->default(0)->index()->after('hitrun');
        });
    }
};
