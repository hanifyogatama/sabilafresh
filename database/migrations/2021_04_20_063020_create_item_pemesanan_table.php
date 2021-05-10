<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemPemesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_pemesanan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pemesanan_id');
            $table->unsignedBigInteger('produk_id');
            $table->integer('qty');
            $table->decimal('harga', 16, 2)->default(0);
            $table->decimal('total_harga', 16, 2)->default(0);
            $table->decimal('jumlah_pajak', 16, 2)->default(0);
            $table->decimal('persen_pajak', 16, 2)->default(0);
            $table->decimal('sub_total', 16, 2)->default(0);
            $table->string('sku');
            $table->string('tipe');
            $table->string('nama_produk');
            $table->string('berat');
            $table->timestamps();

            $table->foreign('pemesanan_id')->references('id')->on('pemesanan');
            $table->foreign('produk_id')->references('id')->on('produk');
            $table->index('sku');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_pemesanan');
    }
}
