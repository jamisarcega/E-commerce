<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Product;
use App\Status;
use App\Wishlist;
use App\User;
use App\Rating;
use Auth;
use Hash;
use Stripe;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect()->route('landing')->with('login-success','Logged in');
    }
    public function getWishlist(){
        $products = Wishlist::where('user_id', Auth::id())->get();

        return view('view-wishlist', compact('products'));

        
    }
    public function removeWishlist(Request $request, $id){
        $wishlist = Wishlist::where('product_id', $id)->where('user_id', Auth::id())->delete(); 

        return redirect()->back();

        
    }
    public function history()
    {
        // $orders = Order::where('user_id', Auth::user()->id)->where('status', 1)->get();
        $orders = Order::where('user_id', Auth::user()->id)->get();


        return view('purchase-history', compact('orders'));
    }
    public function getNotification($id)
    {
        // $orders = Order::where('user_id', Auth::user()->id)->where('status', 1)->get();
        $orders = Order::where('user_id', Auth::user()->id)->get();
        $order = Order::find($id);
        $order->notification = 1;
        $order->save();


        return view('purchase-history', compact('orders'));
    }
    public function addToWishlist($id)
    {
       $find = Wishlist::where('product_id' , $id)->where('user_id' , Auth::id())->first();

       if(!$find){
            $new = new Wishlist;
            $new->user_id = Auth::id();
            $new->product_id = $id;
            $new->save();
       }

       return redirect()->back();
    }
    public function addToCart(Request $request, $id)
    {
        $find = Order::where('user_id', Auth::user()->id)->where('product_id', $id)->where('status', 0)->first();
        if($find == NULL){
            $new = new Order;
            $new->user_id = Auth::user()->id;
            $new->product_id = $id;
            $new->quantity = $request->quantity;
            $new->save();
        }
        else{
           if($request->quantity == 0){
                $find->delete();
           }
           else{
            $find->quantity = $request->quantity;
            $find->save();
           }
        }

        return redirect()->back();

    }
    public function deleteFromCart(Request $request, $id)
    {
        $find = Order::find($id);
        $find->delete();

        return redirect()->back();

    }
    public function rate(Request $request)
    {
        $rate = Rating::where('user_id',Auth::user()->id)->where('product_id', $request->product)->first();
        if(!$rate){
            $rate = new Rating;
            $rate->user_id = Auth::user()->id;
            $rate->product_id = $request->product;
            $rate->rating = $request->rating;
            $rate->save();
            
            return response('success');
        }
        else{
            $rate->rating = $request->rating;
            $rate->save();
            
            return response('success');
        }
        // $rate = '2';
        // return response(Auth::user()->id);



    }
    public function charge()
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://rebit.ph/api/v1/provinces');
        $body = $response->getBody();
        $content =$body->getContents();
        $provinces = json_decode($content,false);

        $orders = Order::where('user_id', Auth::user()->id)->where('status', '0')->get();
        $price = 0;
       
        if($orders){
            foreach($orders as $order){
                if($order->product->sale_percentage != NULL){
                    $sale = $order->product->price - (($order->product->sale_percentage/100)*$order->product->price);
           
                    $price += ($order->quantity * $sale);        
            
                }
                else{
                    $price += ($order->quantity * $order->product->price);
                }
            }
   
        }

        return view('sample',compact('price', 'provinces'));
    }
    public function checkout()
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://rebit.ph/api/v1/provinces');
        $body = $response->getBody();
        $content =$body->getContents();
        $provinces = json_decode($content,false);
        
        $orders = Order::where('user_id', Auth::user()->id)->where('status', '0')->get();
        $price = 0;
       
        if($orders){
            foreach($orders as $order){
                if($order->product->sale_percentage != NULL){
                    $sale = $order->product->price - (($order->product->sale_percentage/100)*$order->product->price);
           
                    $price += ($order->quantity * $sale);        
            
                }
                else{
                    $price += ($order->quantity * $order->product->price);
                }
            }
             return view('checkout',compact('price','orders','provinces'));
        }
       
            return view('checkout',compact('price','orders','provinces'));
        
         


    }
    public function billing(Request $request)
    {
        $orders = Order::where('user_id', Auth::user()->id)->where('status', '0')->get();
        $price = 0;
       
        if($orders){
            foreach($orders as $order){
                if($order->product->sale_percentage != NULL){
                    $sale = $order->product->price - (($order->product->sale_percentage/100)*$order->product->price);
           
                    $price += ($order->quantity * $sale);        
            
                }
                else{
                    $price += ($order->quantity * $order->product->price);
                }
                $order->first_name = $request->firstName;
                $order->last_name = $request->lastName;
                $order->province = $request->province;
                $order->city = $request->city;
                $order->zip = $request->zip;
                $order->line_1 = $request->line_1;
                $order->line_2 = $request->line_2;
                $order->status = 0;

                $order->save();


            }
             
        }
    

        // try {
        //     $charge = Stripe::charges()->create([
        //         'amount' => $price,
        //         'currency' => 'PHP',
        //         'source' => $request->stripeToken,
        //         'description' => 'Order',

        //     ]);
        //     $orders = Order::where('user_id', Auth::user()->id)->where('status', '0')->get();
        //     foreach($orders as $order){
        //         $order->status = 1;
        //         $order->save();

        //         $status = new Status;
        //         $status->order_id = $order->id;
        //         $status->status = 1;
        //         $status->save();
        //     }

        //     return redirect()->route('user.history')->with('success','Order(s) Placed! Track your products here');
        // } catch (Exception $e) {
            
        // }

        return redirect()->route('user.history')->with('success','Order(s) Placed! Track your products here');
    }
    public function updatePassword($id, Request $request)
    {
        $account = User::find($id);
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
    public function updateName($id, Request $request)
    {
        $account = User::find($id);
        $account->name = $request->name;
        $account->middle_name = $request->mname;
        $account->last_name = $request->lname;
        $account->save();

        return redirect()->back()->with('success','Name is successfully updated!');
    }
    public function updatePhoto($id, Request $request)
    {
        $account = User::find($id);
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
        $account = User::find(Auth::user()->id);


        return view('account',compact('account'));
    }
}
