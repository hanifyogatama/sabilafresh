<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtributOpsiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atribut_opsi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('atribut_id');
            $table->string('nama');
            $table->timestamps();

            $table->foreign('atribut_id')->references('id')->on('atribut')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('atribut_opsi');
    }
}
