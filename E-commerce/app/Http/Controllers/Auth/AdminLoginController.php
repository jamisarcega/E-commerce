<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class AdminLoginController extends Controller
{
    protected $redirectAfterLogout = '/';

    public function __construct()
    {
        $this->middleware('guest:admin');
    }
    public function adminLogin()
    {
        return view('auth.admin.login');
    }
    public function adminLoginSubmit(Request $request)
    {
      
        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)){
            return redirect()->intended(url('admin'));
        }
    
        
        return redirect()->back()->withInput($request->only('email','remember'));
    }
    public function logout(Request $request)
    {
        $this->guard()->logout();

    $request->session()->invalidate();

    return redirect('/');
    }
}
