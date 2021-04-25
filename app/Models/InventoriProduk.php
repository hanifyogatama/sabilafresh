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
        $inventory = self::where('produk_id', $productId)->firstOrFail();

        if ($inventory->qty < $qty) {
            $product = Pemesanan::findOrFail($productId);
            throw new \App\Exceptions\OutOfStock('Produk' . $product->sku . ' kurang dari stok');
        }

        $inventory->qty = $inventory->qty - $qty;
        $inventory->save();
    }


    public static function increaseStock($productId, $qty)
    {
        $inventory = self::where('produk_id', $productId)->firstOrFail();
        $inventory->qty = $inventory->qty + $qty;
        $inventory->save();
    }
}
