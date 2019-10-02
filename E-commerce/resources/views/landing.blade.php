@extends('layouts.user-layout')
@section('content')
@include('layouts.carousel-inc')
    <div class="container">

      <!--Navbar-->
      <nav class="navbar navbar-expand-lg navbar-dark mdb-color lighten-3 mt-3 mb-5 purple-gradient">

        <!-- Navbar brand -->
        <span class="navbar-brand">Categories:</span>

        <!-- Collapse button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
          aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapsible content -->
        <div class="collapse navbar-collapse" id="basicExampleNav">

          <!-- Links -->
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">All
                <span class="sr-only">(current)</span>
              </a>

            <li class="nav-item">
                  <button class="btn btn-primary nav-link btn-sm" data-toggle="modal" data-target="#searchModal">Smart Search</button>
            </li>

          </ul>
          <!-- Links -->

          <form class="form-inline">
            <div class="md-form my-0">
              <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            </div>
          </form>
        </div>
        <!-- Collapsible content -->

      </nav>
      <!--/.Navbar-->

      <!--Section: Products v.3-->
      <section class="text-center mb-4">
 
        <!--Grid row-->
        <div class="row wow fadeIn">
        @foreach($products as $product)
          <!--Grid column-->
          
          <div class="col-lg-3 col-md-6 mb-4">

            <!--Card-->
            <div class="card" style="height: 40vh;">

              <!--Card image-->
              <div class="view overlay">
              <p style="display:none;">{{ $image = App\Image::where('product_id' ,$product->id )->first() }}</p>
                @if($image)
                  <img src="{{ asset('uploads/images/'.$image->name) }}" class="card-img-top img-responsive" alt="">
                @else
                  <img src="{{ asset('uploads/images/no_photo.png') }}" class="card-img-top img-responsive" style="min-height: 30vh" alt="">                    
                @endif
                <a href="{{ route('viewProduct', $product->id) }}">
                  <div class="mask rgba-white-slight"></div>
                </a>
              </div>
              <!--Card image-->

              <!--Card content-->
              <div class="card-body text-center" >
                <!--Category & Title-->
             
                  <h5>Shirt</h5>
               
                <h5>
                  <strong>
                    <a href="{{ route('viewProduct', $product->id) }}" class="dark-grey-text">{{$product->product_name}}
                      <!-- <span class="badge badge-pill danger-color">NEW</span> -->
                    </a>
                  </strong>
                </h5>

                <h4 class="font-weight-bold blue-text">
                  @if($product->sale_percentage == NULL)
                   <strong>P {{ $product->price }}</strong>
                  @else
                    <del class="grey-text">P {{ $product->price }}</del>
                   <strong>P {{ $product->price-($product->price / $product->sale_percentage) }}</strong>
                  @endif
                </h4>

              </div>
              <!--Card content-->

            </div>
            <!--Card-->

          </div>
       
      @endforeach
      {{ $products->links() }}
          <!--Grid column-->

         
       

        </div>
        <!--Grid row-->
      </section>
      <!--Section: Products v.3-->

  

    </div>
  

  <!-- modals -->
  <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-fluid modal-notify modal-info" role="document">
    <!--Content-->
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header">
        <p class="heading lead">Search Gift Assist</p>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">&times;</span>
        </button>
      </div>

      <!--Body-->
      <div class="modal-body">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                  <p class="text-muted">Still have no idea for a gift for something special? You're at the right spot!</p>
                </div>
                <div class="col-md-12">
                   <h4 class="mb-n3">Let's find a suitable item.</h4><br>

                   <div class="card">





                     <div class="card-body secondary-color  white-text animated " id="occasionCard">
                        <!--Title-->
                        <h4 class="card-title">For what occasion?</h4>
                        <!--Text-->
                        <input type="radio" name="occasion" class="form-check-input" id="Anniversary" value="Anniversary"> <label for="Anniversary"> Anniversary</label><br>
                        <input type="radio" name="occasion"  class="form-check-input" id="Wedding" value="Wedding"> <label for="Wedding"> Wedding</label><br>
                        <input type="radio" name="occasion" class="form-check-input" id="New Baby" value="New Baby"> <label for="New Baby"> New Baby</label><br>
                        <input type="radio" name="occasion" class="form-check-input"  id="I am sorry" value="I am sorry"> <label for="I am sorry"> I am sorry</label><br>
                        <input type="radio" name="occasion" class="form-check-input" id="Birthday" value="Birthday"> <label for="Birthday"> Birthday</label><br>
                        <input type="radio" name="occasion" class="form-check-input" id="Love" value="Love"> <label for="Love"> Love</label><br>
                        <input type="radio" name="occasion" class="form-check-input" id="Get well soon" value="Get well soon"> <label for="Get well soon"> Get well soon</label><br>
                       

                        <!-- <button id='goWhom' class="btn btn-outline-white btn-md waves-effect">< Previous</button> -->
                        <!-- <a href="#" class="btn btn-outline-white btn-md waves-effect">Next</a> -->
                      </div>
                  <!--card -->














                   <!-- <div class="card"> -->
                    <!--Card content-->
                      <div class="card-body secondary-color white-text animated important-hide" id="whomCard">
                        <!--Title-->
                        <h4 class="card-title">For whom will the gift be?</h4>
                        <!--Text-->
                        <!-- <input type="radio" name="whom" id="kid" value="1"> <label for="kid"> Kids (0 - 12 y/o)</label><br>
                        <input type="radio" name="whom" id="teen" value="2">  <label for="teen">   Teens (13 - 19 y/o)</label><br>
                        <input type="radio" name="whom" id="adult" value="3"> <label for="adult">   Adult (20 y/o  and above )</label><br>
                        <input type="radio" name="whom" id="any" value="4"> <label for="any">   Any Age</label><br> -->
                       <div class="row">
                          <div class="col-md-4">
                            <input type="number" name="whom" class="form-control" placeholder="Enter Age Here">
                          </div>
                          <div class="col-md-4">
                          <select class="browser-default custom-select" id="by" name="by">
                            <option value="1">Years Old</option>
                            <option value="2">Months Old</option>
                          </select>
                          </div>
                       </div>
                    
                        <!-- <a href="#" class="btn btn-outline-white btn-md waves-effect">Next</a> -->
                      </div>
                      <div class="card-body secondary-color  white-text animated important-hide" id="genderCard">
                        <!--Title-->
                        <h4 class="card-title">For what gender?</h4>
                        <!--Text-->
                        <input type="radio" name="gender" id="male" value="1"> <label for="male"> Male</label><br>
                        <input type="radio" name="gender" id="female" value="2">  <label for="female">   Female</label><br>
                        <input type="radio" name="gender" id="both" value="3"> <label for="both">   Both</label><br>

                        <button id='goWhom' class="btn btn-outline-white btn-md waves-effect">< Previous</button>
                        <!-- <a href="#" class="btn btn-outline-white btn-md waves-effect">Next</a> -->
                      </div>
                      <div class="card-body secondary-color  white-text animated important-hide" id="tagCard">
                        <!--Title-->
                        <h4 class="card-title">What kind of item are you looking for?</h4>
                        <!--Text-->
                          @foreach($tags as $tag)
                            <!-- <input type="checkbox" name="tag[]" id="{{$tag->name}}" value="{{$tag->id}}">  <label for="{{$tag->name}}">   {{$tag->name}}</label><br>  -->
                            <input type="radio" name="tag" id="{{$tag->name}}" value="{{$tag->id}}">  <label for="{{$tag->name}}">   {{$tag->name}}</label><br> 
                          @endforeach

                        <button id='goGender' class="btn btn-outline-white btn-md waves-effect">< Previous</button>
                        <!-- <a href="#" class="btn btn-outline-white btn-md waves-effect">Next</a> -->
                      </div>
                    </div> <!--card -->
                </div>
                <div class="col-md-12 mt-3">
                  <div class="d-flex justify-content-between">
                    <h4>Suggestions</h4>
                    <p></p>
                    <div id="load" class="d-flex important-hide" >
                      <div class="spinner-border text-secondary mr-1 loadingSuggestions"  role="status"></div>
                      <p class="ml-1 loadingSuggestions">Loading Results</p> 
                    </div>

                  </div>
                    
                    <hr>
                     
                   
                </div>
               
                <div class="col-md-12 d-flex" id="suggestions">
        
                </div>
            </div>
        </div>
      </div>

      <!--Footer-->
    
    </div>
    <!--/.Content-->
  </div>
