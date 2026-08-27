<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('audio_tracks', function (Blueprint $table) {
            if (!Schema::hasColumn('audio_tracks', 'allow_download')) {
                $table->boolean('allow_download')->default(true)->after('is_active');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('audio_tracks', function (Blueprint $table) {
            if (Schema::hasColumn('audio_tracks', 'allow_download')) {
                $table->dropColumn('allow_download');
            }
        });
    }
};
