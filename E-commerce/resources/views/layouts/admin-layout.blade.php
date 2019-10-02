<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gift Ideas</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <meta name="_token" content="" /> -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{ asset('theme/vendor/bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- Google fonts - Popppins for copy-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,800">
    <!-- orion icons-->
    <link rel="stylesheet" href="{{asset('theme/css/orionicons.css')}}">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{asset('theme/css/style.pink.css')}}" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{asset('theme/css/custom.css')}}">
    <!-- Favicon-->
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

    <link rel="shortcut icon" href="img/favicon.png?3">
    <script src="{{asset('theme/vendor/jquery/jquery.min.js')}}"></script>

    <link href="{{asset('css/custom.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/flick/jquery-ui.css">
    <link href="{{asset('tag-it/css/jquery.tagit.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('tag-it/css/tagit.ui-zendesk.css')}}" rel="stylesheet" type="text/css">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
        
        <link href="{{asset('dropzone/dropzone.css')}}" rel="stylesheet" type="text/css">
        <script src="{{asset('dropzone/dropzone.js')}}"></script>
        <script src="https://cdn.tiny.cloud/1/cuzg50qvdojz7iyxthzvb5voeafwdf9m7vtm655lzzakoh9e/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
          tinymce.init({
            selector: '#terms'
          });
          </script>
  </head>
  <body>
    <!-- navbar-->
    <header class="header">
      <nav class="navbar navbar-expand-lg px-4 py-2 bg-white shadow"><a href="#" class="sidebar-toggler text-gray-500 mr-4 mr-lg-5 lead"><i class="fas fa-align-left"></i></a>
      <a href="#" class="navbar-brand font-weight-bold text-uppercase text-base"><img src="{{ asset('upload/images/gift-logo.png') }}" height="90" alt="mdb logo"></a>
        <ul class="ml-auto d-flex align-items-center list-unstyled mb-0">
          <li class="nav-item">
            <form id="searchForm" class="ml-auto d-none d-lg-block">
              <div class="form-group position-relative mb-0">
                <button type="submit" style="top: -3px; left: 0;" class="position-absolute bg-white border-0 p-0"><i class="o-search-magnify-1 text-gray text-lg"></i></button>
                <input type="search" placeholder="Search ..." class="form-control form-control-sm border-0 no-shadow pl-4">
              </div>
            </form>
          </li>
          <li class="nav-item dropdown ml-auto"><a id="userInfo" href="http://example.com" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
            @if(Auth::user()->user_photo)
              <img src="{{asset('storage/user_photo_storage')}}/{{ Auth::user()->user_photo }}" alt="Jason Doe" style="max-width: 2.5rem;" class="img-fluid rounded-circle shadow"></a>
            @else
              <img src="{{asset('theme/img/avatar-6.jpg')}}" alt="Jason Doe" style="max-width: 2.5rem;" class="img-fluid rounded-circle shadow"></a>
            @endif
            <div aria-labelledby="userInfo" class="dropdown-menu"><a href="#" class="dropdown-item"><strong class="d-block text-uppercase headings-font-family">{{ Auth::user()->name }}</strong><small>{{ Auth::user()->email }}</small></a>
              <div class="dropdown-divider"></div><a href="{{ route('admin.account') }}" class="dropdown-item">Settings</a>
              <div class="dropdown-divider"></div>
                <form action="{{ route('logout') }}" method="POST" id="logout">
                    @csrf
                    <a href="javascript:{}" onclick="document.getElementById('logout').submit();" class="dropdown-item">Logout</a>
                </form>
                
            </div>
          </li>
        </ul>
      </nav>
    </header>
    <div class="d-flex align-items-stretch">
      <div id="sidebar" class="sidebar py-3">
        <div class="text-gray-400 text-uppercase px-3 px-lg-4 py-4 font-weight-bold small headings-font-family">MAIN</div>
        <ul class="sidebar-menu list-unstyled">
              <li class="sidebar-list-item"><a href="{{ route('admin.index') }}" class="sidebar-link text-muted  @yield('dash')" ><i class="o-home-1 mr-3 text-gray"></i><span>Dashboard</span></a></li>
              <li class="sidebar-list-item"><a href="{{ route('admin.accounts') }}" class="sidebar-link text-muted @yield('accounts')"><i class="o-user-1 mr-3 text-gray"></i><span>Manage Accounts</span></a></li>
              <li class="sidebar-list-item"><a href="{{ route('admin.receivables') }}" class="sidebar-link text-muted @yield('receive')"><i class="o-paperwork-1 mr-3 text-gray"></i><span>Receivables</span></a></li>
              <li class="sidebar-list-item"><a href="{{ route('admin.terms') }}" class="sidebar-link text-muted @yield('tos')"><i class="o-paperwork-1 mr-3 text-gray"></i><span>Terms of Service</span></a></li>
             <!--  <li class="sidebar-list-item"><a href="forms.html" class="sidebar-link text-muted"><i class="o-survey-1 mr-3 text-gray"></i><span>Forms</span></a></li>
          <li class="sidebar-list-item"><a href="#" data-toggle="collapse" data-target="#pages" aria-expanded="false" aria-controls="pages" class="sidebar-link text-muted"><i class="o-wireframe-1 mr-3 text-gray"></i><span>Pages</span></a>
            <div id="pages" class="collapse">
              <ul class="sidebar-menu list-unstyled border-left border-primary border-thick">
                <li class="sidebar-list-item"><a href="#" class="sidebar-link text-muted pl-lg-5">Page one</a></li>
                <li class="sidebar-list-item"><a href="#" class="sidebar-link text-muted pl-lg-5">Page two</a></li>
                <li class="sidebar-list-item"><a href="#" class="sidebar-link text-muted pl-lg-5">Page three</a></li>
                <li class="sidebar-list-item"><a href="#" class="sidebar-link text-muted pl-lg-5">Page four</a></li>
              </ul>
            </div>
          </li>
              <li class="sidebar-list-item"><a href="login.html" class="sidebar-link text-muted"><i class="o-exit-1 mr-3 text-gray"></i><span>Login</span></a></li>
        </ul>
        <div class="text-gray-400 text-uppercase px-3 px-lg-4 py-4 font-weight-bold small headings-font-family">EXTRAS</div>
        <ul class="sidebar-menu list-unstyled">
              <li class="sidebar-list-item"><a href="#" class="sidebar-link text-muted"><i class="o-database-1 mr-3 text-gray"></i><span>Demo</span></a></li>
              <li class="sidebar-list-item"><a href="#" class="sidebar-link text-muted"><i class="o-imac-screen-1 mr-3 text-gray"></i><span>Demo</span></a></li>
              <li class="sidebar-list-item"><a href="#" class="sidebar-link text-muted"><i class="o-paperwork-1 mr-3 text-gray"></i><span>Demo</span></a></li>
              <li class="sidebar-list-item"><a href="#" class="sidebar-link text-muted"><i class="o-wireframe-1 mr-3 text-gray"></i><span>Demo</span></a></li>
        </ul> -->
      </div>

      @yield('store-main')
    </div>
    <!-- JavaScript files-->
  
    <script src="{{asset('theme/vendor/popper.js/umd/popper.min.js')}}"> </script>
    <script src="{{asset('theme/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('theme/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
    <script src="{{asset('theme/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
    <script src="{{asset('theme/js/charts-home.js')}}"></script>
    <script src="{{asset('theme/js/front.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
    
    @yield('inside-scripts')
    <!-- Tag-it js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="{{asset('tag-it/js/tag-it.js')}}" type="text/javascript" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <!-- <script src="https://cdn.tiny.cloud/1/cuzg50qvdojz7iyxthzvb5voeafwdf9m7vtm655lzzakoh9e/tinymce/5/tinymce.min.js"></script> -->


      
   
    @yield('scripts')
  </body>
</html>