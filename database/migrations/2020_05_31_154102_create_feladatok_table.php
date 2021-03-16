<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeladatokTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* név, leírás, pont, határidő tól-ig, beadott megoldások száma, értékelt megoldások száma */
        Schema::create('feladatok', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nev');
            $table->string('leiras');
            $table->bigInteger('pont');
            $table->dateTime('hatarido_tol');
            $table->dateTime('hatarido_ig');
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
        Schema::dropIfExists('feladatok');
    }
}
