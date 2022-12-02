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
        Schema::create('crew_cartoon', function (Blueprint $table) {
            $table->unsignedInteger('cartoon_id');
            $table->unsignedInteger('person_id');
            $table->primary(['cartoon_id', 'person_id']);
        });
    }
};
