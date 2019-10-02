<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Store;
use App\Image;
use App\Order;
use App\Tag;
use Auth;
use Hash;
class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:store');
    }
    public function index()
    {
        

        return view('store.index');
    }
    public function updateOrder(Request $request, $id)
    {
        $validatedData = $request->validate([
            'tracking' => 'required|min:11',
        ]);
        $messages = [
            'tracking.required' => 'Please put the tracking number.',
            'tracking.min' => 'Tracking number is invalid. Please check and try again.',
        ];
        $order = Order::find($id);
        $order->tracking = $request->tracking;
        $order->status = 1;
        $order->notification = 1;
        $order->save();

        return redirect()->back();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function products()
    {
        $products = Product::where('store_id', Auth::user()->id)->get();

        return view('store.products',compact('products'));
    }
    public function editProduct(Request $request, $id)
    {
        $product = Product::find($id);
        $product->product_name = $request->name;
        $product->quantity  = $request->quantity;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->sale_percentage = $request->sale_percentage;
        $product->save();

        return redirect()->back()->with('edit-success', 'Product updated successfully!');




    }
    public function findProduct(Request $request)
    {
        $product = Product::where('id',$request->id)->with('tags')->get();
        $image = Image::where('product_id', $request->id)->first();
        if($image){
            return response()->json(array([
                'product' => $product , 
                'image' => $image,
                ]));
        }
        else{
            return response()->json(array( 'product' => $product));
        }

    }
    public function filterProducts(Request $request)
    {
        if($request->ajax())
        {
            $output="";
            $products=Product::where('product_name','LIKE','%'.$request->search."%")->get();
            if($products){
                foreach($products as $product){
                    $image = Image::where('product_id', $product->id)->first();
                        $status='';
                        if($product->status == 1){
                            $status = '<p class="text text-success"> <i class="far fa-arrow-alt-circle-up"></i></p>';
                        }
                        else{
                            $status = '<p class="text text-danger"><i class="far fa-arrow-alt-circle-down"></i></p>';
                        }
                        $output .= '<li style="width: 100%;">
                        <div class="col-lg-12"><a href="#" id="button'.$product->id.'" class="message card px-5 py-3 mb-4 bg-hover-gradient-violet no-anchor-style" style="min-height: 100px;">
                        <div class="row">
                        <div class="col-lg-6 d-flex align-items-center flex-column flex-lg-row text-center text-md-left"><strong class="h5 mb-0">'.

                            $status

                        .'
                        
                        <sup class="smaller text-gray font-weight-normal">Status</sup></strong><img src="" alt="..." style="max-width: 3rem" class="rounded-circle mx-3 my-2 my-lg-0">
                        <h6 class="mb-0 name">'.$product->product_name.'</h6>
                      </div>
                      <div class="col-lg-5 d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
                        <p class="mb-0 mt-3 mt-lg-0 description">'.$product->description.'</p>
                      </div>
                    </div></a>
                  </div>
                  </li>
                  <script>
                  $( document ).ready(function() {
                    $("#button'.$product->id.'").click(function(e){
                      e.preventDefault();
                    
                        $.ajax({
                          url: "store/products/find/'.$product->id.'",
                          method: "get",
                          dataType: "json",
                          data: {
                            id: $("#id'.$product->id.'").val(),
                          },
                          success: function(result){
                            $("#item-description").html(" ");
                            $("#totalPrice").html(" ");
                            $("#productName").html(" ");
                            $("#quantity").html(" ");
                            $.each(result, function(i, item) {
                              console.log(item[0]);
                                if(item.length === 1){
                                   $("#item-description").append("<p>"+item[0].description+"</p>");
                                    if(item[0].sale_percentage){
                                      item[0].price = item[0].price-((item[0].sale_percentage / 100) * item[0].price);
                                    }
                                   $("#totalPrice").append("<p>Php "+item[0].price+"</p>");
                                   $("#productName").append(item[0].product_name);
                                   $("#quantity").append("Quantity: "+item[0].quantity);
                                   $("#image").empty();
                                   $("#image").append("<img class='."img-responsive".' width='."100%".' src='.asset('uploads/images/no_photo.png').'>");  
                                }
                                else{
                                    $("#item-description").append("<p>"+item["product"][0].description+"</p>");
                                            if(item["product"][0].sale_percentage){
                                              item["product"][0].price = item["product"][0].price-((item["product"][0].sale_percentage / 100) * item["product"][0].price);
                                            }
                                           $("#totalPrice").append("<p>Php "+item["product"][0].price+"</p>");
                                           $("#productName").append(item["product"][0].product_name);
                                           $("#quantity").append("Quantity: "+item["product"][0].quantity);
                                           $("#editProduct").attr("data-target","#edit"+item["product"][0].id);   
                                           $("#image").empty();
                                           $("#image").append("<img src='."/uploads/images/".' class='."img-responsive".' width='."100%".'>");  

                                }   
                            });
                          },
                          error: function() { 
                              console.log(result);
                          }
                        });
                      });
                  });
                </script>';
                }
            }
            else{
                $output = "<li> No items to show. </li>";
            }
            // if($request->search == NULL){
            //     $output = Product::where('store_id', Auth::user()->id)->paginate(5);

            //     return response($output);

            // }

            return response($output);
        }

    }
    public function addProduct(Request $request)
    {
        $messages = [
            'whom.required' => 'Please specify the suitable age for the product.',
        ];
        $validatedData = $request->validate([
            'name' => 'required|min:4|max:50',
            'description' => 'required|min:10',
            'price' => 'required',
            'quantity' => 'required',
            'gender' => 'required',
            'whom' => 'required',
            'tags' => 'required',
            'file' => 'required',
        ],
        [
            'whom.required' => 'Please specify the suitable age for the product.',
            'gender.required' => 'Please specify the suitable gender/genders for the product.',
            'file.required' => 'Please provide an image of the product',
            'tags.required' => 'Please provide tags/categories of the product. (This will be used for search filtering.)',
        ]);
      
        
        
        $product = new Product;
        $product->product_name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->store_id = Auth::user()->id;
        $product->gender = $request->gender;
        $product->for_whom = $request->whom;
        $product->occasion = $request->occasion;
        $product->status = 1;

        if($request->sale){
            $product->sale_percentage = $request->sale;
        }
        $product->save();
        // include the tags
        $tags = explode(',', $request->tags);
        if(count($tags) == 1){
            $check = strtoupper($tags[0]);
            $tag = Tag::where('name', $check)->first();
            if($tag){
                $product->tags()->attach($tag);
            }
            else{
                $tag = new Tag;
                $tag->name = $check;
                $tag->save();
                $product->tags()->attach($tag);
            }
        }
        else{
            foreach($tags as $tag){
                $check = strtoupper($tag);
                $tag = Tag::where('name', $check)->first();
                if($tag){
                    $product->tags()->attach($tag);
                }
                else{
                    $tag = new Tag;
                    $tag->name = $check;
                    $tag->save();
                    $product->tags()->attach($tag);
                }
            }
        }
        

        if ($request->has('file')) {
            // latest product
            $product= Product::orderBy('id', 'DESC')->first();
            $image = $request->file('file');
            $name = time().'.'.$image->getClientOriginalExtension();
            $path = public_path('/uploads/images');
            $image->move($path,$name);

            $upload = new Image;
            $upload->product_id = $product->id;
            $upload->name = $name;
            $upload->save();

        }

        $request->session()->flash('success', 'Item has been added successfully!');
        
        return redirect()->back();
    }
    public function getOrders()
    {
        $orders = Order::get();
       
        return view('store.orders', compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    public function updateName($id, Request $request)
    {
        $account = Store::find($id);
        $account->name = $request->name;
        $account->save();

        return redirect()->back()->with('success','Name is successfully updated!');
    }
    public function updatePassword($id, Request $request)
    {
        $account = Store::find($id);
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
        $account = Store::find($id);
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
        $account = Store::find(Auth::user()->id);


        return view('store.account',compact('account'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
