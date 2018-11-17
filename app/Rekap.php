<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rekap extends Model
{
    protected $table = 'rekap_jamaah';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $fillable = ['anggota_id', 'total', 'periode'];

    public function anggota()
    {
        return $this->belongsTo('App\User', 'anggota_id', 'id');
    }

}
