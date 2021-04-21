<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorit extends Model
{
    protected $table = "favorit";

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function produk()
    {
        return $this->belongsTo('App\Models\Produk');
    }
}
