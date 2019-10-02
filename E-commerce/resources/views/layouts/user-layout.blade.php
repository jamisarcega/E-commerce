<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Gift Ideas</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="{{asset('mdb/css/bootstrap.min.css')}}" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="{{asset('pro/css/mdb.min.css')}}" rel="stylesheet">
  <link href="{{asset('mdb/css/mdb.min.css')}}" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="{{asset('pro/css/style.min.css')}}" rel="stylesheet">
  <link href="{{asset('mdb/css/style.min.css')}}" rel="stylesheet">
  <link href="{{asset('mdb/css/stripe.css')}}" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
  
  <style type="text/css">
    html,
    body,
    header,
    .carousel {
      height: 60vh;
    }
    .important-hide{
      display: none !important;
    }
   
    @media (max-width: 740px) {

      html,
      body,
      header,
      .carousel {
        height: 100vh;
      }
    }

    @media (min-width: 800px) and (max-width: 850px) {

      html,
      body,
      header,
      .carousel {
        height: 100vh;
      }
    }

  </style>
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
    <div class="container">
      <!-- Brand -->
      <a class="navbar-brand waves-effect mt-n5" href="/" target="_blank">
        <!-- <strong class="blue-text">GiftIdeas</strong> -->
        <a class="navbar-brand" href="#">
          <img src="{{ asset('upload/images/gift-logo.png') }}" height="90" alt="mdb logo">
        </a>
      </a>

      <!-- Collapse -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Links -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <!-- Left -->
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link waves-effect" href="/">Home
              <!-- <span class="sr-only">(current)</span> -->
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link waves-effect" href="{{ route('aboutUs') }}">About
              <!-- <span class="sr-only">(current)</span> -->
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link waves-effect" href="{{ route('contactUs') }}">Contact Us
              <!-- <span class="sr-only">(current)</span> -->
            </a>
          </li>
          @if(Auth::check())
          <p style="display: none;">{{ $orders = App\Order::where('user_id', Auth::user()->id)->where('notification', 0)->get() }}</p>
          <li class="nav-item dropdown mr-5">
          <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false"><span class="badge badge-danger">{{ count($orders) }}</span> Notifications</a>
            <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                @foreach($orders as $order)
                  <a class="dropdown-item" href="{{ route('user.notificationUpdate', $order->id) }}"><span class="badge badge-pill purple"><i class="far fa-bell" aria-hidden="true"></i></span> {{$order->product->product_name}}</a>
                @endforeach
            </div>
          </li>
          @endif
        
        </ul>

        <!-- Right -->
        <ul class="navbar-nav nav-flex-icons">
          <li class="nav-item mt-1">
            <a class="nav-link waves-effect" href="{{ route('user.checkout') }}">
              @if(Auth::check())
                  <p style="display: none">{{ $orders = App\Order::where('user_id', Auth::user()->id)->where('status', 0)->get() }}</p>
                <span class="badge red z-depth-1 mr-1">{{ count($orders) }}</span>
              @endif
              <i class="fas fa-shopping-cart"></i>
             <span class="clearfix d-none d-sm-inline-block">Cart</span>
            </a>
          </li>
         
          @if(!Auth::check())
          <li class="nav-item dropdown">
            <!-- <a href="https://github.com/mdbootstrap/bootstrap-material-design" class="nav-link border border-light rounded waves-effect"
              target="_blank">
              <i class="fab fa-github mr-2"></i>MDB GitHub -->
              <!-- <button class="btn btn-primary dropdown-toggle purple-gradient" type="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">Welcome</button>

              <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ url('/login') }}">Send a Gift today!</a>
                <a class="dropdown-item" href="{{ route('store.login') }}">Become a seller</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Register</a>
              </div> -->
              
          <a class="nav-link mt-1" href="{{ route('login') }}">
            Login
          </a>
         
      
          </li>
          @else
            <li class="nav-item">
              <!-- <a href="https://github.com/mdbootstrap/bootstrap-material-design" class="nav-link border border-light rounded waves-effect"
                target="_blank">
                <i class="fab fa-github mr-2"></i>MDB GitHub -->
        

                @if(Auth::user()->user_photo != NULL)
                  <img src="{{ asset('storage/user_photo_storage')}}/{{ Auth::user()->user_photo }}" style="width: 3rem; cursor: pointer;" class="rounded-circle img-fluid mt-1" data-toggle="modal" data-target="#menuRight">
                @else
                  <img src="{{asset('theme/img/avatar-6.jpg')}}" alt="avatar mx-auto white" style="width: 3rem; cursor: pointer;" class="rounded-circle img-fluid mt-1" data-toggle="modal" data-target="#menuRight">
                @endif
                <div class="dropdown-menu">
                  <!-- <a class="dropdown-item" href="{{ route('user.history') }}">Purchase History</a>
                  <a class="dropdown-item" href="">Account Settings</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                </div> -->
            
            </li>
          @endif
        </ul>

      </div>

    </div>
  </nav>
  <!-- Navbar -->

 

  <!--Main layout-->
  <main class="mb-5" id="main">
    @yield('content')
  </main>
  <!--Main layout-->

  <!--Footer-->
  <!-- Footer -->
<footer class="page-footer font-small unique-color-dark mt-5">

