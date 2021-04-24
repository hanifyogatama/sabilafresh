<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = "pembayaran";

    protected $fillable = [
        'pemesanan_id',
        'no_pembayaran',

        'jumlah',
        'metode',
        'status',
        'token',
        'payload',
        'tipe_pembayaran',
        'nomor_va',
        'vendor_pembayaran',
    ];

    public const PAYMENT_CHANNELS = [
        'credit_card', 'cimb_clicks',
        'bca_klikbca', 'bca_klikpay', 'bri_epay', 'echannel', 'permata_va',
        'bca_va', 'bni_va', 'bri_va', 'other_va', 'gopay', 'indomaret'
    ];

    public const EXPIRY_DURATION    = 1;
    public const EXPIRY_UNIT        = 'day';

    public const CHALLENGE          = 'challenge';
    public const SUCCESS            = 'success';
    public const SETTLEMENT         = 'settlement';
    public const PENDING            = 'pending';
    public const DENY               = 'deny';
    public const EXPIRE             = 'expire';
    public const CANCEL             = 'cancel';

    public const PAYMENTCODE        = 'PAY';


    public static function generateCode()
    {
        $dateCode = self::PAYMENTCODE . '/' . date('Ymd') . '/' . \General::integerToRoman(date('m')) . '/' . \General::integerToRoman(date('d')) . '/';

        $lastOrder = self::select([\DB::raw('MAX(pembayaran.no_pembayaran) AS last_code')])
            ->where('no_pembayaran', 'like', $dateCode . '%')
            ->first();

        $lastOrderCode = !empty($lastOrder) ? $lastOrder['last_code'] : null;

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
        return self::where('no_pembayaran', '=', $orderCode)->exists();
    }
}
