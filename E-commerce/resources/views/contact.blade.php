@extends('layouts.user-layout')
@section('content')
<div class="container mt-5 mb-5">
    <div class="row mt-5">
       <div class="col-md-12 mt-5">
         <p class="h1-responsive">Contact Us</p>

        <p>
        <i class="fas fa-home mr-3"></i> Service Centers, Angeles City</p>
        <p>
        <i class="fas fa-envelope mr-3"></i> Janielmanalang1624@gmail.com </p>
        <p>
        <i class="fas fa-phone mr-3"></i> +63 926 354 5799</p>

       </div>
       <div class="col-md-12">
            <hr>
            <p class="h1-responsive">Write us a message</p>
            <input type="email" name="email" class="form-control" placeholder="Email Address ">
            <br>
            <textarea class="form-control " id="exampleFormControlTextarea6" name="body" rows="3" placeholder="Write your message here..."></textarea>
            <br>
            <button class="btn btn-primary btn-block">Send</button>
       </div>
    </div>
</div>
<br><br><br><br><br><br><br><br>


 @endsection



