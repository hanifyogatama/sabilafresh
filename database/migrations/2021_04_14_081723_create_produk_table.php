<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('sku'); 
            $table->string('nama'); // name
            $table->string('slug');
            $table->text('info_produk')->nullable();
            $table->decimal('harga', 15, 2); // price
            $table->integer('berat'); //weight
            $table->integer('lebar'); // width
            $table->integer('tinggi'); // height
            $table->text('deskripsi'); // short_description
            $table->text('detail_deskripsi'); // description
            $table->integer('status');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produk');
    }
}
