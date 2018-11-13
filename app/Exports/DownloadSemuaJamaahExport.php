<?php

namespace App\Exports;

use App\Jamaah;
use Maatwebsite\Excel\Concerns\FromCollection;

class DownloadSemuaJamaahExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Jamaah::all();
    }
}
