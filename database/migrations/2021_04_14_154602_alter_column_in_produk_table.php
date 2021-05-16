<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnInProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->integer('lebar')->nullable()->change();
            $table->integer('tinggi')->nullable()->change();
            $table->integer('panjang')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->integer('lebar')->nullable(false)->change();
            $table->integer('tinggi')->nullable(false)->change();
            $table->integer('panjang')->nullable(false)->change();
        });
    }
}
