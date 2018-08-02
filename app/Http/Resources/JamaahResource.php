<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class JamaahResource extends Resource
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
            'id' => $this->id,
            'id_umrah' => $this->id_umrah,
            'id_jamaah' => $this->id_jamaah,
            'tgl_daftar'  => $this->tgl_daftar,
            'nama'  => $this->nama,
            'tgl_berangkat' => $this->tgl_berangkat,
            'tgl_pulang' => $this->tgl_pulang,
            'maskapai' => $this->maskapai,
            'marketing' => new AgenResource($this->anggota),
            'staff' => $this->staff,
            'no_telp' => $this->no_telp,
            'bulan_daftar' => $this->bulan_daftar,
            'bulan_berangkat' => $this->bulan_berangkat,
            'bulan_pulang' => $this->bulan_pulang,
            'marketing_fee' => $this->marketing_fee,
            'koordinator' => $this->koordinator,
            'koordinator_fee' => $this->koordinator_fee,
            'top' => $this->top,
            'top_fee' => $this->top_fee,
            'status' => $this->status,
        ];
    }
}
