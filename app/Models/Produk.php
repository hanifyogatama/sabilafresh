<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Produk extends Model
{

    protected $table = "produk";
    // protected $primaryKey = 'id_produk';

    protected $fillable = [
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
        'info_produk',
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

    // public function variants()
    // {
    //     return $this->hasMany('App\Models\Produk', 'parent_id')->orderBy('harga', 'ASC');
    // }

    // public function parent()
    // {
    //     return $this->belongsTo('App\Models\Produk', 'parent_id');
    // }

    // public function atributProduk()
    // {
    //     return $this->hasMany('App\Models\AtributProduk', 'parent_produk_id');
    // }

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
            'simple' => 'Tanpa Atribut'
        ];
    }

    function status_label()
    {
        $statuses = $this->statuses();

        return isset($this->status) ? $statuses[$this->status] : null;
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    function price_label()
    {
        return  $this->harga;
    }

    // public function configurable()
    // {
    //     return $this->tipe == 'configurable';
    // }

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


    public function scopePopular($query, $limit = 6)
    {
        $month = now()->format('m');

        $query->selectRaw('produk.*,COUNT(item_pemesanan.id) as total_terjual')
            ->join('item_pemesanan', 'item_pemesanan.produk_id', '=', 'produk.id')
            ->join('pemesanan', 'item_pemesanan.pemesanan_id', '=', 'pemesanan.id')
            ->whereRaw(
                'pemesanan.status = :status_pemesanan AND MONTH(pemesanan.tanggal_pemesanan) = :bulan',
                [
                    'status_pemesanan' => Pemesanan::COMPLETED,
                    'bulan' => $month
                ]
            )
            ->groupBy('produk.id')
            ->orderBy('total_terjual', 'DESC')
            ->limit($limit);

        return $query;
    }




    protected $guarded = [];
}
