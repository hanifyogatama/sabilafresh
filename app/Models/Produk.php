<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Produk extends Model
{

    protected $table = "produk";
    // protected $primaryKey = 'id_produk';

    protected $fillable = [
        'parent_id',
        'user_id',
        'sku',
        'tipe',
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

    public function inventoriProduk()
    {
        return $this->hasOne('App\Models\InventoriProduk');
    }

    public function kategories()
    {
        return $this->belongsToMany('App\Models\Kategori');
    }

    public function variants()
    {
        return $this->hasMany('App\Models\Produk', 'parent_id')->orderBy('harga', 'ASC');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Produk', 'parent_id');
    }

    public function atributProduk()
    {
        return $this->hasMany('App\Models\AtributProduk', 'parent_produk_id');
    }

    public function gambarProduk()
    {
        return $this->hasMany('App\Models\GambarProduk')->orderBy('id', 'desc');
    }

    public static function statuses()
    {
        return [
            0 => 'tidak aktif',
            1 => 'aktif',
        ];
    }


    public static function types()
    {
        return [
            'simple' => 'Tanpa Atribut',
            // 'configurable' => 'Pakai Atribut',
        ];
    }


    function status_label()
    {
        $statuses = $this->statuses();

        return isset($this->status) ? $statuses[$this->status] : null;
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1)
            ->where('parent_id', NULL);
    }

    function price_label()
    {
        return ($this->variants->count() > 0) ? $this->variants->first()->harga : $this->harga;
    }

    public function configurable()
    {
        return $this->tipe == 'configurable';
    }


    public function simple()
    {
        return $this->tipe == 'simple';
    }

    public function getTimeAgo($carbonObject)
    {
        return str_ireplace(
            [' seconds', ' second', ' minutes', ' minute', ' hours', ' hour', ' days', ' day', ' weeks', ' week'],
            [' detik', ' detik', ' menit', ' menit', ' jam', ' jam', ' hari', ' hari', ' minggu', ' minggu'],
            $carbonObject->diffForHumans(null, true) . ' yang lalu'
        );
    }

    public function changeStatusProduct()
    {
        $xx = Produk::inventoriProduk()->qty;
    }


    protected $guarded = [];
}
