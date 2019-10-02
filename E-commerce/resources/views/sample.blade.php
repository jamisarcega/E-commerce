
@extends('layouts.user-layout')
@section('content')
<main class="mt-5 pt-4">
<div class="container wow fadeIn">
<h2 class="my-5 h2 text-center">Shipping and Billing</h2>
<link href="{{asset('mdb/css/stripe.css')}}" rel="stylesheet">

<script src="https://js.stripe.com/v3/"></script>

<form action="{{ route('user.billing') }}" method="POST" id="payment-form">
@csrf
<div class="card grey lighten-5 card-body">
<div class="row">

<!--Grid column-->
<div class="col-md-12 mb-2">
<small class="text-muted">Fill this form. All fields are required except address 2.</small>

</div>
<form action="{{ route('user.billing') }}" method="POST" id="form">
@csrf
<div class="col-md-6 mb-2">
  <!--firstName-->
  <div class="md-form ">
    <input type="text" id="firstName"  name="firstName" class="form-control" required>
    <label for="firstName" class="">First name</label>
  </div>

</div>
<!--Grid column-->

<!--Grid column-->
<div class="col-md-6 mb-2">

  <!--lastName-->
  <div class="md-form">
    <input type="text" id="lastName" name="lastName"class="form-control" required>
    <label for="lastName" class="">Last name</label>
  </div>

</div>
<!--Grid column-->

</div>
    <div class="md-form mb-2">
        <input type="text" id="address" name="line_1" class="form-control" placeholder="1234 Main St" required>
        <label for="address" class="">Address</label>
    </div>
    <div class="md-form mb-2">
        <input type="text" id="address-2" name="line_2" class="form-control" placeholder="Apartment or suite">
        <label for="address-2" class="">Address 2 (optional)</label>
    </div>
            <!--Grid row-->
            <div class="row">

<!--Grid column-->
<div class="col-lg-4 col-md-12 mb-4">

  <label for="country">Province</label>
  <select class="custom-select d-block w-100" name="province" id="province" required>
    <option value="">Choose...</option>
     @foreach($provinces as $province)
     <option value="{{ $province }}">{{ $province }}</option>
     
     @endforeach
  </select>
  <div class="invalid-feedback">
    Please select a valid province.
  </div>

</div>
<!--Grid column-->

<!--Grid column-->
<div class="col-lg-4 col-md-6 mb-4">

  <label for="state">City</label>
  <input type="text" class="form-control" id="city" name="city" placeholder="" required>
  <div class="invalid-feedback">
    Please provide a valid state.
  </div>

</div>
<!--Grid column-->

<!--Grid column-->
<div class="col-lg-4 col-md-6 mb-4">

  <label for="zip">Zip</label>
  <input type="text" class="form-control" id="zip" name="zip" placeholder="" required>
  <div class="invalid-feedback">
    Zip code required.
  </div>

</div>
<!--Grid column-->

</div>
<!--Grid row-->

<hr>
  
  <!-- <div class="form-row" style="display:none;">
    <label for="card-element">
      Credit or debit card
    </label>
    <div id="card-element"> -->
      <!-- A Stripe Element will be inserted here. -->
    <!-- </div> -->

    <!-- Used to display form errors. -->
    <!-- <div id="card-errors" role="alert"></div> -->
  </div>
<br>
@if($price != 0)
  <button class="btn btn-secondary">Finish Order ( PHP {{$price}} )</button>
@else
<button class="btn btn-secondary disabled">You don't have any orders.</button>

@endif  
  </div>
  
</form>


<!-- <script>

var stripe = Stripe('pk_test_PZ3OutMktqNGSmTcpiccOr0i00yj62A64O');


var elements = stripe.elements();


var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};


var card = elements.create('card', {style: style});


card.mount('#card-element');


card.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});


var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      
      stripeTokenHandler(result.token);
    }
  });
});

function stripeTokenHandler(token) {
  
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  
  form.submit();
}
</script> -->
</div>
</main>
@endsection