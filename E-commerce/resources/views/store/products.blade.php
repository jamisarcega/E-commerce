@extends('layouts.store-layout')
@section('products')
active
@endsection
@section('store-main')

      <div class="page-holder w-100 d-flex flex-wrap">
        <div class="container-fluid px-xl-5">
          <section class="pt-4 pb-2">
            <!-- <div class="card">
              <div class="card-body"> -->
                <div class="tab-name pt-0 pb-0 mb-0">
                  <p class="mb-0 pb-0"><h2 class="text-uppercase">Products</h2></p>
                  <p class="m-0 p-0"><a href="#">Dashboard</a> > <a href="#">Products</a> </p>
              
                </div>
              <!-- </div>
            </div> -->
          </section>
          <section>
            <div class="row mb-4">
                 @if ($errors->any())
                    <div class="col-md-12 mb-2">
                        <div class="card text-white bg-danger">
                          <div class="card-body">
                            <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{$error}}</li>
                              @endforeach
                            </ul>
                          </div>
                        </div>
                    </div>
                  @endif
              <div class="col-lg-7 mb-4 mb-lg-0">
                <div class="card" >
                  <div class="card-header">
                    <div class="row">
                      <div class="col-lg-9 col-md-9 col-sm-6">
                         <h2 class="h5 text-uppercase mb-0">Product List</h2>
                         <div id="ss"></div>
                      </div>
                      <div class="col-lg-2 col-md-2 col-sm-6">
                        <button class="btn btn-primary" data-toggle="modal" id="addProduct" data-target="#addProductModal">Add Product</button>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                 
                      <input class="search form-control" id="searchProduct" placeholder="Search" />
                   
      
                    <p class="text-gray">This is a list of your products.</p>
                    <div class="chart-holder">
                      <div class="row" >
                      <ul style="width: 100%; list-style: none;" id="products" class="list">
                        @if(count($products) == 0)
                          <p><i>No products listed.</i></p>
                        @endif
                        @foreach($products as $product)
                        <form action="" method="GET" id="form{{$product->id}}">
                          @csrf
                          <li style="width: 100%;">
                          <div class="col-lg-12"><a href="#" id="button{{$product->id}}" class="message card px-5 py-3 mb-4 bg-hover-gradient-violet no-anchor-style" style="min-height: 100px;">
                            <div class="row">
                              <div class="col-lg-6 d-flex align-items-center flex-column flex-lg-row text-center text-md-left"><strong class="h5 mb-0">
                              @if($product->status == 1)
                                <p class="text text-success"> <i class="far fa-arrow-alt-circle-up"></i></p>
                                @else
                                <p class="text text-danger"><i class="far fa-arrow-alt-circle-down"></i></p>
                              
                              @endif
                              <p style="display: none;">{{ $image = App\Image::where('product_id', $product->id)->first() }}</p>
                              <sup class="smaller text-gray font-weight-normal">Status</sup></strong>
                              @if($image)
                                 <img src='{{ asset("uploads/images/".$image->name) }}' alt="..." style="max-width: 3rem" class="rounded-circle mx-3 my-2 my-lg-0"> 
                              @else
                                 <img src="" alt="..." style="max-width: 3rem" class="rounded-circle mx-3 my-2 my-lg-0">
                              @endif
                                <h6 class="mb-0 name">{{ $product->product_name }}</h6>
                              </div>
                              <div class="col-lg-5 d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
                                <p class="mb-0 mt-3 mt-lg-0 description">{{$product->description}}</p>
                              </div>
                            </div></a>
                          </div>
                          </li>
                          <input type="hidden" name="id{{$product->id}}" value="{{$product->id}}">
                        </form>


                        
                    
                        
                        
                        @endforeach
                      </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @foreach($products as $product)
              <script>
                          $( document ).ready(function() {
                            $('#button{{$product->id}}').click(function(e){
                              e.preventDefault();
                            
                                $.ajax({
                                  url: 'store/products/find/{{$product->id}}',
                                  method: 'get',
                                  dataType: 'json',
                                  data: {
                                    id: $('#id{{$product->id}}').val(),
                                  },
                                  success: function(result){
                                    $('#item-description').html(' ');
                                    $('#totalPrice').html(' ');
                                    $('#productName').html(' ');
                                    $('#quantity').html(' ');
                                    $.each(result, function(i, item) {
                                      // console.log(item);
                                        if(item.length === 1){
                                          $('#item-description').append('<p>'+item[0].description+'</p>');
                                            if(item[0].sale_percentage){
                                              item[0].price = item[0].price-((item[0].sale_percentage / 100) * item[0].price);
                                            

                                            }
                                           $('#totalPrice').append('<p>Php '+item[0].price+'</p>');
                                           $('#productName').append(item[0].product_name);
                                           $('#quantity').append('Quantity: '+item[0].quantity);
                                           $('#editProduct').attr('data-target','#edit'+item[0].id);
                                           $('#image').empty();
                                           $('#image').append('<img src="/uploads/images/no_photo.png" class="img-responsive" width="100%">');  
                                           

                                        }
                                        else{
                                        //  console.log(item['product'][0].tags[1].name);
                                        //  console.log(item['product'][0].tags);
                                          $('#item-description').append('<p>'+item['product'][0].description+'</p>');
                                            if(item['product'][0].sale_percentage){
                                              item['product'][0].price = item['product'][0].price-((item['product'][0].sale_percentage / 100) * item['product'][0].price);
                                            }
                                           $('#totalPrice').append('<p>Php '+item['product'][0].price+'</p>');
                                           $('#productName').append(item['product'][0].product_name);
                                           $('#quantity').append('Quantity: '+item['product'][0].quantity);
                                           $('#editProduct').attr('data-target','#edit'+item['product'][0].id);   
                                           $('#image').empty();
                                           $('#image').append('<img src="/uploads/images/'+item['image'].name+'" class="img-responsive" width="100%") }}">');  
                                           $('#productTags').empty();
                                           $.each( item['product'][0].tags, function( i, val ) {
                                              // $( "#" + i ).append( document.createTextNode( " - " + val ) );
                                           $('#productTags').append('<button class="btn btn-info btn-sm m-1" disabled>'+val.name+'</button>');
                                              console.log(val.name);
                                            });
                                          
                                        }
                                    });
                                  },
                                  error: function() { 
                                      console.log(result);
                                  }
                                });
                              });
                          });
                        </script>
              @endforeach
              <div class="col-lg-5 mb-4 mb-lg-0 pl-lg-0">
                <div class="card mb-3">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-lg-9 col-md-9 col-sm-6">
                         <h2 class="h5 text-uppercase mb-0">Product Information</h2>
                      </div>
                      <div class="col-lg-2 col-md-2 col-sm-6">
                        <button class="btn btn-primary" id="editProduct" data-toggle="modal">Edit</button>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="row align-items-center flex-row">
                      <div class="col-lg-5">
                        <h2 class="mb-0 d-flex align-items-center"><span id="productName">Click a Product</span><span class="dot bg-green d-inline-block ml-3"></span></h2><span class="text-muted text-uppercase small">Product Name</span>
                        <hr><small class="text-muted" id="quantity">Quantity</small>
                      </div>
                      <div class="col-lg-7" id="image">
                        <p>Image here</p>
                          
                      </div>
                      
                      <div class="col-md-12 mt-4">
                        <hr>
                          <p class="text-muted my-1">Tags:</p>
                          <p class="text-muted my-1"><sub>You can't remove or edit tags since this will be the basis of item approvement.</sub></p>
                          <div id="productTags" class="col-md-12">
                            <!-- <button class="btn btn-primary btn-sm" disabled>s</button> -->
                          </div>
                      </div>
                    </div>
                    <br>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body">
                    <div class="row align-items-center flex-row">
                      <div class="col-lg-12">
                        <h2 class="mb-0 d-flex align-items-center"><span id="totalPrice">Click a Product</span><span class="dot bg-violet d-inline-block ml-3"></span></h2><span class="text-muted text-uppercase small">Total Price (Incl. Sale percentage)</span>
                        <hr><small class="text-muted">Description</small>
                      </div>
                      <div class="col-lg-12" id="item-description">
                          
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            </div>
          </section>
       
         
        </div>
      </div>
    </div>



    <!-- Modals -->
    <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Product Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="details-tab" data-toggle="tab" href="#details" role="tab" aria-controls="details"
                aria-selected="true">Details</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                aria-selected="false">More Details</a>
            </li>
          </ul>
          <form action="{{ route('store.addProduct') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="tab-content mt-2" id="myTabContent">
              <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">
                <div class="row">
          
                  <div class="col-md-12">
                    <label for="name">Product Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                  </div><br><br>
                  <div class="col-md-6">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" name="price" id="price">
                  </div>
                  <div class="col-md-6">
                    <label for="quantity">Quantity</label>
                    <input type="number" class="form-control" name="quantity" id="quantity">
                  </div>
                  <div class="col-md-12">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                  </div>
                  <div class="col-md-12">
                    <hr>
                    <p class="text-gray">If you want to put this in sale, enter sale percentage below. Otherwise, leave it blank.</p> 
                    
                    <label for="sale">Sale Percentage</label>
                    <input type="number" name="sale" id="sale" class="form-control"> 
                  </div>
                  <div class="col-md-12 d-flex justify-content-end mt-2">
                  <br>
                        <a href="#" id="nextStep" class="btn btn-primary" style="width: 30%;">Next ></a>
                  </div>
                </div>
              </div><!--row content -->


              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                  <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-8 mb-4">
                          <label for="upload">Select Image</label>
                          <input type="file" name="file" >
                    </div>
                      <!--  -->
                      <div class="col-md-12">
                        <label for="tags">Input upto 5 tags/categories</label>
                        <ul id="tags" style="border-radius: 30px;">
                        </ul>
                      </div>
                  
                      <div class="col-md-12">
                          <div class="row">
                            <div class="col-md-12">
                            <hr> 
                              <p><h6>Search Filters</h6></p><br>
                              <p class="text-gray">This information will be used for searching your product. Make it accurate for your target market.</p>
                            </div>
                            <div class="col-md-6">
                                <label for="gender">Gender</label><br>
                                <input type="radio" name="gender" id="gender" value="1"> Male <br>
                                <input type="radio" name="gender" id="gender" value="2"> Female <br>
                                <input type="radio" name="gender" id="gender" value="3"> Both <br>           
                            </div>
                            <div class="col-md-6">
                                <label for="whom">For whom</label><br>
                                <input type="radio" name="whom" id="whom" value="1"> Kids (0 - 12 y/o)<br>
                                <input type="radio" name="whom" id="whom" value="2"> Teens (13 - 19 y/o)<br>
                                <input type="radio" name="whom" id="whom" value="3"> Adult (20 y/o  and above ) <br>
                                <input type="radio" name="whom" id="whom" value="4"> Any Age<br>           
                            </div>
                            <div class="col-md-6">
                                <label for="occasion">Occasion</label><br>
                                <input type="radio" name="occasion" id="Anniversary" value="Anniversary"> <label for="Anniversary"> Anniversary</label><br>
                                <input type="radio" name="occasion" id="Wedding" value="Wedding"> <label for="Wedding"> Wedding</label><br>
                                <input type="radio" name="occasion"  id="New Baby" value="New Baby"> <label for="New Baby"> New Baby</label><br>
                                <input type="radio" name="occasion"   id="I am sorry" value="I am sorry"> <label for="I am sorry"> I am sorry</label><br>
                                <input type="radio" name="occasion"  id="Birthday" value="Birthday"> <label for="Birthday"> Birthday</label><br>
                                <input type="radio" name="occasion"  id="Love" value="Love"> <label for="Love"> Love</label><br>
                                <input type="radio" name="occasion"  id="Get well soon" value="Get well soon"> <label for="Get well soon"> Get well soon</label><br>        
                            </div>
                          </div>
                          <br>
                          <hr>
                          <div class="col-md-12">
                            <p class="text-gray"><sub>Review the product before submitting. Our sytem will verify the given information if it is accurate. 
                            It needs to be verified before users can see it on the page.</sub></p>
                          </div>
                          
                      </div>
                      
                      <div class="col-md-12 d-flex justify-content-between mt-2">
                       <a href="#" id="previousStep" class="btn btn-primary" style="width: 30%;"> < Previous</a>
                       <p style="display: none;">s</p>

                       <button class="btn btn-primary" style="width: 30%;">Save</button>
                      </div>
                    </div>
                  </div><!--row content -->
              </div>
            </div> <!--tab content -->

           
          </form>
      </div>
    </div>
  </div>
