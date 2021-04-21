<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GambarSlide extends Model
{
    protected $table = "gambar_slide";

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public const UPLOAD_DIR = 'uploads';

    public const ACTIVE = 'Aktif';
    public const INACTIVE = 'Tidak Aktif';

    public const STATUSES = [
        self::ACTIVE => 'Aktif',
        self::INACTIVE => 'Tidak Aktif ',
    ];

    public const X_LARGE = '1920x643';
    public const SMALL = '135x75';

    public function scopeActive($query)
    {
        return $query->where('status', self::ACTIVE);
    }

}
