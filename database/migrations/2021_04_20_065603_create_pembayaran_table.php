<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pemesanan_id');
            $table->string('no_pembayaran')->unique();
            $table->decimal('jumlah', 16, 2)->default(0);
            $table->string('metode');
            $table->string('status')->nullable();
            $table->string('token')->nullable();
            $table->json('payload')->nullable();
            $table->string('tipe_pembayaran')->nullable();
            $table->string('nomor_va')->nullable();
            $table->string('vendor_pembayaran')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('pemesanan_id')->references('id')->on('pemesanan');
            $table->index('no_pembayaran');
            $table->index('metode');
            $table->index('token');
            $table->index('tipe_pembayaran');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayaran');
    }
}
