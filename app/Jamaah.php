<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Anggota;
use Carbon\Carbon;

class Jamaah extends Model
{
    protected $table = 'jamaah';
    public $fillable = ['id', 'id_umrah', 'id_jamaah', 'tgl_daftar', 'nama', 'tgl_berangkat', 'tgl_pulang', 'maskapai', 'marketing', 'staff', 'no_telp', 'bulan_daftar', 'bulan_berangkat', 'bulan_pulang', 'marketing_fee', 'koordinator', 'koordinator_fee', 'top', 'top_fee', 'status'];
    public $timestamps = true;
    protected $primaryKey = 'id';

    public function anggota()
    {
    	return $this->belongsTo(User::class, 'marketing', 'id');
    }
}
