<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use App\Admin;
use Lang;
use Carbon\Carbon;

class AdminLoginController extends Controller
{
     public function __construct()
    {
      $this->middleware('guest:admin');
    }

    public function create()
    {
        return view('auth.admin.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Admin::create([
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);
    }

    public function showLoginForm()
    {
      return view('auth.admin.login');
    }

    public function login(Request $request)
    {
      // Validate the form data
      $this->validate($request, [
        'email'   => 'required|email',
        'password' => 'required|min:6'
      ]);
      // Attempt to log the user in
      if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
        // if successful, then redirect to their intended location
        Carbon::setLocale('id');
        $userActivity = Admin::find(Auth::guard('admin')->user()->id);
        $userActivity->login_at = Carbon::now();
        $userActivity->save();
        return redirect()->intended(route('admin.dashboard'));
      }
      // if unsuccessful, then redirect back to the login with the form data
      if ( ! Admin::where('email', $request->email)->first() ) {
            return redirect()->back()
                ->withInput($request->only($this->username(), 'remember'))
                ->withErrors([
                    $this->username() => [trans('auth.failed')],
                ]);
        }

        if ( ! Admin::where('email', $request->email)->where('password', bcrypt($request->password))->first() ) {
            return redirect()->back()
                ->withInput($request->only($this->username(), 'remember'))
                ->withErrors([
                    'password' => [trans('auth.failed')],
                ]);
        }
    }

    public function username()
    {
    	return 'email';
    }

}
