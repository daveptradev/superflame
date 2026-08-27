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
    Schema::table('livesets', function (Blueprint $table) {

        $table->string('slug')->nullable();

        $table->text('description')->nullable();

        $table->string('genre')->nullable();

        $table->string('duration')->nullable();

        $table->string('audio_url')->nullable();

        $table->date('release_date')->nullable();

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
