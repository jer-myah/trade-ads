<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBitcoinPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bitcoin_payments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('email');
            $table->string('txid');
            $table->set('status', [-1, 0, 1, 2]);
            $table->string('address');
            $table->double('value');
            $table->string('rbf_attribute')->nullable();
            $table->boolean('credited')->default(false);
            $table->softDeletes();
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
        Schema::dropIfExists('bitcoin_payments');
    }
}
