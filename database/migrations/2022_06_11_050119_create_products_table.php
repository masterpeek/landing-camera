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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->float('price')->default(0);
            $table->integer('rental_period')->default(0);
            $table->unsignedBigInteger('image_id');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            $table->foreign('image_id')
            ->references('id')
            ->on('images');

            $table->foreign('category_id')
            ->references('id')
            ->on('categories');
            //->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
