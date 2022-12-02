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
        Schema::table('warnings', function (Blueprint $table) {
            $table->integer('deleted_by')->after('active')->nullable();
            $table->softDeletes()->after('deleted_by');
        });
    }
};
