<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('link');
            $table->foreignUuid('advert_id')->constrained()->cascadeOnDelete();
            $table->integer('initial_duration');
            $table->integer('duration');
            $table->integer('total_increment')->default(0);
            $table->integer('percentage')->default(0);
            $table->integer('total_decrement')->default(0);
            $table->float('top-amount')->default(0);
            $table->integer('top_sale')->default(0);
            $table->float('voluntary-amount')->default(0);
            $table->integer('voluntary_sale')->default(0);
            $table->enum('status', ['active', 'in-active', 'expired'])->default('active');
            $table->enum('shared_with', ['both', 'none', 'top', 'voluntary'])->default('none');
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
        Schema::dropIfExists('links');
    }
}
