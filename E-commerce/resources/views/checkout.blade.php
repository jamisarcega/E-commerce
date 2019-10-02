@extends('layouts.user-layout')
@section('content')
  <main class="mt-5 pt-4">
    <div class="container wow fadeIn">

      <!-- Heading -->
      <h2 class="my-5 h2 text-center">Your Cart</h2>

      <!--Grid row-->
      <div class="row">

        <!--Grid column-->
        <div class="col-md-12 mb-4">

          <!-- Heading -->
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Cart Information</span>
            <span class="badge badge-secondary badge-pill">{{ count($orders) }}</span>
          </h4>

          <!-- Cart -->
          <ul class="list-group mb-3 z-depth-1">
            @foreach($orders as $order)
            <a href="{{ route('viewProduct', $order->product_id) }}">
              <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                
                  <h6 class="my-0">{{$order->product->product_name}} <sub>x{{$order->quantity}}</sub></h6>
                </div>
                @if($order->product->sale_percentage)
                <span class="text-muted">P {{ ($order->product->price - (($order->product->sale_percentage/100)*$order->product->price))*$order->quantity }}</span>
                @else
                <span class="text-muted">P {{ $order->quantity*$order->product->price }}</span>
                @endif
                
              </li>
            </a>
            @endforeach
           
            <li class="list-group-item d-flex justify-content-between">
              <span>Total (Php)</span>
              <strong>P {{ $price }}</strong>
            </li>
          </ul>
          <!-- Cart -->

          <!-- Promo code -->
          <!-- <form class="card p-2">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Promo code" aria-label="Recipient's username" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-secondary btn-md waves-effect m-0" type="button">Redeem</button>
              </div>
            </div>
          </form> -->
          <!-- Promo code -->

        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->
      <a class="btn btn-primary btn-secondary" href="{{ route('user.charge') }}">Proceed to Checkout</a>
    </div>
  </main>
  @endsection

