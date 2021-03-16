<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Add1nToFeladatok extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('feladatok', function (Blueprint $table) {
            $table->unsignedBigInteger('targyid')->nullable();

            // 1-N kapcsolat
            $table->foreign('targyid')->references('id')->on('targyak')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('feladatok', function (Blueprint $table) {
            //
        });
    }
}
