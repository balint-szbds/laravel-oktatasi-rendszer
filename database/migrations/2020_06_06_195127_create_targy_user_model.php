<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTargyUserModel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('targy_user_model', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_model_id');
            $table->unsignedBigInteger('targy_id');
            $table->timestamps();
          
            $table->unique(['user_model_id', 'targy_id']);
            $table->foreign('user_model_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('targy_id')->references('id')->on('targyak')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('targy_user_model');
    }
}
