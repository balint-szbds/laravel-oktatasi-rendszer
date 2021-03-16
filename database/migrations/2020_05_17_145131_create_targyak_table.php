<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTargyakTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('targyak', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nev');
            $table->string('leiras')->nullable();
            $table->string('kod');
            $table->bigInteger('kredit');
            $table->tinyInteger('publikalt');
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
        Schema::dropIfExists('targyak');
    }
}
