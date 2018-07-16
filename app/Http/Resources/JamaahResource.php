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
            'anggota_id' => (int) $this->anggota_id,
            'nama' => $this->nama,
            'alamat'  => $this->alamat,
            'no_telp'  => $this->no_telp,
            'jenis_kelamin' => $this->jenis_kelamin,
            'jml_dewasa' => $this->jml_dewasa,
            'jml_balita' => $this->jml_balita,
            'jml_infant' => $this->jml_infant,
            'pembayaran' => $this->pembayaran,
            'keterangan' => $this->keterangan,
            'status' => $this->status,
            'anggota' => new AnggotaResource($this->anggota),
        ];
    }
}
