<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class AnggotaControllerAPI extends Controller
{    

    public $successStatus = 200;

    public function login()
    {
         if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            if (!$user->status == 0) {
                $success['token'] =  $user->createToken('nApp')->accessToken;
                $success['status'] =  'success';
                return response()->json(['response' => $success,
                                        'user' => $user], $this->successStatus);
            }else{
                $response['token'] = null;
                $response['status'] = 'Anda belum terverifikasi oleh admin!';
                return response()->json(['response' => $response]);
            }
        }
        else{
            $response['token'] = null;
            $response['status'] = 'failed';
            return response()->json(['response'=> $response]);
        }
    } 

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required|email',
            'username' => 'required',
            'password' => 'required',
            'jenis_kelamin' => 'required',
            'no_ktp' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'status' => 'required',
            'koordinator' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('nApp')->accessToken;
        $success['nama'] =  $user->nama;

        return response()->json(['success'=>$success], $this->successStatus);
    }

    public function details()
    {
        $user = Auth::user();
        $success['status'] = 'You are Authorized!';
        return response()->json(['response' => $success,
                                'user' => $user], $this->successStatus);
    }

    public function logout()
    {
         $user = Auth::user();
         return response()->json(['success' => $user], $this->successStatus);   
    }

}
