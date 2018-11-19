<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\User;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportAgen implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::select([
    	  'id',
      	  'nama', 
      	  'email', 
      	  'username', 
      	  'password', 
      	  'jenis_kelamin', 
      	  'no_ktp', 
      	  'alamat', 
      	  'no_telp', 
      	  'status', 
      	  'koordinator', 
      	  'bank', 
      	  'no_rekening', 
      	  'fee_reguler', 
      	  'fee_promo', 
      	  'nama_rek_beda', 
      	  'website'
    	])->get();
    }

    public function headings(): array
    {
    	return [
    	  'id',
      	  'nama', 
      	  'email', 
      	  'username', 
      	  'password', 
      	  'jenis_kelamin', 
      	  'no_ktp', 
      	  'alamat', 
      	  'no_telp', 
      	  'status', 
      	  'koordinator', 
      	  'bank', 
      	  'no_rekening', 
      	  'fee_reguler', 
      	  'fee_promo', 
      	  'nama_rek_beda', 
      	  'website'
    	];
    }


}
