@extends('layouts.admin-layout')
@section('tos')
active
@endsection
@section('store-main')
<div class="page-holder w-100 d-flex flex-wrap">
        <div class="container-fluid px-xl-5">
          <section class="pt-4 pb-2">
                <div class="tab-name pt-0 pb-0 mb-0">
                  <p class="mb-0 pb-0"><h2 class="text-uppercase">Terms of Service</h2></p>
                  <p class="m-0 p-0"><a href="#">Dashboard</a> > <a href="#">Terms of Service</a> </p>
              
                </div>
          </section>
          <section>
              <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.updateTerms') }}" method="POST">
                                @csrf
                                <textarea name="terms" id="terms" rows="30" >{!! $terms->description !!}</textarea>
                                <button class="btn btn-primary btn-block">Save</button>
                            </form>
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