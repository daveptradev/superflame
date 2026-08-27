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
        Schema::create('audio_tracks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('audio_id');
            $table->string('title');
            $table->string('file_path');
            $table->string('duration')->nullable();
            $table->integer('track_number')->default(1);
            $table->timestamps();

            $table->foreign('audio_id')
                ->references('id')
                ->on('audios')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audio_tracks');
    }
};
