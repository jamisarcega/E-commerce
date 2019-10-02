@extends('layouts.store-layout')
@section('orders')
active
@endsection
@section('store-main')

      <div class="page-holder w-100 d-flex flex-wrap">
        <div class="container-fluid px-xl-5">
          <section class="pt-4 pb-2">
                <div class="tab-name pt-0 pb-0 mb-0">
                  <p class="mb-0 pb-0"><h2 class="text-uppercase">Orders</h2></p>
                  <p class="m-0 p-0"><a href="#">Dashboard</a> > <a href="#">Orders</a> </p>
              
                </div>
          </section>
          <section>
          <div class="col-md-12">
          @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
          </div>
                <div class="card">
                    <div class="card-body">
                        <table id="ordersTable">
                            <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Ordered Product</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                        <th>Tracking Number</th>
                                        <th>Action</th>
                                    </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                  @if($order->product->store_id == Auth::user()->id)
                                  
                                  <tr>
                                        <td>{{ $order->user->name }} {{ $order->user->last_name }}</td>
                                        <td>{{ $order->product->product_name }}</td>
                                        <td>{{ $order->quantity }} <sub>pc/s</sub></td>
                                        <td>
                                            @if($order->status == 0)
                                                <span class="text-danger">Unfulfilled</span>
                                            @else
                                                <span class="text-success">Fulfilled</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($order->tracking == NULL)
                                                <span class="text-danger">No Tracking Number Yet</span>
                                            @else
                                                <span class="text-success">{{ $order->tracking }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit{{$order->id}}">Fulfill Order</a>
                                                    @if($order->tracking == NULL)
                                                        <a class="dropdown-item" href="#">Cancel Order</a>
                                                    @else
                                                        <sub class="dropdown-item">You can't cancel this order anymore</sub>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                  @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
          </section>
        </div>
      </div>
    </div>
    @foreach($orders as $order)
    <div class="modal fade" id="edit{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Set Tracking Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form action="{{ route('store.tracking', $order->id) }}" method="POST">
                @csrf
                <input type="text" class="form-control" name="tracking"  placeholder="Input tracking number here">
                <br>
                <button class="btn btn-primary btn-block">Save</button>
            </form>
            <br>
            <hr>
            <h6>Shipping Information</h6>
            <p class="mb-0">{{ $order->first_name }} {{ $order->last_name }}</p>
            <p class="mb-0">{{ $order->line_1 }}</p>
            <p class="mb-0">{{ $order->line_2 }}</p>
            <p class="mb-0">{{ $order->city }}</p>
            <p class="mb-0">{{ $order->province }}</p>
            <p class="mb-0">{{ $order->zip }}</p>

      </div>
    </div>
  </div>
</div>

    @endforeach





@endsection
@section('scripts')
<script>
$(document).ready( function () {
    $('#ordersTable').DataTable();

 
});
</script>
<script>

</script>
@endsection

