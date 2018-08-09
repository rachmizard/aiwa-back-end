<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MasterNotifikasiResource;
use App\MasterNotifikasi;

class MasterNotifikasiControllerAPI extends Controller
{

    public function retrieveByDelivered(Request $request, $id)
    {
        return MasterNotifikasiResource::collection(MasterNotifikasi::orderBy('id', 'DESC')->where('anggota_id', '=', $id)->where('status', '=', 'delivered')->get());
    }

    public function retrieveByRead(Request $request, $id)
    {
        return MasterNotifikasiResource::collection(MasterNotifikasi::orderBy('id', 'DESC')->where('anggota_id', '=', $id)->where('status', '=', 'read')->get());
    }

    public function markAsRead(Request $request, $id)
    {
        $read = MasterNotifikasi::findOrFail($id);
        $read->update(['status' => $request->input('status')]);
        $success['status'] = 'success';
        return response()->json(['response' => $success]);
    }

    public function destroy($id)
    {
        //
    }
}
