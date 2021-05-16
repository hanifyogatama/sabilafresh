<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    protected $table = "pengiriman";

    public const PROCESSED = 'processed';
    public const SHIPPED = 'shipped';
    public const FAILED  = 'failed';

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

   

    public function pemesanan()
    {
        return $this->belongsTo(\App\Models\Pemesanan::class);
    }
}
