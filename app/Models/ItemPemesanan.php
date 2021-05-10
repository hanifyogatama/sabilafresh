<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemPemesanan extends Model
{
    protected $table = "item_pemesanan";

    protected $fillable = [
        'pemesanan_id',
        'produk_id',
        'qty',
        'harga',
        'total_harga',
        'jumlah_pajak',
        'persen_pajak',
        'sub_total',
        'sku',
        'tipe',
        'nama_produk',
        'berat',
    ];

    /**
     * Define relationship with the Product
     *
     * @return void
     */
    public function produk()
    {
        return $this->belongsTo('App\Models\Produk');
    }
}
