<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = "produk";
    // protected $primaryKey = 'id_produk';

    protected $fillable = [

        'user_id',
        'sku',
        'nama',
        'slug',
        'harga',
        'berat',
        'lebar',
        'tinggi',
        'panjang',
        'deskripsi',
        'detail_deskripsi',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'kategori_produk');
    }

    public static function statuses()
    {
        return [
            0 => 'draft',
            1 => 'active',
            2 => 'inactive',
        ];
    }

    protected $guarded = [];
}
