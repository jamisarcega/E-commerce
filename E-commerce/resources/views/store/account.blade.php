@extends('layouts.store-layout')
@section('store-main')

      <div class="page-holder w-100 d-flex flex-wrap">
        <div class="container-fluid px-xl-5">
          <section class="pt-4 pb-2">
                <div class="tab-name pt-0 pb-0 mb-0">
                  <p class="mb-0 pb-0"><h2 class="text-uppercase">Account Settings</h2></p>
                  <p class="m-0 p-0"><a href="#">Dashboard</a> > <a href="#">Account Settings</a> </p>
        
                </div>
          </section>
          <section>
              <div class="row">
                <div class="col-md-12">
                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>	
                                <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>	
                                <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                            <div class="col-md-2">
                            @if($account->user_photo != NULL)
                                 <img src="{{asset('storage/user_photo_storage')}}/{{ $account->user_photo }}" data-target="#photoModal" data-toggle="modal" alt="Jason Doe" style="max-width: 7em; cursor: pointer;" class="img-fluid rounded-circle shadow">
                            @else
                                 <img src="{{asset('theme/img/avatar-6.jpg')}}" data-target="#photoModal" data-toggle="modal" alt="Jason Doe" style="max-width: 7em; cursor: pointer;" class="img-fluid rounded-circle shadow">
                            @endif
                            </div>
                            <div class="col-md-7 mt-4">
                                <h4>{{ $account->name }}</h4>
                                <p class="m-0 p-0"><sub>{{ $account->email }}</sub></p><br>
                                <div class="row">
                                    <div class="col">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#accountModal">Edit Password</button>
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#nameModal">Edit Store Name</button>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 mt-4">
                                <p class="m-0 p-0">Last Update: {{ $account->updated_at }}</p>
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

    
    <div class="modal fade" id="nameModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
    
          <div class="modal-body">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
                        

          <p class="h4 mb-4">Update Store Name</p>
          <hr>
            <form action="{{ route('store.updateName', Auth::user()->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <label for="name">Store Name</label>
                <input type="text" name="name" id="name" minlength="3" class="form-control" required>
                <br>
                <br>
                <button class="btn btn-primary btn-block">Save</button>
            
            
            </form>
          
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="accountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
    
          <div class="modal-body">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
                        

          <p class="h4 mb-4">Update Password</p>
          <hr>
            <form action="{{ route('store.updatePassword', Auth::user()->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <label for="old">Enter Old Password</label>
                <input type="password" name="old" id="old" class="form-control">
                <label for="new">Enter New Password</label>
                <input type="password" name="new" id="new" class="form-control">
                <label for="retype">Retype New Password</label>
                <input type="password" name="retype" id="retype" class="form-control">
                <br>
                <br>
                <button class="btn btn-primary btn-block">Save</button>
            
            
            </form>
          
          </div>
        </div>
      </div>
    </div>



    <div class="modal fade" id="photoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
    
          <div class="modal-body">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
                        

          <p class="h4 mb-4">Update Password</p>
          <hr>
            <form action="{{ route('store.updatePhoto', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="photo">Select Photo</label><br>
                <input type="file" name="user_photo">
                <br>
                <br>
                <button class="btn btn-primary btn-block">Save</button>
            
            
            </form>
          
          </div>
        </div>
      </div>
    </div>
@endsection
@section('scripts')
<script>
$(document).ready( function () {
    $('#ordersTable').DataTable();
} );
</script>
@endsection

