<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {

            $table->string('slug')->nullable()->after('title');

            $table->longText('description')->nullable()->after('location');

            $table->string('status')
                ->default('upcoming')
                ->after('lineup');
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {

            $table->dropColumn([
                'slug',
                'description',
                'status'
            ]);
        });
    }
};