 <!--Carousel Wrapper-->
 <div id="carousel-example-1z" class="carousel slide carousel-fade pt-4" data-ride="carousel">

<!--Indicators-->
<ol class="carousel-indicators">
  <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
  <li data-target="#carousel-example-1z" data-slide-to="1"></li>
  <li data-target="#carousel-example-1z" data-slide-to="2"></li>
</ol>
<!--/.Indicators-->

<!--Slides-->
<div class="carousel-inner" role="listbox">

  <!--First slide-->
  <div class="carousel-item active">
    <div class="view" style="background-image: url('https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/8-col/img%282%29.jpg'); background-repeat: no-repeat; background-size: cover;">

      <!-- Mask & flexbox options-->
      <div class="mask rgba-black-strong d-flex justify-content-center align-items-center">

        <!-- Content -->
        <div class="text-center white-text mx-5 wow fadeIn">
          <h1 class="mb-4">
            <strong>Send gifts right to their doorsteps!</strong>
          </h1>

          <p>
            <strong>Wide range of items from clothing, accessories, and even gadgets!</strong>
          </p>

          <p class="mb-4 d-none d-md-block">
            <strong>The most complex and user-friendly e-commerce site for your gifting needs.</strong>
          </p>

          <a href="{{route('login')}}" class="btn btn-outline-white btn-lg">Sign in
            <i class="fas fa-graduation-cap ml-2"></i>
          </a>
        </div>
        <!-- Content -->

      </div>
      <!-- Mask & flexbox options-->

    </div>
  </div>
  <!--/First slide-->

  <!--Second slide-->
  <div class="carousel-item">
    <div class="view" style="background-image: url('https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/8-col/img%283%29.jpg'); background-repeat: no-repeat; background-size: cover;">

      <!-- Mask & flexbox options-->
      <div class="mask rgba-black-strong d-flex justify-content-center align-items-center">

        <!-- Content -->
        <div class="text-center white-text mx-5 wow fadeIn">
          <h1 class="mb-4">
            <strong>Be a part of our team</strong>
          </h1>


          <p class="mb-4 d-none d-md-block">
            <strong>We love to sell your unique products, and sell them to the masses. Click the button below.</strong>
          </p>

          <a href="{{ route('store.login') }}" class="btn btn-outline-white btn-lg">Sign in
            <i class="fas fa-graduation-cap ml-2"></i>
          </a>
        </div>
        <!-- Content -->

      </div>
      <!-- Mask & flexbox options-->

    </div>
  </div>
  <!--/Second slide-->

  <!--Third slide-->
  <div class="carousel-item">
    <div class="view" style="background-image: url('https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/8-col/img%285%29.jpg'); background-repeat: no-repeat; background-size: cover;">

      <!-- Mask & flexbox options-->
      <div class="mask rgba-black-strong d-flex justify-content-center align-items-center">

        <!-- Content -->
        <div class="text-center  white-text mx-5 wow fadeIn">
          <h1 class="mb-4">
            <strong>Explore!</strong>
          </h1>


          <p class="mb-4 d-none d-md-block">
            <strong>Find what suits your needs. </strong>
          </p>
        </div>
        <!-- Content -->

      </div>
      <!-- Mask & flexbox options-->

    </div>
  </div>
  <!--/Third slide-->

</div>
<!--/.Slides-->

<!--Controls-->
<a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
  <span class="sr-only">Previous</span>
</a>
<a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
  <span class="carousel-control-next-icon" aria-hidden="true"></span>
  <span class="sr-only">Next</span>
</a>
<!--/.Controls-->

</div>
<!--/.Carousel Wrapper-->