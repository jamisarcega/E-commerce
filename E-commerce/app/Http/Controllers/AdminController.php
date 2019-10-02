<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Store;
use App\Term;
use App\Admin;
use App\Order;
use Auth;
use Hash;
class AdminController extends Controller
{
    public function __construct()
    { 
        $this->middleware('auth:admin');
    }
    public function index()
    {
        return view('admin.index');
    }
    public function manageAccounts()
    {
        $users = User::get();
        $stores = Store::get();
        return view('admin.accounts',compact('users','stores'));
    }
    public function enableUser($id)
    {
        $user = User::find($id);
        $user->account_status = 1;
        $user->save();
        return redirect()->back();
    }
    public function disableUser($id)
    {
        $user = User::find($id);
        $user->account_status = 0;
        $user->save();
        return redirect()->back();
    }
    public function enableStore($id)
    {
        $user = Store::find($id);
        $user->account_status = 1;
        $user->save();
        return redirect()->back();
    }
    public function disableStore($id)
    {
        $user = Store::find($id);
        $user->account_status = 0;
        $user->save();
        return redirect()->back();
    }
    public function terms()
    {
        $terms = Term::find(1);
        return view('admin.tos',compact('terms'));
    }
    public function updateTerms(Request $request)
    {
        $terms = Term::find(1);
        $terms->description = $request->terms;
        $terms->save();
        return view('admin.tos',compact('terms'));
    }
    public function receivables()
    {
        $stores = Store::get();
        $orders = Order::where('status', 1)->get();
        
        return view('admin.receivables',compact('stores','orders'));
    }

    public function updatePassword($id, Request $request)
    {
        $account = Admin::find($id);
        if(Hash::check($request->old, $account->password)){
            if($request->new == $request->retype){
                $account->password = Hash::make($request->new);
                $account->save();
            }
            else{
              return redirect()->back()->with('error','New password and retyped password did not match.');
            }
        }
        else{
            return redirect()->back()->with('error','Old password did not match the old password you typed.');
        }

        return redirect()->back()->with('success','Password is successfully updated!');
    }
    public function updatePhoto($id, Request $request)
    {
        $account = Admin::find($id);
        $this->validate($request,[
            'user_photo' => 'image|nullable|max:1999|required',
        ]);

        if($request->hasFile('user_photo')){
           
            $filenameWithExt = $request->file('user_photo')->getClientOriginalName();
           
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
           
            $extension = $request->file('user_photo')->getClientOriginalExtension();
         
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
          
            $path = $request->file('user_photo')->storeAs('public/user_photo_storage', $fileNameToStore);
        } 

        if($request->hasFile('user_photo')){
            $account->user_photo = $fileNameToStore;
        }
        $account->save();


        return redirect()->back()->with('success','Photo is successfully updated!');
    }
    public function accountSettings()
    {
        $account = Admin::find(Auth::user()->id);


        return view('admin.account',compact('account'));
    }
}
