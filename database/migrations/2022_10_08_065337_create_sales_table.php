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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('memo_number');
            $table->string('sale_type');
            $table->string('customer_name')->nullable();
            $table->string('customer_mobile')->nullable();
            $table->integer('customer_id')->nullable();
            $table->string('customer_balance')->nullable();
            $table->string('balance_type')->nullable();
            $table->float('amount',10,2);
            $table->float('vat',10,2);
            $table->float('vatAmount',10,2);
            $table->float('subtotal',10,2);
            $table->float('discount',10,2)->nullable();
            $table->float('totalPayable',10,2);
            $table->float('cashPaid',10,2)->nullable();
            $table->float('changeAmount',10,2)->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('sales');
    }
};
