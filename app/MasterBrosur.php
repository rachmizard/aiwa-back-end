<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterBrosur extends Model
{
   
    protected $table = 'master_brosurs';
    public $timestamps = true;
    protected $primaryKey = 'id';
    public $fillable = ['id', 'file_brosur', 'description'];

}
