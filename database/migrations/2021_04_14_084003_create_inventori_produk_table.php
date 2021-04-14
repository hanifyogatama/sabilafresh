<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventori_produk', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_produk');
            $table->unsignedBigInteger('id_inventori_produk');
            $table->integer('qty');
            $table->timestamps();

            $table->foreign('id_produk')->references('id')->on('produk')->onDelete('cascade');
            $table->foreign('id_inventori_produk')->references('id')->on('inventori_produk')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventori_produk');
    }
}
