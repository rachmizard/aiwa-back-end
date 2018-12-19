<?php

namespace App\Http\Resources;

use App\Jamaah;
use Illuminate\Http\Resources\Json\Resource;

class TotalByTglBerangkatResource extends Resource
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
        $periode = $request->requestPeriode;
        return [
            'tgl_berangkat' => date('d M Y', strtotime($this->tgl_berangkat)),
            'periode' => $periode,
            'total_closing' => $this->total_closing($this->tgl_berangkat)
        ];
    }

    public function total_closing($tgl_berangkat)
    {
        return $tgl_berangkat;
    }
}
