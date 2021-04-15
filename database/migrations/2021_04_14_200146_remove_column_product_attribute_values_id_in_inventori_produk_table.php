<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColumnProductAttributeValuesIdInInventoriProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventori_produk', function (Blueprint $table) {
            $table->dropForeign(['product_attribute_value_id']);
            $table->dropColumn('product_attribute_value_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventori_produk', function (Blueprint $table) {
            $table->unsignedBigInteger('product_attribute_value_id');
            $table->foreign('product_attribute_value_id')->references('id')->on('product_attribute_values')->onDelete('cascade');
        });
    }
}
