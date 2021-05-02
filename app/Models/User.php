<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Spatie\Permission\Traits\HasRoles;
use App\Models\Role;
use Cache;

class User extends Authenticatable
{

    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kode',
        'nama_depan',
        'nama_belakang',
        'no_hp',
        'gambar',
        'alamat',
        'provinsi_id',
        'kota_id',
        'kode_pos',
        'email',
        'password',
        'is_admin',
    ];

    public const UPLOAD_DIR = 'uploads';
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public const USERCODE = 'CUS';


    public function products()
    {
        return $this->hasMany('App\Models\Produk');
    }

    public function getCountCostumer()
    {
        $countCustomers = User::where();
        return  $countCustomers;
    }

    public function favorits()
    {
        return $this->hasMany('App\Models\Favorit');
    }

    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }

    public function getTimeAgo($carbonObject)
    {
        return str_ireplace(
            [' seconds', ' second', ' minutes', ' minute', ' hours', ' hour', ' days', ' day', ' weeks', ' week'],
            [' detik', ' detik', ' menit', ' menit', ' jam', ' jam', ' hari', ' hari', ' minggu', ' minggu'],
            $carbonObject->diffForHumans(null, true) . ' yang lalu'
        );
    }

    public static function generateCode()
    {
        $dateCode = self::USERCODE . '-' . date('Ymd') . '-';

        $lastUser = self::select([\DB::raw('MAX(users.kode) AS kode_akhir')])
            ->where('kode', 'like', $dateCode . '%')
            ->first();

        $lastUserCode = !empty($lastUser) ? $lastUser['kode_akhir'] : null;

        $userCode = $dateCode . '00001';
        if ($lastUserCode) {
            $lastUserNumber = str_replace($dateCode, '', $lastUserCode);
            $nextUserNumber = sprintf('%05d', (int)$lastUserNumber + 1);

            $userCode = $dateCode . $nextUserNumber;
        }

        if (self::_isUserCodeExists($userCode)) {
            return generateOrderCode();
        }

        return $userCode;
    }

    private static function _isUserCodeExists($userCode)
    {
        return User::where('kode', '=', $userCode)->exists();
    }
}
