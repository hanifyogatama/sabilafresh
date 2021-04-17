<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = "gambar_produk";

    protected $fillable = [
        'produk_id',
        'path'
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Produk');
    }
}
