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
        Schema::create('audios', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->nullable();
            $table->string('artist')->default('SUPERFLAME');
            $table->string('category')->nullable()->default('TRACKS');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('audio_url')->nullable();
            $table->string('audio_file')->nullable();
            $table->string('buy_url')->nullable();
            $table->string('buy_label')->default('Buy Now');
            $table->date('release_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audios');
    }
};
