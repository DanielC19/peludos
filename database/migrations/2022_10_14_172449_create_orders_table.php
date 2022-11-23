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
        Schema::create('orders', function (Blueprint $table) {
            $table->bigInteger('id')->comment('reference code for PayU')->primary();
            $table->string('state')->nullable();
            $table->string('transaction_id')->comment('from PayU')->nullable();
            $table->double('value')->nullable();
            $table->double('tax')->comment('IVA')->nullable();
            $table->dateTime('transaction_date')->nullable();
            $table->foreignId('user_id')->constrained()->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->bigInteger('cellphone')->nullable();
            $table->string('address')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
