<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
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

            $table->uuid('transaction_id');

            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');


            $table->foreignId('cashier_id')
                ->nullable()
                ->references('id')
                ->on('users')
                ->onDelete('cascade');


            $table->foreignId('product_id')
                ->constrained()
                ->onDelete('cascade');


            $table->integer('qty');
            $table->double('price');
            $table->string('payment_method')->nullable();
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
}
