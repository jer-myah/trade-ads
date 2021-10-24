<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradersPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traders_payments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('link_id')->constrained()->cascadeOnDelete();
            $table->string('trader_link');
            $table->uuid('buyer_id')->constrained()->cascadeOnDelete();
            $table->uuid('seller_id')->constrained()->cascadeOnDelete();
            $table->float('amount');
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
        Schema::dropIfExists('traders_payments');
    }
}
