<?php

namespace App\Exports;

use App\Jamaah;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Http\Resources\DownloadSemuaJamaahExportResource;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DownloadSemuaJamaahExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DownloadSemuaJamaahExportResource::collection(Jamaah::all());
    }

    public function headings(): array
    {
    	return [
    		'id', 
    		'id_umrah', 
    		'id_jamaah', 
    		'tgl_daftar', 
    		'nama', 
    		'tgl_berangkat', 
    		'tgl_pulang', 
    		'maskapai', 
    		'nama_marketing', 
    		'marketing', 
    		'staff', 
    		'no_telp', 
    		'marketing_fee', 
    		'koordinator', 
    		'koordinator_fee', 
    		'top', 
    		'top_fee', 
    		'status', 
    		'diskon_marketing', 
    		'tgl_transfer', 
    		'periode'];
    }
}
