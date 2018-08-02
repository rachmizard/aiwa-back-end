<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 'email', 'password', 'username', 'password', 'jenis_kelamin', 'no_ktp', 'alamat', 'no_telp', 'status', 'koordinator', 'bank', 'no_rekening', 'fee_reguler', 'fee_promo', 'nama_rek_beda', 'website'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function jamaah()
    {
        return $this->hasMany('App\Jamaah', 'id');
    }

    public function prospek()
    {
        return $this->hasMany('App\Prospek', 'id');
    }
}
