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
        Schema::create('orders', function (Blueprint $table) {
    $table->id();

    // CUSTOMER
    $table->string('email');
    $table->string('first_name');
    $table->string('last_name')->nullable();
    $table->string('phone');

    // ADDRESS
    $table->text('address');
    $table->string('province');
    $table->string('postal_code');

    // SHIPPING
    $table->string('courier')->nullable();
    $table->integer('shipping_cost')->default(0);

    // PAYMENT
    $table->string('payment_status')->default('pending');
    $table->string('midtrans_order_id')->nullable();

    // TOTAL
    $table->integer('subtotal');
    $table->integer('total');

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
