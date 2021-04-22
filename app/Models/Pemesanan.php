<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{

    protected $table = "pemesanan";
    protected $fillable = [
        'user_id',
        'kode',
        'status',
        'tanggal_pemesanan',
        'batas_pemesanan',
        'status_pemesanan',
        'total_awal',
        'jumlah_pajak',
        'persen_pajak',
        'biaya_pengiriman',
        'total_akhir',
        'catatan',
        'nama_depan_konsumen',
        'nama_belakang_konsumen',
        'alamat_konsumen',
        'no_hp_konsumen',
        'email_konsumen',
        'kota_id_konsumen',
        'provinsi_id_konsumen',
        'kode_pos_konsumen',
        'nama_kurir',
        'layanan_kurir',
        'approved_by',
        'approved_at',
        'cancelled_by',
        'cancelled_at',
        'catatan_pembatalan',
    ];

    protected $appends = ['nama_lengkap_konsumen'];

    public const CREATED    = 'created';
    public const CONFIRMED  = 'confirmed';
    public const DELIVERED  = 'delivered';
    public const COMPLETED  = 'completed';
    public const CANCELLED  = 'cancelled';

    public const ORDERCODE = 'INV';

    public const PAID   = 'paid';
    public const UNPAID = 'unpaid';

    public const STATUSES = [
        self::CREATED   => 'Created',
        self::CONFIRMED => 'Confirmed',
        self::DELIVERED => 'Delivered',
        self::COMPLETED => 'Completed',
        self::CANCELLED => 'Cancelled',
    ];
  

    public function pengiriman()
    {
        return $this->hasOne('App\Models\Pengiriman');
    }

 
    public function itemPemesanan()
    {
        return $this->hasMany('App\Models\ItemPemesanan');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function scopeForUser($query, $user)
    {
        return $query->where('user_id', $user->id);
    }

    public static function generateCode()
    {
        $dateCode = self::ORDERCODE . '/' . date('Ymd') . '/' . \General::integerToRoman(date('m')) . '/' . \General::integerToRoman(date('d')) . '/';

        $lastOrder = self::select([\DB::raw('MAX(pemesanan.kode) AS kode_akhir')])
            ->where('kode', 'like', $dateCode . '%')
            ->first();

        $lastOrderCode = !empty($lastOrder) ? $lastOrder['kode_akhir'] : null;

        $orderCode = $dateCode . '00001';
        if ($lastOrderCode) {
            $lastOrderNumber = str_replace($dateCode, '', $lastOrderCode);
            $nextOrderNumber = sprintf('%05d', (int)$lastOrderNumber + 1);

            $orderCode = $dateCode . $nextOrderNumber;
        }

        if (self::_isOrderCodeExists($orderCode)) {
            return generateOrderCode();
        }

        return $orderCode;
    }

    private static function _isOrderCodeExists($orderCode)
    {
        return Pemesanan::where('kode', '=', $orderCode)->exists();
    }
}
