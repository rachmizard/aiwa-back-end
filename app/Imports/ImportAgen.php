<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use App\User;
use DB;
use Carbon\Carbon;

class ImportAgen implements ToCollection, WithHeadingRow, ShouldQueue, WithChunkReading
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            if (!empty($row)) {
                $data['id'] = $row['id'];
                $data['nama'] = $row['nama'];
                $data['email'] = $row['email'];
                $data['username'] = $row['username'];
                $data['password'] = bcrypt($row['password']);
                $data['jenis_kelamin'] = $row['jenis_kelamin'];
                $data['no_ktp'] = $row['no_ktp'];
                $data['alamat'] = $row['alamat'];
                $data['no_telp'] = $row['no_telp'];
                $data['status'] = $row['status'];
                $data['koordinator'] = $row['koordinator'];
                $data['bank'] = $row['bank'];
                $data['no_rekening'] = $row['no_rekening'];
                $data['fee_reguler'] = $row['fee_reguler'];
                $data['fee_promo'] = $row['fee_promo'];
                $data['nama_rek_beda'] = $row['nama_rek_beda'];
                $data['website'] = $row['website'];
                $data['created_at'] = Carbon::now();
                $data['updated_at'] = Carbon::now();
            }
            if(!empty($data)) {
                $validator = User::where('id', $data['id'])->first();
                if($validator){
                    DB::table('users')->where('id', $data['id'])->update($data);
                    // Session::put('message', 'Your file is succesfully updated!');
                }else {
                    if ($data['id'] == null) {
                        $length = 10;
                        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        $charactersLength = strlen($characters);
                        $randomString = '';
                        for ($i = 0; $i < $length; $i++) {
                            $randomString .= $characters[rand(0, $charactersLength - 1)];
                        }
                        $data['id'] = $randomString;
                    }
                    DB::table('users')->insert($data);
                    // Session::put('message', 'Your file is succesfully imported!');
                }
            }
        }
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
