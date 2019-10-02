@extends('layouts.user-layout')
@section('content')
  <main class="mt-5 pt-4">
    <div class="container dark-grey-text mt-5">

      <!--Grid row-->
      <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-6 mb-4 mt-4">

        <p style="display:none;">{{ $image = App\Image::where('product_id' ,$product->id )->first() }}</p>
                @if($image)
                  <img src="{{ asset('uploads/images/'.$image->name) }}" class="img-fluid" alt="">
                @else
                  <img src="{{ asset('uploads/images/no_photo.png') }}" class="img-fluid"  alt="">                    
                @endif

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-6 mb-4">

          <!--Content-->
          <div class="p-4">

            <div class="mb-3">
              <!-- <a href="">
                <span class="badge purple mr-1">Category 2</span>
              </a> -->
              <p class="grey-text"><strong>Seller: {{ $product->store->email }}</strong></p>
            
            </div>
           

            <div class="d-flex justify-content-between">
              <p class="lead font-weight-bold">{{$product->product_name}}</p>
              @if($wishlist != NULL)
                  <form action="{{ route('user.removeWishlist', $product->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm mt-n1"><i class="fas fa-check"></i> Remove from Wishlist</button>
                  </form>
              @else
                <form action="{{ route('user.addToWishlist', $product->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-outline-danger btn-sm mt-n1"><span class="text-dark"><strong>Add to Wishlist </strong><i class="fas fa-heart text-danger"></i></span></button>
                </form>
              @endif
            </div>
       
            <div class="mt-n3 mb-3 d-flex">
              <p>Overall Rating</p>
              <div id="overallRating"></div>
            </div>

            @if($product->sale_percentage != NULL)
            <p class="lead">
              <span class="mr-1">
                <del>P {{ $product->price }}</del>
              </span>
              <span>P {{ $product->price-($product->price / $product->sale_percentage) }}</span>
              <span class="badge badge-danger">{{ $product->sale_percentage }}% SALE!</span>
            </p>
            @else
            <p class="lead">
              <span>P {{ $product->price}}</span>
            </p>
            @endif
            
              <p class="text-muted mb-n3">Tags</p><br>
              <div id="tags mb-n5">
                @foreach($product->tags as $tag)
                  <button class="btn btn-mdb-color btn-sm" disabled>{{ $tag->name }}</button>
                @endforeach

              </div>
              <hr>
              @if(Auth::check())
                <p class="text-muted mb-n3">Rate Product</p><br>
                 <div id="rateYo"></div>
                <hr>
              @endif  
              
            @if(Auth::check())
                  <p style="display: none">{{ $order = App\Order::where('user_id', Auth::user()->id)->where('status', 0)->where('product_id', $product->id)->first() }}</p>
                @if($order)
                  <div class="d-flex">
                  <form action="{{ route('user.addToCart', $product->id) }}" method="POST" class="d-flex justify-content-left">
                    <!-- Default input -->
                    @csrf
                    <input type="number" min="0" max="{{ $product->quantity }}" value="{{ $order->quantity }}" name="quantity" aria-label="Search" class="form-control" style="width: 100px">
                    <button class="btn btn-primary btn-md my-0 p" type="submit">Update Cart
                      <i class="fas fa-shopping-cart ml-1"></i>
                    </button>
                   

                  </form>
                  <form action="{{ route('user.deleteFromCart', $order->id) }}" method="POST" class="d-flex justify-content-left">
                  @method('DELETE')
                    <!-- Default input -->
                    @csrf
                    
                    <button class="btn btn-danger btn-md my-0 p" type="submit">Remove From Cart
                      <i class="fas fa-trash ml-1"></i>
                    </button>
                   

                  </form>
                  </div>
                @else
                  <form action="{{ route('user.addToCart', $product->id) }}" method="POST" class="d-flex justify-content-left">
                    <!-- Default input -->
                    @csrf
                    <input type="number" min="1" max="{{ $product->quantity }}" value="1" name="quantity" aria-label="Search" class="form-control" style="width: 100px">
                    <button class="btn btn-primary btn-md my-0 p" type="submit">Add to cart
                      <i class="fas fa-shopping-cart ml-1"></i>
                    </button>

                  </form>  
                @endif
            @else
              <form action="{{ route('user.addToCart', $product->id) }}" method="POST" class="d-flex justify-content-left">
                <!-- Default input -->
                @csrf
                <input type="number" min="1" max="{{ $product->quantity }}" value="1" name="quantity" aria-label="Search" class="form-control" style="width: 100px">
                <button class="btn btn-primary btn-md my-0 p" type="submit">Add to cart
                  <i class="fas fa-shopping-cart ml-1"></i>
                </button>

              </form>
            @endif
           

          </div>
          <!--Content-->

        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->

      <hr>

      <!--Grid row-->
      <div class="row d-flex justify-content-center wow fadeIn">
      <div class="col-md-12">
        <h2>Product Information</h2>
        <br>
      </div>
      <div class="col-md-3">
        <div class="card grey lighten-4 z-depth-1">
            <div class="card-body">
                <div class="nav flex-column nav-pills pills-secondary md-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active pb-n5 " id="v-pills-description-tab" data-toggle="pill" href="#v-pills-description" role="tab"
                      aria-controls="v-pills-home" aria-selected="true">
                        <span class="d-flex pb-n5 mb-n3 p-auto justify-content-between">
                            <p class="pb-n5 p-auto">Description</p>
                            <!-- <p class="py-0">Description</p> -->
                            <i class="fas fa-info-circle py-auto mb-n5 pt-1 fa-lg"></i>
                        </span>
                      </a>
                    <a class="nav-link" id="v-pills-comments-tab" data-toggle="pill" href="#v-pills-comments" role="tab"
                      aria-controls="v-pills-comments" aria-selected="false">
                        <span class="d-flex pb-n5 mb-n3 p-auto justify-content-between">
                            <p class="pb-n5 p-auto">Comments</p>
                            <!-- <p class="py-0">Description</p> -->
                            <i class="fas fa-comments py-auto mb-n5 pt-1 fa-lg"></i>
                        </span>
                      </a>
                    <a class="nav-link" id="v-pills-ratings-tab" data-toggle="pill" href="#v-pills-ratings" role="tab"
                      aria-controls="v-pills-ratings" aria-selected="false">
                        <span class="d-flex pb-n5 mb-n3 p-auto justify-content-between">
                            <p class="pb-n5 p-auto">Ratings</p>
                            <!-- <p class="py-0">Description</p> -->
                            <i class="fas fa-star py-auto mb-n5 pt-1 fa-lg"></i>
                        </span>
                      </a>
                </div>
            </div>
        </div>
      </div>
  <div class="col-md-9 mt-n5" style="min-height: 60vh;">
    <div class="tab-content" id="v-pills-tabContent">
      <div class="tab-pane fade show active" id="v-pills-description" role="tabpanel" aria-labelledby="v-pills-description-tab">
          <h4 class="my-4 h4">Product Description</h4>

          <p>{{ $product->description }}</p>
      </div>
    
      <div class="tab-pane fade" id="v-pills-comments"  role="tabpanel" aria-labelledby="v-pills-comments-tab">
        <div class="commentCards" style="max-height: 50vh; overflow-y: scroll;">
          <div class="card mb-3  mx-2" v-for="comment in comments">
            <div class="card-body">
              <div class="media">
              @if(Auth::check())
                @if(Auth::user()->user_photo)
                 <img class="d-flex rounded-circle avatar z-depth-1-half mr-3" height="50" src="{{ asset('storage/user_photo_storage')}}/{{ Auth::user()->user_photo }}"
                  alt="Avatar">
                @else
                <img class="d-flex rounded-circle avatar z-depth-1-half mr-3" height="50" src="{{asset('theme/img/avatar-6.jpg')}}"
                  alt="Avatar">
                @endif
              @else
                <img class="d-flex rounded-circle avatar z-depth-1-half mr-3" height="50" src="{{asset('theme/img/avatar-6.jpg')}}"
                  alt="Avatar">
              @endif    
                <div class="media-body">
                  <h6 class="mt-0 font-weight-bold ">@{{comment.user.name}}</h6>
                  <p class="text-muted">@{{comment.body}} </p>
                    <hr>
                  <div class="d-flex flex-row-reverse">
                    <sub class="text-black-50">@{{ comment.created_at }}</sub>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <br><br>
        <div class="form-group shadow-textarea">
          <label for="exampleFormControlTextarea6">Write a comment</label>
          <textarea class="form-control z-depth-1" id="exampleFormControlTextarea6" v-model="commentBox" rows="3" placeholder="Write something here..."></textarea>
          <button class="btn btn-primary mt-2" @click.prevent="postComment">Post Comment</button>
        </div>
      </div>
      <div class="tab-pane fade" id="v-pills-ratings" role="tabpanel" aria-labelledby="v-pills-ratings-tab">
          @foreach($allRatings as $ar)
            <div class="card mb-3  mx-2">
              <div class="card-body">
                <div class="media">
                  <img class="d-flex rounded-circle avatar z-depth-1-half mr-3" height="50" src="https://mdbootstrap.com/img/Photos/Avatars/avatar-10.jpg"
                    alt="Avatar">
                  <div class="media-body">
                    <h6 class="mt-0 font-weight-bold ">{{$ar->user->name}} Rated this product</h6>
                    <p class="text-muted">{{ $ar->rating }} Stars!</p>
                     
                    <div class="d-flex flex-row-reverse">
                      <sub class="text-black-50">{{ $ar->rating }} Stars!</sub>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
      </div>
    </div>

      </div>
     
    

    </div>

  </main>

  <!--Main layout-->
