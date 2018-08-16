<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Admin;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Notifications\ApproveAgenNotification;
use Notification;

class AnggotaControllerAPI extends Controller
{    

    public $successStatus = 200;

    public function login(Request $request)
    {
         if(Auth::attempt(['username' => request('username'), 'password' => request('password')])){
            $user = Auth::user();
            $getId = $user->id;
            if (!$user->status == 0) {
                $success['token'] =  null;
                // $user->createToken('nApp')->accessToken
                $refreshDeviceToken = User::findOrFail($getId);
                $refreshDeviceToken->update(['device_token' => $request->input('device_token')]);
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

        // $toAdmins = Admin::all();
        // $admin = $toAdmin->id;
        // $anggota = Admin::find(2);
        // $anggota->notify(new ApproveAgenNotification($anggota->id));
        
        // Validator of email
        $emailValidation = User::where('email', request('email'))->get();
        if (count($emailValidation) > 0) {
            $success['token'] = null;
            // $success['nama'] =  null;
            $success['status'] =  'fail';
            return response()->json(['response'=>$success]);
        }else{
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $input['device_token'] = $request->input('device_token');
            $user = User::create($input);
            
            $admin = Admin::find(1);
            $admin->notify(new ApproveAgenNotification($user));
            $success['token'] =  $user->createToken('nApp')->accessToken;
            // $success['nama'] =  $user->nama;
            $success['device_token'] = $request->input('device_token');
            $success['status'] =  'success';

            return response()->json(['response'=>$success], $this->successStatus);
        }
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
