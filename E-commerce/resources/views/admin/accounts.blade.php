@extends('layouts.admin-layout')
@section('accounts')
active
@endsection
@section('store-main')
<div class="page-holder w-100 d-flex flex-wrap">
        <div class="container-fluid px-xl-5">
          <section class="pt-4 pb-2">
                <div class="tab-name pt-0 pb-0 mb-0">
                  <p class="mb-0 pb-0"><h2 class="text-uppercase">Manage Accounts</h2></p>
                  <p class="m-0 p-0"><a href="#">Dashboard</a> > <a href="#">Manage Accounts</a> </p>
              
                </div>
          </section>
          <section>
                <div class="row">
                    <div class="col-md-6">
                      <div class="card">
                        <div class="card-body table-responsive text-nowrap">
                            <table id="usersTable">
                                <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Account Status</th>
                                            <th>Action</th>
                                        </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                      <tr>
                                        <td>{{ $user->name }} {{ $user->middle_name }} {{ $user->last_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if($user->account_status == 1)
                                              <span class="text-success">Enabled</span>
                                            @else
                                              <span class="text-danger">Disabled</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <form action="{{ route('enable.user', $user->id) }}" method="POST">
                                                      @csrf
                                                      <button class="dropdown-item">Enable</button>                                                    
                                                    </form>
                                                    <form action="{{ route('disable.user', $user->id) }}" method="POST">
                                                      @csrf
                                                      <button class="dropdown-item">Disable</button>                                                    
                                                    </form>
                                                  
                                                </div>
                                            </div>
                                        </td>
                                      </tr>
                                    @endforeach                         
                                </tbody>
                            </table>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="card">
                        <div class="card-body table-responsive text-nowrap">
                            <table id="storesTable">
                                <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Account Status</th>
                                            <th>Action</th>
                                        </tr>
                                </thead>
                                <tbody>
                                    @foreach($stores as $store)
                                      <tr>
                                        <td>{{ $store->name }}</td>
                                        <td>{{ $store->email }}</td>
                                        <td>
                                            @if($store->account_status == 1)
                                              <span class="text-success">Enabled</span>
                                            @else
                                              <span class="text-danger">Disabled</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <form action="{{ route('enable.store', $store->id) }}" method="POST">
                                                      @csrf
                                                      <button class="dropdown-item">Enable</button>                                                    
                                                    </form>
                                                    <form action="{{ route('disable.store', $store->id) }}" method="POST">
                                                      @csrf
                                                      <button class="dropdown-item">Disable</button>                                                    
                                                    </form>
                                                  
                                                </div>
                                            </div>
                                        </td>
                                      </tr>
                                    @endforeach   
                                  
                                </tbody>
                            </table>
                        </div>
                      </div>
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