
@extends('layouts.user-layout')
@section('content')
<main class="mt-5 pt-4">
<div class="container wow fadeIn pt-5">
<h2 class="my-5 h2 text-center">Transaction History</h2>
 <div class="card">
    <div class="card-body">
    <!-- <table id="table_id" class="table table-striped" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Date</th>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->updated_at }}</td>
                    <td>{{ $order->product->product_name }}</td>
                    <td>{{ $order->quantity }}</td>
                    @if($order->product->sale_percentage != NULL)
                        <td>P{{ ($order->product->price -(($order->product->sale_percentage / 100) *$order->product->price))*$order->quantity }}</td>
                    @else
                        <td>P{{ $order->product->price * $order->quantity }}</td>
                    @endif
                    <td>
                        <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#history{{ $order->id }}">View  &nbsp<i class="fas fa-caret-right"></i></button>
                      
                    </td>
                </tr>
                
            @endforeach
        </tbody>
    </table> -->
        @foreach($orders as $order)
                <p style="display:none;">{{ $image = App\Image::where('product_id' ,$order->product_id )->first() }}</p>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-1">
                                <img src="{{ asset('uploads/images/'.$image->name) }}" class="img-fluid" alt="Responsive image">
                            </div>
                            <div class="col-md-11">
                                <div class="d-flex justify-content-between">
                                    <p>{{ $order->product->product_name }}</p>
                                    <p>Last updated at: <i>{{ $order->updated_at }}</i></p>
                                </div>
                                <a href="" data-toggle="modal" data-target="#history{{ $order->id }}">Status</a>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                
        @endforeach
    </div>
 </div>
</div>

@foreach($orders as $order)
<div class="modal fade right" id="history{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-full-height modal-right" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #AA67CC; color:white;">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-truck"></i> Track Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <h2 class="h1-responsive font-weight-bold text-center my-5">{{ $order->product->product_name }}</h2>
            <p style="display:none;">{{ $status = App\Status::where('order_id', $order->id)->first() }}</p>
        @if($order->status == 0)
            <blockquote class="blockquote">
                <p class="mb-0 h1"><i class="fas fa-money-bill text-default"></i> Order Received By the Seller &nbsp&nbsp<span class="badge badge-pill badge-secondary"><sub>{{ $order->updated_at }}</sub></span></p> 
                <footer class="blockquote-footer">Waiting for the seller to ship your product.</footer>
            </blockquote>
        @elseif($order->status == 1)
            <blockquote class="blockquote">
                <p class="mb-0 h1"><i class="fas fa-archive text-warning"></i> Parcel is on the way!&nbsp&nbsp <span class="badge badge-pill badge-secondary"><sub>{{ $order->updated_at }}</sub></span></p>
                <footer class="blockquote-footer">Please wait for the arrival of your product.</footer>
            </blockquote>
            <br>
            <blockquote class="blockquote">
                <p class="mb-0"><i class="fas fa-money-bill text-default"></i> Order Received By the Seller</p>
                <footer class="blockquote-footer">Waiting for the seller to ship your product.</footer>
            </blockquote>
        @endif    

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
@endforeach
<br><br><br>
</main>

@endsection
@section('scripts')
<script>
$(document).ready( function () {
    $('#table_id').DataTable();

    @if(session('success'))
        
        Swal.fire("{{ session('success') }}","","success");

  @endif   
} );
</script>

@endsection