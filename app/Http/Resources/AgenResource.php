<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class AgenResource extends Resource
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
            'id' => (int) $this->id,
            'no_ktp' => $this->no_ktp,
            'nama' => $this->nama,
            'jenis_kelamin' => $this->jenis_kelamin,
            'no_telp' => $this->no_telp,
            'email' => $this->email,
            'username' => $this->username,
            'password' => $this->password,
            'status' => $this->status,
            'koordinator' => $this->koordinator,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
