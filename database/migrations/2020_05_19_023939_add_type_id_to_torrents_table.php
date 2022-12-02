<?php

use App\Models\Torrent;
use App\Models\Type;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('torrents', function (Blueprint $table) {
            $table->integer('type_id')->index();
        });

        foreach (Torrent::all() as $torrent) {
            $type_id = Type::where('name', '=', $torrent->type)->firstOrFail()->id;
            $torrent->type_id = $type_id;
            $torrent->save();
        }

        Schema::table('torrents', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
