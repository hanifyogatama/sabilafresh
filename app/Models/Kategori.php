<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    //
    protected $fillable = ['nama', 'slug', 'parent_id'];

    public function childs()
    {
        return $this->hasMany('App\Models\Kategori', 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Kategori', 'parent_id');
    }

    public function produks()
    {
        return $this->belongsToMany('App\Models\Produk');
    }

    public function scopeParentCategories($query)
    {
        return $query->where('parent_id', 0);
    }

    public static function childIds($parentId = 0)
    {
        $categories = Kategori::select('id', 'nama', 'parent_id')->where('parent_id', $parentId)->get()->toArray();

        $childIds = [];
        if (!empty($categories)) {
            foreach ($categories as $category) {
                $childIds[] = $category['id'];
                $childIds = array_merge($childIds, Kategori::childIds($category['id']));
            }
        }

        return $childIds;
    }
}
