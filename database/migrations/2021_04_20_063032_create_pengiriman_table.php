<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengirimanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengiriman', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('pemesanan_id');
            $table->string('no_resi')->nullable();
            $table->string('status');
            $table->integer('total_qty');
            $table->integer('total_berat');
            $table->string('nama_depan');
            $table->string('nama_belakang');
            $table->string('alamat')->nullable();
           
            $table->string('no_hp')->nullable();
            $table->string('email')->nullable();
            $table->string('kota')->nullable();
            $table->string('provinsi')->nullable();
            $table->integer('kodepos')->nullable();
            $table->unsignedBigInteger('shipped_by')->nullable();
            $table->datetime('shipped_at')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('pemesanan_id')->references('id')->on('pemesanan');
            $table->foreign('shipped_by')->references('id')->on('users');
            $table->index('no_resi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengiriman');
    }
}
