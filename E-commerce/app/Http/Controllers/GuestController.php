<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Order;
use App\Tag;
use App\Image;
use App\Wishlist;
use App\User;
use App\Store;
use App\Rating;
use Auth;
use Hash;
class GuestController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 1)->paginate(8);
        $tags = Tag::get();
        
        return view('landing',compact('products','tags'));
    }
    public function aboutUs()
    {
   
        
        return view('about-us');
    }
    public function viewProduct($id)
    {
        $product = Product::where('id',$id)->with('tags')->first();
        $wishlist = NULL;
        $rating = NULL;
        $average = 0;
        $temp = 0;
        $avgRating = Rating::where('product_id', $product->id)->get();
        $allRatings = Rating::where('product_id',$id)->get();
        foreach($avgRating as $avg){
            $temp += $avg->rating;
        }
        if(count($avgRating)> 0){
            $average = $temp / count($avgRating);
        }
        if(Auth::check()){
            $wishlist = Wishlist::where('user_id', Auth::id())->where('product_id',$id)->first();
            $rating = Rating::where('user_id', Auth::user()->id)->where('product_id',$id)->first();
            // return view('view-product',compact('product','wishlist'));
        }
    
        return view('view-product',compact('product','wishlist','rating','average','allRatings'));
    }

    public function findProducts(Request $request)
    {   
        if($request->occasion != NULL && $request->tags == NULL && $request->gender == NULL && $request->whom == NULL){
             
            $products = Product::where('occasion',strtoupper($request->occasion))
                                ->get();
    
            // $output= ' ';
           
            // below is filter by month
        
            $output= ' ';

        }

        // not null : Whom & occasion
        else if($request->occasion != NULL && $request->tags == NULL && $request->gender == NULL && $request->whom != NULL){
             
            // $products = Product::where('for_whom',$request->whom)
            //                     ->orWhere('for_whom','4')
            //                     ->where('status',1)
            //                     ->get();
     
            // $output= ' ';
            $age = $request->whom;
            $by = $request->by;
            // below is filter by month
            if($by == 2){
                $products = Product::where('occasion',strtoupper($request->occasion))
                                    ->where('for_whom',1)
                                    ->orWhere('for_whom','4')
                                    ->where('status','1')
                                    ->get();
            }
            else{
                if($age >= 0 && $age <= 12){
                    $products = Product::where('for_whom',1)
                                        ->orWhere('for_whom','4')
                                        ->where('occasion',strtoupper($request->occasion))
                                        ->get();
                }
                else if($age >= 13 && $age <= 19){
                    $products = Product::where('for_whom',2)
                                        ->orWhere('for_whom','4')
                                        ->where('occasion',strtoupper($request->occasion))
                                        ->get();
                }
                else if($age >= 20 && $age <= 60){
                    $products = Product::where('for_whom',3)
                                        ->orWhere('for_whom','4')
                                        ->where('occasion',strtoupper($request->occasion))
                                        ->get();
                                      
                }
                else if($age >= 61){
                    $products = Product::where('for_whom',4)
                                        ->where('occasion',strtoupper($request->occasion))
                                        ->get();
                }
            }
            $output= ' ';

        }
        // not null: whom , gender
        if( $request->occasion != NULL && $request->gender != NULL && $request->whom != NULL && $request->tags == NULL){

            
            // $products = Product::where('gender',$request->gender)
            // ->orWhere('gender','3')
            // ->where('for_whom',$request->whom)
            // ->orWhere('for_whom',4)
            // ->where('status',1)
            // ->get();
         
            // $output= ' ';
        

            // here
            $age = $request->whom;
            $by = $request->by;
            // below is filter by month
            if($by == 2){
                // $products = Product::where('for_whom',1)
                //                     ->orWhere('for_whom','4')
                //                     ->where('status','1')
                //                     ->get();
                $products = Product::where('occasion',strtoupper($request->occasion))
                                    ->where('gender',$request->gender)
                                    ->orWhere('gender','3')
                                    ->where('for_whom',1)
                                    ->orWhere('for_whom',4)
                                    ->where('status',1)
                                    ->get();
                                    dd($products);
            }
            else{
                if($age >= 0 && $age <= 12){
                    $products = Product::where('gender',$request->gender)
                                        ->orWhere('gender','3')
                                        ->where('for_whom',1)
                                        ->orWhere('for_whom',4)
                                        ->where('occasion',strtoupper($request->occasion))
                                        ->get();
                                

                }
                else if($age >= 13 && $age <= 19){
                    $products = Product::where('gender',$request->gender)
                                        ->orWhere('gender','3')
                                        ->where('for_whom',2)
                                        ->orWhere('for_whom',4)
                                        ->where('occasion',strtoupper($request->occasion))
                                        ->get();
                }
                else if($age >= 20 && $age <= 60){
                    $products = Product::where('gender',$request->gender)
                                        ->orWhere('gender','3')
                                        ->where('for_whom',3)
                                        ->orWhere('for_whom',4)
                                        ->where('occasion',strtoupper($request->occasion))
                                        ->get();

                }
                else if($age >= 61){
                    $products = Product::where('gender',$request->gender)
                                        ->orWhere('gender','3')
                                        ->where('for_whom',4)
                                        ->where('occasion',strtoupper($request->occasion))                                       
                                        ->get();
                }
            }
            $output= ' ';

        }
         // not null: whom , gender,tags
         if($request->occasion != NULL && $request->gender != NULL && $request->whom != NULL && $request->tags != NULL){    
        
            $output= ' ';
            $tags = $request->tags;
            $counter = 1;
            $findTag = Tag::find($tags);
            // dd($findTag);
            $products = Product::whereHas('tags', function($q) use($findTag){
                $q->where('tag_id', $findTag->id);
                 })
                ->where('gender', $request->gender)
                ->orWhere('gender', 3)
                ->where('for_whom',$request->whom)
                ->orWhere('for_whom',4)
                ->where('occasion',strtoupper($request->occasion))
                ->get();
              
            // foreach($tags as $tag){
            //     $findTag = Tag::find($tag);
            //     if($counter == 1){
            //         $filter = Product::whereHas('tags', function($q) use($findTag){
            //         $q->where('tag_id', $findTag->id);
            //          })
            //         ->where('gender', $request->gender)
            //         ->orWhere('gender', 3)
            //         ->where('for_whom',$request->whom)
            //         ->orWhere('for_whom',4)
            //         ->where('status',1)
            //         ->where('occasion',strtoupper($request->occasion))
            //         ->get();
            //         $counter++;
            //     }
            //     else{
            //         $filter2 = Product::whereHas('tags', function($q) use($findTag){
            //         $q->where('tag_id', $findTag->id);
            //         })
            //         ->where('gender', $request->gender)
            //         ->orWhere('gender', 3)
            //         ->where('for_whom',$request->whom)
            //         ->orWhere('for_whom',4)
            //         ->where('status',1)
            //         ->where('occasion',strtoupper($request->occasion))
            //         ->get();
            //         $filter = $filter->merge($filter);
            //     }
                 

            // }
            // dd($filter);
        //  dd($findTag->id);

            // return response($output);
        
        }
     
        foreach($products as $product){
            $image = Image::where('product_id' ,$product->id )->first();
            $sale= '';
            if($product->sale_percentage == NULL){
                $sale ='<strong>P '.$product->price.' </strong>';
            }
            else{
                $price = $product->price-($product->price / $product->sale_percentage);
                $sale='   <del class="grey-text">P '.$product->price.'</del>
                <strong>P '.$price.'</strong>';
            }
            $output .= '<div class="col-lg-3 col-md-6 mb-4">

            <!--Card-->
            <div class="card" style="height: 40vh;">
            <!--Card image-->
            <div class="view overlay">
            <img src="'.asset('uploads/images/'.$image->name).'" class="card-img-top img-responsive" alt="">
            <a href="'.route('viewProduct', $product->id).'">
            <div class="mask rgba-white-slight"></div>
            </a>
            </div>
            <!--Card image-->

            <!--Card content-->
            <div class="card-body text-center" >
            <!--Category & Title-->
        
                <h5>Shirt</h5>
            
            <h5>
                <strong>
                <a href="'.route('viewProduct', $product->id).'" class="dark-grey-text">'.$product->product_name.'
                    <!-- <span class="badge badge-pill danger-color">NEW</span> -->
              </a>
                </strong>
            </h5>

            <h4 class="font-weight-bold blue-text">'.$sale.'</h4>

            </div>
            <!--Card content-->

            </div>
            <!--Card-->

            </div> ';
        }
        if(count($products) < 1){
            $output = ' <h5>No results found.</h5>';

        }


        return response($output);
    }


    public function registerUser(Request $request){

        if($request->captcha != $request->captchaInput){
            return redirect()->back()->with('captcha', 'Captcha is not correct. Try again');
        }
        if($request->retype != $request->password){
            
            return redirect()->back()->with('mismatch', 'Passwords did not match.');
        }
        
        $user = new User;
        $user->email = $request->email;
        $user->name = $request->name;
        $user->middle_name = $request->mname;
        $user->mobile = $request->mobile;
        $user->last_name = $request->lname;
        $user->api_token = str_random(60);
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success','Registration is successful.');
    }
    public function registerStore(Request $request){
        $user = new Store;
        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->back()->with('success','Registration is successful.');

    }
}
