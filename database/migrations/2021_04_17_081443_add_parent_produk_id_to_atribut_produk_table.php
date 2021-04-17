<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParentProdukIdToAtributProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('atribut_produk', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_produk_id')->after('id')->nullable();

            $table->foreign('parent_produk_id')->references('id')->on('produk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('atribut_produk', function (Blueprint $table) {
            $table->dropForeign('atribut_produk_parent_produk_id_foreign');
            $table->dropColumn('parent_produk_id');
        });
    }
}
