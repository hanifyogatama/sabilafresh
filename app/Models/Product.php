<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Product extends Model
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

    public function productInventory()
    {
        return $this->hasOne('App\Models\ProductInventory');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'kategori_produk');
    }

    public function variants()
    {
        return $this->hasMany('App\Models\Product', 'parent_id')->orderBy('harga','ASC');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Product', 'parent_id');
    }

    public function productAttributesValues()
    {
        return $this->hasMany('App\Models\ProductAttributesValue');
    }

    public function productImages()
    {
        return $this->hasMany('App\Models\ProductImage')->orderBy('id','desc');
    }

    public static function statuses()
    {
        return [
            0 => 'draft',
            1 => 'active',
            2 => 'inactive',
        ];
    }


    public static function types()
    {
        return [
            'simple' => 'Tanpa Atribut',
            'configurable' => 'Pakai Atribut',
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
            ->where('parent_id', NULL)
            ->orderBy('created_at', 'DESC');
    }

    function price_label()
    {
        return ($this->variants->count() > 0) ? $this->variants->first()->harga : $this->harga;
    }
    
    protected $guarded = [];
}
