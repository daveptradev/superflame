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
        Schema::create('livesets', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('dj');
        $table->string('image');
        $table->string('youtube_url');
        $table->string('event')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livesets');
    }
};
