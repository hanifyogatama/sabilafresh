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
        'nama_depan',
        'nama_belakang',
        'no_hp',
        'alamat',
        'provinsi_id',
        'kota_id',
        'kode_pos',
        'email',
        'password',
        'is_admin',
    ];

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
}
