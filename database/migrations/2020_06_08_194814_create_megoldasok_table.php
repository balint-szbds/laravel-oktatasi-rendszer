<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMegoldasokTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('megoldasok', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('hallgato_megjegyzes')->nullable();
            $table->string('path');
            $table->unsignedBigInteger('feladatid');
            $table->unsignedBigInteger('diakid');
            $table->unsignedBigInteger('ertekeles')->nullable();
            $table->string('tanar_megjegyzes')->nullable();
            $table->timestamps();

            $table->foreign('diakid')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('feladatid')->references('id')->on('feladatok')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('megoldasok');
    }
}
