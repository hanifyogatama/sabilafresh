<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // for table without laravel role name
    protected $table = "kategori";


    protected $fillable = ['nama', 'slug', 'parent_id'];

    // childs relation
    public function childs()
    {
        return $this->hasMany('App\Models\Category', 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Category', 'parent_id');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'kategori_produk');
    }

    protected $guarded = [];
}
