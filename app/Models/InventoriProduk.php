<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoriProduk extends Model
{
    protected $table = "inventori_produk";

    protected $fillable = [
        'produk_id',
        'qty',
    ];

    public function produk()
    {
        return $this->belongsTo('App\Models\Produk');
    }
    public static function reduceStock($productId, $qty)
    {
        $inventory = self::where('produk_id', $productId)->first();
        $inventory->qty = $inventory->qty - $qty;
        $inventory->save();
    }
}
