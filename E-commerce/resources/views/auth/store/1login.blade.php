<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>GiftCart</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <link rel="stylesheet" href="{{ asset('theme/vendor/bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- Google fonts - Popppins for copy-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,800">
    <!-- orion icons-->
    <link rel="stylesheet" href="{{asset('theme/css/orionicons.css')}}">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{asset('theme/css/style.default.css')}}" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{asset('theme/css/custom.css')}}">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{asset('theme/img/favicon.png?3')}}">
  </head>
  <body>
    <div class="page-holder d-flex align-items-center">
      <div class="container">
        <div class="row align-items-center py-5">
          <div class="col-5 col-lg-7 mx-auto mb-5 mb-lg-0">
            <div class="pr-lg-5"><img src="{{asset('theme/img/illustration.svg')}}" alt="" class="img-fluid"></div>
          </div>
          <div class="col-lg-5 px-lg-4">
            <h1 class="text-base text-primary text-uppercase mb-4">GiftIdeas Dashboard</h1>
            <h2 class="mb-4">Welcome back!</h2>
            <p class="text-muted">Sell something interesting today!</p>
            @if(old('email') != NULL)
                <p class="text text-danger">Oops! Something went wrong. Make sure your email and password is correct.</p>
            @endif
            <form id="loginForm" method="POST" action="{{ route('store.loginSubmit') }}" class="mt-4">
            @csrf
              <div class="form-group mb-4">
                @if(old('email') != NULL)
                <input type="email" name="email" placeholder="Email address" style="box-shadow: #CC0000;" value="{{ old('email') }}" class="form-control border-0 shadow form-control-lg">
                @else
                <input type="email" name="email" placeholder="Email address" value="{{ old('email') }}" class="form-control border-0 shadow form-control-lg">
                @endif
              </div>
              <div class="form-group mb-4">
                <input type="password" name="password" placeholder="Password" class="form-control border-0 shadow form-control-lg text-violet">
              </div>
              <div class="form-group mb-4">
              <a href="" data-toggle="modal" data-target="#register">No account yet? Signup here</a>
              </div>
              <button type="submit" class="btn btn-primary shadow px-5">Log in</button>
            </form>
          </div>
        </div>
        <!-- <p class="mt-5 mb-0 text-gray-400 text-center">Design by <a href="https://bootstrapious.com/admin-templates" class="external text-gray-400">Bootstrapious</a> & Your company</p> -->
        <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)                 -->
      </div>
    </div>
    <!-- JavaScript files-->


    <div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
    
          <div class="modal-body">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
                        

          <p class="h4 mb-4">Sign up</p>

          <form action="{{ route('store.newUser') }}" method="POST" id="signup">

          @csrf

          <div class="form-row mb-4">
              <div class="col-md-12">
                  <!-- First name -->
                  <label for="name"><i class="fas fa-user"></i> Store Name</label>
                  <input type="text" id="defaultRegisterFormFirstName" class="form-control" pattern="[A-Za-z]" title="Only letters are available." placeholder="Store Name" id="name" name="name" required>
              </div>
            
          </div>

          <!-- E-mail -->
          <label for="email"><i class="fas fa-envelope"></i> Email Address</label>
          <input type="email" id="defaultRegisterFormEmail" class="form-control mb-4" placeholder="E-mail" id="email" name="email" required>

          <!-- Password -->
          <label for="password"><i class="fas fa-lock"></i> Password</label>
          <input type="password" id="defaultRegisterFormPassword" class="form-control" placeholder="Password" name="password" aria-describedby="defaultRegisterFormPasswordHelpBlock" required>
          <br>
          <label for="retype"><i class="fas fa-lock"></i> Re-type Password</label>
          <input type="password" id="defaultRegisterFormPassword" class="form-control" placeholder="Retype Password" id="retype" name="retype" aria-describedby="defaultRegisterFormPasswordHelpBlock" required>
          <label for="">Are you human?</label><br>
         <div class="col-md-3">
            <div class="card bg-dark text-white text-center">
              <div class="card-body">
                <span class="mx-auto p-0">{{ $temp = mt_rand(100000, 999999) }}</span>
              </div>
            </div>
          </div><br>
          <input type="text" name="captchaInput" placeholder="Enter text above" class="form-control" required>

          <input type="hidden" value="{{$temp}}" name="captcha">



          </form>
            <button class="btn btn-primary my-4 btn-block" data-toggle="modal" data-target="#terms">Proceed</button>
            <sub>Pressing <i>Proceed</i>, will show you the terms and condition of this site.</sub>
          </div>
        </div>
      </div>
    </div>











    <div class="modal fade" id="terms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
    
          <div class="modal-body">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
                        

          <p class="h4 mb-4">Terms and Condition</p>
            <p style="display: none;">{{ $terms = App\Term::find(1) }}</p>
            <p>{!! $terms->description !!}</p>

            <p class="gray-text"><sub>By clicking <i>proceed</i>, you agree with what is stated above.</sub></p>
            <button class="btn btn-primary my-4 btn-block" id="tosButton">Proceed</button>
            <!-- <button class="btn btn-primary my-4 btn-block" type="submit" form="signup" id="tosButton">Proceed</button> -->
          </div>
        </div>
      </div>
    </div>
    <script src="{{asset('theme/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('theme/vendor/popper.js/umd/popper.min.js')}}"> </script>
    <script src="{{asset('theme/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('theme/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
    <script src="{{asset('theme/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
    <script src="{{asset('theme/js/charts-home.js')}}"></script>
    <script src="{{asset('theme/js/front.js')}}"></script>
    <script>
       $( document ).ready(function() {
          $('#tosButton').click(function(){
             $('#terms').modal('toggle');
             $('#signup').submit();
          });
       });
    </script>
  </body>
</html>