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
            'tgl_daftar'  => $this->tgl_daftar,
            'nama'  => $this->nama,
            'tgl_berangkat' => $this->tgl_berangkat,
            'tgl_pulang' => $this->tgl_pulang,
            'marketing' => new AgenResource($this->anggota),
            'staff' => $this->staff,
            'no_telp' => $this->no_telp,
            'marketing_fee' => $this->marketing_fee,
            'koordinator' => $this->koordinator,
            'koordinator_fee' => $this->koordinator_fee,
            'top' => $this->top,
            'top_fee' => $this->top_fee,
            'status' => $this->status,
        ];
    }
}
