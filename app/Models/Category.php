<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // for table without laravel role name
    protected $table = "kategori";

    protected $fillable = ['nama', 'slug', 'parent_id'];
}
