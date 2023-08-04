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
        Schema::create('account_charts', function (Blueprint $table) {
            $table->id();
            $table->integer('sector_id')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_type')->nullable();
            $table->string('mobile')->nullable();
            $table->text('address')->nullable();
            $table->tinyInteger('status')->nullable();
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
        Schema::dropIfExists('account_charts');
    }
};
