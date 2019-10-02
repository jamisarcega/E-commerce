@extends('layouts.admin-layout')
@section('receive')
active
@endsection
@section('store-main')
<div class="page-holder w-100 d-flex flex-wrap">
        <div class="container-fluid px-xl-5">
          <section class="pt-4 pb-2">
                <div class="tab-name pt-0 pb-0 mb-0">
                  <p class="mb-0 pb-0"><h2 class="text-uppercase">Receivables</h2></p>
                  <p class="m-0 p-0"><a href="#">Dashboard</a> > <a href="#">Receivables</a> </p>
              
                </div>
          </section>
          <section>
                <div class="row">
                    <div class="col-md-12">
                      @foreach($stores as $store)
                      <div class="card">
                        <div class="card-body">
                            <h5>{{ $store->name }}</h5>
                            <p style="display: none;">{{ $count = 0 }}</p>
                            @foreach($orders as $order)
                                @if($order->product->store->id == $store->id)
                                    <p style="display: none;">{{ $count++ }}</p>
                                @endif
                            @endforeach
                            <p class="p-0 m-0 text-success">Active Orders: {{ $count }}</p>
                            <a href="#" data-toggle="modal" data-target="#view{{ $store->id }}">View Details</a>
                        </div>
                      </div>
                      <br>

                      <!-- modal -->
                        <div class="modal fade" id="view{{ $store->id }}" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{ $store->name }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p><sub>Receivables from this store (Service Fee: 5%): </sub></p>
                                    <p style="display: none;">{{ $count = 0 }}</p>

                                            <table class="table">
                                               <thead>
                                                    <tr>
                                                        <th>OrderID</th>
                                                        <th>Product Name</th>
                                                        <th>Receivable Amount</th>
                                                    </tr>
                                               </thead>
                                               <tbody>
                                                    @foreach($orders as $order)
                                                    <tr>
                                                        @if($order->product->store->id == $store->id)
                                                            <td>{{$order->id}}</td>
                                                            <td>{{$order->product->product_name}}</td>
                                                            <td>Php {{$order->product->price*.05}}</td>
                                                        @endif
                                                    </tr>    
                                                     <p style="display: none;">{{ $count += ($order->product->price*.05) }}</p>
                                                    @endforeach
                                                  
                                               </tbody>

                                            </table>
                                            <br>
                                            <p>Total Due: Php {{ $count }}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                                </div>
                            </div>
                        </div>
                      @endforeach
                    </div>
                </div>
          </section>
        </div>
      </div>
@endsection
@section('scripts')
<script>
$(document).ready( function () {
    $('#usersTable').DataTable();
    $('#storesTable').DataTable();
} );
</script>
@endsection