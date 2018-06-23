<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jamaah extends Model
{
    protected $table = 'jamaah';
    public $fillable = ['nama', 'alamat', 'no_telp'];
    public $timestamps = true;
    protected $primaryKey = 'id';
}
