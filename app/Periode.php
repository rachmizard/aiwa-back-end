<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    protected $table = 'master_periode';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $fillable = ['judul', 'start', 'end'];
    // protected $dates = ['start', 'end'];

}

