<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AtributOpsi extends Model
{
    protected $table = "atribut_opsi";

    protected $fillable = ['atribut_id', 'nama'];

    public function atribut()
    {
        return $this->belongsTo('App\Models\Atribut');
    }
}
