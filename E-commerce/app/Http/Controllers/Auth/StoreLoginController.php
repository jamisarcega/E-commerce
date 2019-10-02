<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use AuthenticatesUsers;

class StoreLoginController extends Controller
{
    protected $redirectAfterLogout = '/store/login';

    public function __construct()
    {
        $this->middleware('guest:store');
    }
    public function storeLogin()
    {
        return view('auth.store.1login');
    }
    public function storeLoginSubmit(Request $request)
    {
      
        if(Auth::guard('store')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)){
            return redirect()->intended(route('store.index'));
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
