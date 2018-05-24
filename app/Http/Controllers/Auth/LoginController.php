<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

    protected function guard()
    {
        //return Auth::guard('guard-name');
    }

    public function authenticate(Request $request)
    {
        //dd("i am here");
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        $email = $request['email'];
        $password = bcrypt($request['passsword']);
        $arr['email'] = $email;
        $arr['password'] = $password;
        //dd($password);
        if(!Auth::attempt($request->only(['email', 'password']), $request->has('remember')) ){
            return redirect()->intended('dashboard');
        }
        return redirect()->route('home')->with('info', 'You are signed in');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
