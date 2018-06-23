<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class Admin extends \Eloquent implements Authenticatable
{
	use AuthenticableTrait;
    protected $table = 'admins';
    public $timestamps = true;
    protected $fillable = ['username', 'password', 'email', 'last_login', 'login_at'];
    protected $primaryKey = 'id';
}
