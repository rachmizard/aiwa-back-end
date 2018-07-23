<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Anggota;

class Jamaah extends Model
{
    protected $table = 'jamaah';
    public $fillable = ['id', 'id_umrah', 'id_jamaah', 'tgl_daftar', 'nama', 'tgl_berangkat', 'tgl_pulang', 'maskapai', 'marketing', 'staff', 'no_telp', 'fee', 'jumlah_fee'];
    public $timestamps = true;
    protected $primaryKey = 'id';

    public function anggota()
    {
    	return $this->belongsTo('App\User', 'marketing', 'id');
    }
}
