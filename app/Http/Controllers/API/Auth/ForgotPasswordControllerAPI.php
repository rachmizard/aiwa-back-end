<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\Json;
use App\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Notifications\Notifiable;
use App\Notifications\AgenResetPasswordNotification;
use Notification;

class ForgotPasswordControllerAPI extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
     */
    use Notifiable, SendsPasswordResetEmails;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getResetToken(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);
        if ($request->wantsJson()) {
            $user = User::where('email', $request->input('email'))->first();
            if (!$user) {
                return response()->json(['token' => null, 'status' => 'email']);
            }else{
                $email = $request->input('email');
                $token = $this->broker()->createToken($user);
                Notification::route('mail', $email)->notify(new AgenResetPasswordNotification($token));
                $success['token'] = $token;
                $success['status'] = 'success';
                return response()->json(['response' => $success]);   
            }
        }else{
            $success['token'] = null;
            $success['status'] = 'failed';
            return response()->json(['response' => $success]);   
        }
    }
}
