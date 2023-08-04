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
        Schema::create('receive_and_pays', function (Blueprint $table) {
            $table->id();
            $table->string('client_type');
            $table->integer('client_id');
            $table->float('past_balance',10,2);
            $table->string('balance_title');
            $table->float('amount',10,2);
            $table->string('payment_media');
            $table->integer('bank_account_id')->nullable();
            $table->float('discount',10,2);
            $table->float('new_balance',10,2);
            $table->string('new_balance_title');
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
        Schema::dropIfExists('receive_and_pays');
    }
};
