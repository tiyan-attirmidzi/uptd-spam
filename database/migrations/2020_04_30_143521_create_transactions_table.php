<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_fee');
            $table->unsignedBigInteger('usage');
            $table->unsignedBigInteger('usage_cost');
            $table->unsignedBigInteger('fine')->nullable(); // denda
            $table->unsignedBigInteger('total_payment');
            $table->boolean('status')->default(0);
            $table->unsignedBigInteger('id_customer');
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
        Schema::dropIfExists('transactions');
    }
}
