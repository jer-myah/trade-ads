<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adverts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('advert_package_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('advert_category_id')->constrained()->cascadeOnDelete();
            $table->string('title')->unique();
            $table->string('description');
            $table->string('image');
            $table->string('video')->nullable();
            $table->float('amount');
            $table->foreignUuid('user_id')->constrained()->cascadeOnDelete();
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('adverts');
    }
}
