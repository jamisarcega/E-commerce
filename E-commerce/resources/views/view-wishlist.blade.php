
@extends('layouts.user-layout')
@section('content')
<main class="mt-5 pt-4">
<div class="container wow fadeIn pt-5">
<h2 class="my-5 h2 text-center">My Wishlist </h2>

  <div class="container">
    <div class="row">
        @foreach($products as $product)
        <div class="col-lg-3 col-md-6 mb-4">

                <!--Card-->
                <div class="card" style="height: 40vh;">

                <!--Card image-->
                <div class="view overlay">
                <p style="display:none;">{{ $image = App\Image::where('product_id' ,$product->product_id )->first() }}</p>
                    @if($image)
                    <img src="{{ asset('uploads/images/'.$image->name) }}" class="card-img-top img-responsive" alt="">
                    @else
                    <img src="{{ asset('uploads/images/no_photo.png') }}" class="card-img-top img-responsive" style="min-height: 30vh" alt="">                    
                    @endif
                    <a href="{{ route('viewProduct', $product->id) }}">
                    <div class="mask rgba-white-slight"></div>
                    </a>
                </div>
                <!--Card image-->

                <!--Card content-->
                <div class="card-body text-center" >
                    <!--Category & Title-->
                
                    <!-- <h5>Shirt</h5> -->
                
                    <h5>
                    <strong>
                        <a href="{{ route('viewProduct', $product->product_id) }}" class="dark-grey-text">{{$product->product->product_name}}
                        <!-- <span class="badge badge-pill danger-color">NEW</span> -->
                        </a>
                    </strong>
                    </h5>

                    <h4 class="font-weight-bold blue-text">
                    @if($product->product->sale_percentage == NULL)
                      <strong>P {{ $product->product->price }}</strong>
                    @else
                        <del class="grey-text">P {{ $product->product->price }}</del>
                    <strong>P {{ $product->product->price-($product->product->price / $product->product->sale_percentage) }}</strong>
                    @endif
                    </h4>

                </div>
                <!--Card content-->

                </div>
                <!--Card-->

                </div>
        @endforeach
    </div>
  </div>

<br><br><br>
<br><br><br>
<br><br><br>
<br><br><br>
<br><br><br>
</main>

@endsection
