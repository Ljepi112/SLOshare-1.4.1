<?php

use App\Models\Resolution;
use App\Models\Torrent;
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
            $table->integer('resolution_id')->nullable()->index();
        });

        if (Schema::hasColumn('torrents', 'resolution')) {
            foreach (Torrent::all() as $torrent) {
                $resolution_id = Resolution::where('name', '=', $torrent->resolution)->firstOrFail()->id;
                $torrent->resolution_id = $resolution_id;
                $torrent->save();
            }

            Schema::table('torrents', function (Blueprint $table) {
                $table->dropColumn('resolution');
            });
        }
    }
};
