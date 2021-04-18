<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AtributProduk extends Model
{
    protected $table = "atribut_produk";

    protected $fillable = [
        'produk_id',
        'atribut_id',
        'text_value',
        'boolean_value',
        'integer_value',
        'float_value',
        'datetime_value',
        'date_value',
        'json_value',
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Produk');
    }

    public function atribut()
    {
        return $this->belongsTo('App\Models\Atribut');
    }

    public static function getAttributeOptions($product, $attributeCode)
    {
        $productVariantIDs = $product->variants->pluck('id');
        $attribute = Atribut::where('kode', $attributeCode)->first();

        $attributeOptions = AtributProduk::where('atribut_id', $attribute->id)
            ->whereIn('produk_id', $productVariantIDs)
            ->get();

        return $attributeOptions;
    }
}
