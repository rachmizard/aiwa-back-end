<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Master_Jadwal extends Model
{
    //
    protected $table = 'master_jadwals';
    public $timestamps = true;
    protected $casts = [
        'paket' => 'array',
    ];
}
