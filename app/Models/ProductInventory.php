<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductInventory extends Model
{
    protected $table = "inventori_produk";

    protected $fillable = [
        'product_id',
        'qty',
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
