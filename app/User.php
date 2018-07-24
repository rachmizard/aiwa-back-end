<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 'email', 'password', 'username', 'password', 'jenis_kelamin', 'no_ktp', 'alamat', 'no_telp', 'status', 'koordinator', 'login_at', 'last_login'
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
