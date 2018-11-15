<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class DownloadSemuaJamaahExportResource extends Resource
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
            'tgl_daftar' => $this->tgl_daftar, 
            'nama' => $this->nama, 
            'tgl_berangkat' => $this->tgl_berangkat, 
            'tgl_pulang' => $this->tgl_pulang, 
            'maskapai' => $this->maskapai, 
            'nama_marketing' => $this->anggota['nama'], 
            'marketing' => $this->marketing, 
            'staff' => $this->staff, 
            'no_telp' => $this->no_telp, 
            'marketing_fee' => $this->marketing_fee, 
            'koordinator' => $this->koordinator, 
            'koordinator_fee' => $this->koordinator_fee, 
            'top' => $this->top, 
            'top_fee' => $this->top_fee, 
            'status' => $this->status, 
            'diskon_marketing' => $this->diskon_marketing, 
            'tgl_transfer' => $this->tgl_transfer, 
            'periode' => $this->periode
        ];
    }
}
