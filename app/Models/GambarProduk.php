<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GambarProduk extends Model
{
    protected $table = "gambar_produk";

    public const UPLOAD_DIR = 'uploads';

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    // size images
    public const SMALL = '40x40';
    public const MEDIUM = '240x240';
    public const LARGE = '600x656';
    public const X_LARGE = '1125x1200';



    public function produk()
    {
        return $this->belongsTo('App\Models\Produk');
    }
}
