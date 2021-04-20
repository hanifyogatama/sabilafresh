<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('kode')->unique();
            $table->string('status');
            $table->datetime('tanggal_pemesanan');
            $table->datetime('batas_pemesanan');
            $table->string('status_pemesanan');
            $table->decimal('total_awal', 16, 2)->default(0);
            $table->decimal('jumlah_pajak', 16, 2)->default(0);
            $table->decimal('persen_pajak', 16, 2)->default(0);
            $table->decimal('biaya_pengiriman', 16, 2)->default(0);
            $table->decimal('total_akhir', 16, 2)->default(0);
            $table->text('catatan')->nullable();
            $table->string('nama_depan_konsumen');
            $table->string('nama_belakang_konsumen');
            $table->string('alamat_konsumen')->nullable();
            
            $table->string('no_hp_konsumen')->nullable();
            $table->string('email_konsumen')->nullable();
            $table->string('kota_konsumen')->nullable();
            $table->string('provinsi_konsumen')->nullable();
            $table->integer('kodepos_konsumen')->nullable();
            $table->string('nama_kurir')->nullable();
            $table->string('layanan_kurir')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->datetime('approved_at')->nullable();
            $table->unsignedBigInteger('cancelled_by')->nullable();
            $table->datetime('cancelled_at')->nullable();
            $table->text('catatan_pembatalan')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('approved_by')->references('id')->on('users');
            $table->foreign('cancelled_by')->references('id')->on('users');
            $table->index('kode');
            $table->index(['kode', 'tanggal_pemesanan']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemesanan');
    }
}