</div>


<!-- for edit -->
@foreach($products as $product)
<div class="modal fade" id="edit{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Product Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

            <form action="{{ route('store.editProduct', $product->id) }}" method="POST" >
              @csrf
       

              <div class="row">
              
                <div class="col-md-12">
                  <label for="name">Product Name</label>
                  <input type="text" name="name" id="name" value="{{$product->product_name}}" class="form-control">
                </div><br><br>
                <div class="col-md-6">
                  <label for="price">Price</label>
                  <input type="number" class="form-control" value="{{$product->price}}" name="price" id="price">
                </div>
                <div class="col-md-6">
                  <label for="quantity">Quantity</label>
                  <input type="number" class="form-control" name="quantity" value="{{$product->quantity}}" id="quantity">
                </div>
                <div class="col-md-12">
                  <label for="description">Description</label>
                  <textarea class="form-control" name="description" id="description" rows="3">{{$product->description}}</textarea>
                </div>
                <div class="col-md-12">
                  <hr>
                  <p class="text-gray">If you want to put this in sale, enter sale percentage below. Otherwise, leave it blank.</p> 
                  
                  <label for="sale">Sale Percentage</label>
                  <input type="number" name="sale" value="{{$product->sale_percentage}}" id="sale" class="form-control"> 
                </div>
                <div class="col-md-12">
                  <br>
                  <button class="btn btn-primary" style="width: 100%;">Save</button>
                </div>
              </div>
            </form>
      
        
          
      </div>
    </div>
  </div>
</div>

@endforeach
@endsection

@section('scripts')
<script>

$( document ).ready(function() {
  $("#tags").tagit({
    allowSpaces: true,
    tagLimit: 5,
    singleField: true
  });

  $('#nextStep').click(function(){
    $('#profile-tab').click();
  });
  $('#previousStep').click(function(){
    $('#details-tab').click();
  });
});
</script>

@endsection

@section('inside-scripts')
<script>
  $( document ).ready(function() {
    @if(session('success'))
        
          Swal.fire("{{ session('success') }}","*This item is in pending status. This wont be available until admin approves.","success");
 
    @endif
    @if(session('edit-success'))
        
        Swal.fire("{{ session('edit-success') }}","","success");

   @endif
   $('#searchProduct').on('keyup',function(){
      $value = $(this).val();
      $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
      $.ajax({
        type : 'get',
        url : 'store/products/filter',
        data:{'search':$value},
        success:function(data){
          $('#products').html(data);
          console.log(data);
        }
      });
    });

    
  });
</script>
@endsection