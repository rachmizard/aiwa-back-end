<?php

namespace App\Http\Resources;

use App\Jamaah;
use Illuminate\Http\Resources\Json\Resource;

class AgenWithRekapResource extends Resource
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
        $start_date = $request->start;
        $end_date = $request->end;
        $periode = $request->requestPeriode;
        return [
            'anggota_id' => $this->anggota_id,
            'nama' => $this->anggota['nama'],
            'total' => $this->total($this->anggota_id, $periode, $start_date, $end_date)
        ];
    }

    public function total($anggota_id, $periode, $start_date, $end_date)
    {
        $total['periode'] = $periode;
        $total['start_date'] = $start_date;
        $total['end_date'] = $end_date;
        // Let's count it !
        $total['total_result'] = Jamaah::where('marketing', $anggota_id)->whereBetween('tgl_berangkat', [$start_date, $end_date])->where('periode', $periode)->count();

        return $total;
    }
}
