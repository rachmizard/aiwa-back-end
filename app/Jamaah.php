<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Anggota;

class Jamaah extends Model
{
    protected $table = 'jamaah';
    public $fillable = ['anggota_id', 'nama', 'alamat', 'no_telp', 'jenis_kelamin', 'jml_dewasa', 'jml_balita', 'jml_infant', 'pembayaran', 'keterangan', 'status'];
    public $timestamps = true;
    protected $primaryKey = 'id';

    public function anggota()
    {
    	return $this->belongsTo('App\Anggota');
    }
}
