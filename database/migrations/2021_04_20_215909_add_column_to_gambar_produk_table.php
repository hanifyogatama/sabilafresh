<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToGambarProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gambar_produk', function (Blueprint $table) {
            $table->string('gambar_xbesar')->nullable()->after('path');
            $table->string('gambar_besar')->nullable()->after('gambar_xbesar');
            $table->string('gambar_medium')->nullable()->after('gambar_besar');
            $table->string('gambar_kecil')->nullable()->after('gambar_medium');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gambar_produk', function (Blueprint $table) {
            $table->dropColumn('gambar_xbesar');
            $table->dropColumn('gambar_besar');
            $table->dropColumn('gambar_medium');
            $table->dropColumn('gambar_kecil');
        });
    }
}
