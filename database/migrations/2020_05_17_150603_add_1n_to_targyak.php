<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Add1nToTargyak extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('targyak', function (Blueprint $table) {
            $table->unsignedBigInteger('tanarid')->nullable();

            // 1-N kapcsolat
            $table->foreign('tanarid')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('targyak', function (Blueprint $table) {
            //
        });
    }
}
