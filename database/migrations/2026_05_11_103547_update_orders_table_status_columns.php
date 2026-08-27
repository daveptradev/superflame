<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            // PAYMENT
            $table->string('payment_status')
                ->default('pending')
                ->change();

            // ORDER STATUS
            $table->string('order_status')
                ->default('pending')
                ->after('payment_status');

            // SHIPPING STATUS
            $table->string('shipping_status')
                ->default('pending')
                ->after('order_status');

            // COURIER
            $table->string('courier')
                ->nullable()
                ->change();

            // COURIER SERVICE
            $table->string('courier_service')
                ->nullable()
                ->after('courier');

            // TRACKING NUMBER
            $table->string('tracking_number')
                ->nullable()
                ->after('courier_service');

        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            $table->dropColumn([
                'order_status',
                'shipping_status',
                'courier_service',
                'tracking_number'
            ]);
        });
    }
};