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
        Schema::table('users', function (Blueprint $table) {
            $table->dateTime('disabled_at')->after('last_login')->nullable();
            $table->integer('deleted_by')->after('disabled_at')->nullable();
            $table->softDeletes();
        });
    }
};
