<?php 	
namespace App\Transformers;

// use League\Fractal\TransformerAbstract;
use App\Jamaah;

class JamaahTransformer
{
    /**
     * @return  array
     */
    public function transform(Jamaah $jamaah)
    {
        return [
            'id' =>  $jamaah->id,
            'tgl_daftar' => $jamaah->tgl_daftar,
            'id_umrah' => $jamaah->id_umrah,
            'id_jamaah' => $jamaah->id_jamaah,
            'nama' => $jamaah->nama,
            'tgl_berangkat' => $jamaah->tgl_berangkat,
            'tgl_pulang' => $jamaah->tgl_pulang,
            'marketing' => $jamaah->marketing,
            'staff' => $jamaah->staff,
            'no_telp' => $jamaah->no_telp,
            'marketing_fee' => $jamaah->marketing_fee,
            'diskon_marketing' => $jamaah->diskon_marketing,
            'koordinator' => $jamaah->koordinator,
            'koordinator_fee' => $jamaah->koordinator_fee,
            'top' => $jamaah->top,
            'top_fee' => $jamaah->top_fee,
            'status' => $jamaah->status,
            'tgl_transfer' => $jamaah->tgl_transfer,
            'periode' => $jamaah->periode,
        ];
    }
}

 ?>