</div>


<!-- modal -->

 @endsection

 @section('scripts')
 <script>
     $( document ).ready(function() {
      $("input[name='occasion']").change(function(){
            var occasion = $(this).val();
            var whom = "";
            var tags = "";
            var gender ="";
            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
            $.ajax({
              type : 'get',
              url : 'find/products',
              data:{'whom':whom, 'gender':gender, 'occasion':occasion, 'tags':tags},
              beforeSend: function(data) {
                $('#load').removeClass('important-hide');
              },
              success:function(data){
                setTimeout(function(){
                  $('#suggestions').html(data);
                  $('#load').addClass('important-hide');
                },800);
              }
            });
            $('#occasionCard').addClass('slideOutLeft faster');
            setTimeout(function(){
              $('#occasionCard').toggleClass('important-hide');
              $('#whomCard').toggleClass('important-hide');
              $('#whomCard').addClass('slideInRight faster');

            },600);
        }); 


        $("input[name='whom']").change(function(){
            var whom = $(this).val();
            // console.log($("#by").val());
            var by = $("#by").val();
            var occasion = $("input[name='occasion']:checked").val();
            var tags = "";
            var gender ="";
            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
            $.ajax({
              type : 'get',
              url : 'find/products',
              data:{'whom':whom, 'gender':gender, 'occasion':occasion, 'by':by},
              beforeSend: function(data) {
                $('#load').removeClass('important-hide');
              },
              success:function(data){
                setTimeout(function(){
                  // console.log(data);
                  $('#suggestions').html(data);
                  $('#load').addClass('important-hide');
                },800);
              }
            });
            $('#whomCard').addClass('slideOutLeft faster');
            setTimeout(function(){
              $('#whomCard').toggleClass('important-hide');
              $('#genderCard').toggleClass('important-hide');
              $('#genderCard').addClass('slideInRight faster');

            },600);
        }); 
      //  whom card manipulation
        // $("input[name='whom']").click(function(){
        //     var whom = $(this).val();
        //     var tags = "";
        //     var gender ="";
        //     $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
        //     $.ajax({
        //       type : 'get',
        //       url : 'find/products',
        //       data:{'whom':whom, 'gender':gender},
        //       beforeSend: function(data) {
        //         $('#load').removeClass('important-hide');
        //       },
        //       success:function(data){
        //         setTimeout(function(){
        //           // console.log(data);
        //           $('#suggestions').html(data);
        //           $('#load').addClass('important-hide');
        //         },800);
        //       }
        //     });
        //     $('#whomCard').addClass('slideOutLeft faster');
        //     setTimeout(function(){
        //       $('#whomCard').toggleClass('important-hide');
        //       $('#genderCard').toggleClass('important-hide');
        //       $('#genderCard').addClass('slideInRight faster');

        //     },600);
        // }); 
        //input whom click

      // gender card Manipulation
      $("input[name='gender']").click(function(){
            var gender = $(this).val();
            var tags = "";
            var whom = $("input[name='whom']").val();
            var occasion = $("input[name='occasion']:checked").val();
           console.log(occasion);
            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
              $.ajax({
                type : 'get',
                url : 'find/products',
                data:{'whom':whom,'occasion':occasion, 'gender':gender, 'tags':tags},
                beforeSend: function(data) {
                  $('#load').removeClass('important-hide');
                },
                success:function(data){
                  console.log(data);
                  setTimeout(function(){
                    $('#suggestions').html(data);
                    $('#load').addClass('important-hide');
                  },800);
                }
              });
              $('#genderClick').addClass('slideOutLeft faster');
              setTimeout(function(){
              $('#genderCard').toggleClass('important-hide');
              $('#tagCard').toggleClass('important-hide');
              $('#tagCard').addClass('slideInRight faster');

              },600);
        }); //gender click

        // tag manipulation
        $("input[name='tag']").click(function(){
          var tags =$(this).val();
          var gender = $("input[name='gender']:checked").val();
          var whom = $("input[name='whom']").val();
          var occasion = $("input[name='occasion']:checked").val();

            // $("input[name='tag[]']:checked").each(function ()
            // {
            //     tags.push(parseInt($(this).val()));
            // });
            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
              $.ajax({
                type : 'get',
                url : 'find/products',
                data:{'whom':whom,'gender':gender,'occasion':occasion,  'tags':tags},
                beforeSend: function(data) {
                  $('#load').removeClass('important-hide');
                },
                success:function(data){
                  setTimeout(function(){
                    console.log(data);
                    $('#suggestions').html(data);
                    $('#load').addClass('important-hide');
                  },800);
                }
              });

        });//tag checked









        // back buttons
        $("#goWhom").click(function(){
          $('#genderCard').addClass('slideOutRight faster'); 
          $('#whomCard').toggleClass('slideOutLeft faster'); 
            setTimeout(function(){
              $('#genderCard').toggleClass('important-hide');
              $('#genderCard').toggleClass('slideOutRight faster'); 
              $('#whomCard').toggleClass('important-hide');
              $('#whomCard').addClass('slideInLeft faster');
            },600);         
        });

        $("#goGender").click(function(){
          $('#tagCard').addClass('slideOutRight faster'); 
          // $('#genderCard').toggleClass('slideOutLeft faster'); 
            setTimeout(function(){
              $('#tagCard').toggleClass('important-hide');
              $('#tagCard').toggleClass('slideOutRight faster'); 
              $('#genderCard').toggleClass('important-hide');
              $('#genderCard').addClass('slideInLeft faster');
            },600);         
        });

     });
 </script>
 @endsection

