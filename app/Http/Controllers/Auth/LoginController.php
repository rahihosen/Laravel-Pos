<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function login(Request $request)
    {


        $request->validate([
            'email'     => 'required|email',
            'password'  => 'required'
        ]);

        // Log the user In
        $credentials = $request->only('email', 'password');



        if (auth()->guard()->attempt($credentials)) {

            $admin_status = auth()->guard()->user()->admin_status;

            if ($admin_status == 1) {
                return redirect()->intended(url('/home'));
            } else {

                if (!auth()->guard()->attempt($credentials)) {

                    return back()->withErrors([
                        'error' => 'Wrong Credentials please try again'
                    ]);
                }

                auth()->guard()->logout();
                session()->flash('err', 'You are temporary blocked. please contact to admin');

                return redirect('/');
            }
        }



        // Session message
        session()->flash('msg', 'You have been logged in');

        // Redirect
        return redirect('/home');
    }
}
