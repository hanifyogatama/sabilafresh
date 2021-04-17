<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeOption extends Model
{
    protected $table = "atribut_opsi";

    protected $fillable = ['atribut_id', 'nama'];

    public function attribute()
    {
        return $this->belongsTo('App\Models\Attribute');
    }
}
