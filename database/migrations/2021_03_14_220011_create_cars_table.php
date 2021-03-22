<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('model');
            $table->string('clearName');
            $table->text('description');
            $table->string('image');
            $table->integer('nbPlaces');
            $table->double('price');
            $table->boolean('isFreeRented')->default(false);
            $table->boolean('isRented')->default(false);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'fk_user')->references('id')->on('users');
            $table->double('costIfRented')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
