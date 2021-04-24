<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    protected $table = "pengiriman";

    public const PENDING = 'pending';
    public const SHIPPED = 'shipped';

    protected $fillable = [
        'user_id',
        'pemesanan_id',
        'no_resi',
        'status',
        'total_qty',
        'total_berat',
        'nama_depan',
        'nama_belakang',
        'alamat',
        'no_hp',
        'email',
        'kota',
        'provinsi',
        'kodepos',
        'shipped_by',
        'shipped_at',
    ];
}
