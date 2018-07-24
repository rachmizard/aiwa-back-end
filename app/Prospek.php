<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prospek extends Model
{
    protected $table = 'prospeks';
    public $timestamps = true;
    protected $primaryKey = 'id';


    public function anggota()
    {
        return $this->belongsTo('App\User', 'anggota_id', 'id');
    }

}
