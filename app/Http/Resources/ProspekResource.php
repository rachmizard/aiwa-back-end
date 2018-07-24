<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ProspekResource extends Resource
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
            'anggota_id' => $this->anggota_id,
            'pic' => $this->pic,
            'no_telp' => $this->no_telp,
            'jml_dewasa' => $this->jml_dewasa,
            'jml_infant' => $this->jml_infant,
            'jml_balita' => $this->jml_balita,
            'tgl_keberangkatan' => $this->tgl_keberangkatan,
            'jenis' => $this->jenis,
            'dobel' => $this->dobel,
            'triple' => $this->triple,
            'quard' => $this->quard,
            'passport' => $this->passport,
            'meningitis' => $this->meningitis,
            'pas_foto' => $this->pas_foto,
            'buku_nikah' => $this->buku_nikah,
            'fc_akta' => $this->fc_akta,
            'visa_progresif' => $this->visa_progresif,
            'diskon' => $this->diskon,
            'keterangan' => $this->keterangan,
            'tanggal_followup' => $this->tanggal_followup,
            'pembayaran' => $this->pembayaran,
            'anggota' => new AgenResource($this->prospek),
        ];
    }
}