<div style="background-color: #6351ce;">
  <div class="container">

    <!-- Grid row-->
    <div class="row py-4 d-flex align-items-center">

      <!-- Grid column -->
      <div class="col-md-6 col-lg-5 text-center text-md-left mb-4 mb-md-0">
        <h6 class="mb-0">Get connected with us on social networks!</h6>
      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-6 col-lg-7 text-center text-md-right">

        <!-- Facebook -->
        <a class="fb-ic">
          <i class="fab fa-facebook-f white-text mr-4"> </i>
        </a>
        <!-- Twitter -->
        <a class="tw-ic">
          <i class="fab fa-twitter white-text mr-4"> </i>
        </a>
        <!-- Google +-->
        <a class="gplus-ic">
          <i class="fab fa-google-plus-g white-text mr-4"> </i>
        </a>
        <!--Linkedin -->
        <a class="li-ic">
          <i class="fab fa-linkedin-in white-text mr-4"> </i>
        </a>
        <!--Instagram-->
        <a class="ins-ic">
          <i class="fab fa-instagram white-text"> </i>
        </a>

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row-->

  </div>
</div>

<!-- Footer Links -->
<div class="container text-center text-md-left mt-5">

  <!-- Grid row -->
  <div class="row mt-3">

    <!-- Grid column -->
    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">

      <!-- Content -->
      <h6 class="text-uppercase font-weight-bold">Gift Ideas</h6>
      <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
      <p>What can we do for you today?</p>

    </div>
    <!-- Grid column -->

    <!-- Grid column -->
    <!-- <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">

      <h6 class="text-uppercase font-weight-bold">Products</h6>
      <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
      <p>
        <a href="#!">MDBootstrap</a>
      </p>
      <p>
        <a href="#!">MDWordPress</a>
      </p>
      <p>
        <a href="#!">BrandFlow</a>
      </p>
      <p>
        <a href="#!">Bootstrap Angular</a>
      </p>

    </div> -->
    <!-- Grid column -->

    <!-- Grid column -->
    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">

      <!-- Links -->
      <h6 class="text-uppercase font-weight-bold">Links</h6>
      <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
      <p>
        <a href="/">Home</a>
      </p>
      <p>
        <a href="{{ route('aboutUs') }}">About Us</a>
      </p>
    

    </div>
    <!-- Grid column -->

    <!-- Grid column -->
    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">

      <!-- Links -->
      <h6 class="text-uppercase font-weight-bold">Contact</h6>
      <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
      <p>
        <i class="fas fa-home mr-3"></i> Service Centers, Angeles City</p>
      <p>
        <i class="fas fa-envelope mr-3"></i> Janielmanalang1624@gmail.com </p>
      <p>
        <i class="fas fa-phone mr-3"></i> +63 926 354 5799</p>

    </div>
    <!-- Grid column -->

  </div>
  <!-- Grid row -->

</div>
<!-- Footer Links -->

<!-- Copyright -->
<div class="footer-copyright text-center py-3">© 2019 Copyright:
  <a href="https://mdbootstrap.com/education/bootstrap/"> GiftIdeas.com</a>
</div>
<!-- Copyright -->

</footer>
<!-- Footer -->
  <!--/.Footer-->


  <!-- modal -->
  <div class="modal fade " id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #AA67CC; color:white;">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-truck"></i> Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     
      </div>
    </div>
  </div>
</div>





<div class="modal fade right" id="" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
     
      </div>
    </div>
  </div>
</div>


<!-- modals -->

<div class="modal fade right" id="menuRight" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">

  <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
  <div class="modal-dialog modal-full-height modal-right modal-sm" role="document">


    <div class="modal-content text-white" style="background-color: #aa66cc;">
      <div class="modal-body d-flex justify-content-center">
        <nav class="nav flex-column py-4 font-weight-bold">
          <a class="nav-link text-white white-darker-hover" href="{{ route('user.history') }}"><i class="fas fa-truck"></i> Transaction History</a>
          <a class="nav-link text-white white-darker-hover" href="{{ route('user.getWishlist') }}"><i class="fas fa-heart"></i> My Wishlist</a>
          <a class="nav-link text-white white-darker-hover" href="{{ route('user.account') }}"><i class="fas fa-cog"></i> Account Settings</a>
          <a class="nav-link text-white white-darker-hover" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                       <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
        </nav>

      </div>
    </div>
  </div>
</div>
<!-- Full Height Modal Right -->
  <!-- SCRIPTS -->
  <script src="{{asset('js/app.js')}}"></script>
  <script>
    Echo.channel('home')
        .listen('NewMessage', (e) =>{
            console.log(e.message);
        })
  </script>
  <!-- JQuery -->
  <script type="text/javascript" src="{{asset('mdb/js/jquery-3.4.1.min.js')}}"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="{{asset('mdb/js/popper.min.js')}}"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="{{asset('mdb/js/bootstrap.min.js')}}"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="{{asset('mdb/js/mdb.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('pro/js/addons/rating.js')}}"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

  <!-- Initializations -->
  <script type="text/javascript">
    // Animations initialization
    new WOW().init();

  </script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
    <script>
    @if(session('login-success'))
      const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000
        });

        Toast.fire({
          type: 'success',
          title: 'Logged in successfully!'
        })
    @endif    
    </script>
  @yield('scripts')




  
</body>

</html>
