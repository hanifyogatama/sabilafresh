<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAsNullableColumnInProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->decimal('harga', 15, 2)->nullable()->change();
            $table->decimal('berat', 15, 2)->nullable()->change();
            $table->text('deskripsi')->nullable()->change();
            $table->text('detail_deskripsi')->nullable()->change();
            $table->integer('status')->nullable()->change();
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
            $table->decimal('harga', 15, 2)->nullable(false)->change();
            $table->decimal('berat', 15, 2)->nullable(false)->change();
            $table->text('deskripsi')->nullable(false)->change();
            $table->text('detail_deskripsi')->nullable(false)->change();
            $table->integer('status')->nulllable(false)->change();
        });
    }
}
