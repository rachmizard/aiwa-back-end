<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\Jamaah;
use App\User;
use App\Master_Jadwal;
use Carbon\Carbon;

class RekapClosingAgenResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [    
            'marketing' => $this->nama,     
            'count' => $this->count()
        ];
    }

    public function count()
    {
        return Jamaah::where('marketing', $this->id)->where('periode', '1440')->count();
    }

}