@endsection

@section('scripts')
<script>
  $( document ).ready(function() {
    @if(session('success'))
        
          Swal.fire("{{ session('success') }}","","success");
          {{ session()->flush() }} 
 
    @endif   

    var $rateYo = $("#rateYo").rateYo({
      fullStar: true,
      spacing: "5px",
      @if($rating)
        rating: {{ $rating->rating }},
      @endif
      onSet: function (rating, rateYoInstance) {

        // console.log(rating);
        $rating = rating;
        $product = {{ $product->id }}
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        $.ajax({
          type : 'post',
          url : '{{ route('user.rate') }}',
          data:{'rating':$rating,'product':$product, 'csrftoken' : '{{ csrf_token() }}' },
          success:function(data){
          
            console.log(data);
          }
        });


      }
    });
    var $overallRating = $("#overallRating").rateYo({
      rating: {{ $average }},
      readOnly: true,
      spacing: "2px",
      starWidth: "18px"
    });
    

    
  });
  </script>
  <script>
    const app = new Vue({
      el: '#main',
      data:{
        comments:{},
        commentBox: '',
        product: {!! $product->toJson() !!},
        user:{!! Auth::check() ? Auth::user()->toJson() : 'null' !!},
      },
      mounted(){
        this.getComments();
      },
      methods:{
        getComments(){
          axios.get('/api/product/'+this.product.id+'/comments')
               .then((response) => {
                  this.comments = response.data
               })
               .catch(function (error){
                 console.log(error);
               });
        },
        postComment(){
          axios.post('/api/product/'+this.product.id+'/comment', {
            api_token: this.user.api_token,
            body: this.commentBox
          })
          .then((response) => {
              this.comments.unshift(response.data);
              this.commentBox = '';
          })
          .catch(function (error){
                 console.log(error);
          });
        }
      }
    });
  </script>
@endsection