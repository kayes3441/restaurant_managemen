<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('purchase_type');
            $table->string('name')->nullable();
            $table->string('mobile')->nullable();
            $table->integer('supplier_id')->nullable();
            $table->float('total_amount',12,2);
            $table->float('pay_amount',12,2)->nullable();
            $table->string('payment_media');
            $table->integer('bank_account_id')->nullable();
            $table->string('bank_payment_id')->nullable();
            $table->text('invoice_number')->nullable();
            $table->float('labor_cost')->nullable();
            $table->float('transport_cost')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchases');
    }
};
