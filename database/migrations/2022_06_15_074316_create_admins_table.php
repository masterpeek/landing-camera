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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
			$table->string('slug')->unique();
            $table->string('email')->unique();
			$table->string('password');
			$table->string('first_name');
			$table->string('last_name');
			$table->string('phone_number')->nullable();
			$table->integer('status')->default(1);
			$table->unsignedBigInteger('image_id')->nullable();
			$table->rememberToken();
			$table->timestamps();

			$table->foreign('image_id')
                ->references('id')
                ->on('images');
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
        Schema::dropIfExists('admins');
    }
};
