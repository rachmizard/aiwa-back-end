<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caljam extends Model
{
    protected $table = 'caljams';
    public $timestamps = true;
    protected $primaryKey = 'id';
}
