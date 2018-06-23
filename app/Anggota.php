<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
	protected $table = 'anggotas';
    // public $fillable = ['no_ktp', 'nama', 'jenis_kelamin', '', '', '', '', '', '', '', '', ''];
    public $timestamps = true;
    protected $primaryKey = 'id';
    

}
