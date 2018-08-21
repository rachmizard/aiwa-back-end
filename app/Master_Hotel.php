<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Master_Hotel extends Model
{
    //
    protected $table = 'master_hotels';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $fillable = ['nama_hotel', 'kota', 'link', 'link_map', 'skor', 'wifi', 'park', 'kamar_rokok','kamar_ac', 'kamar_keluarga', 'makanan_enak', 'info'];

    public function gallery()
    {
    	return $this->hasMany('App\MasterGallery', 'id');
    }
}
