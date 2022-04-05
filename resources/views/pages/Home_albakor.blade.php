@extends('layout.index')
@section('content')

<!--  Welcome -->
<section class="site-hero overlay" style="background-image: url(images/hero_4.jpg)" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row site-hero-inner justify-content-center align-items-center">
      <div class="col-md-10 text-center" data-aos="fade-up">
        <span class="custom-caption text-uppercase text-white d-block  mb-3">Welcome To Reservasi Guest House</span>
        <h1 class="heading">{{$infor->slogan}}</h1>
        <a href="reservation/{1}" class="btn btn-outline-white-primary py-3 text-white px-5">Reserve Now</a>
      </div>
    </div>
  </div>

  <a class="mouse smoothscroll" href="#next">
    <div class="mouse-icon">
      <span class="mouse-wheel"></span>
    </div>
  </a>
</section>

<!-- About -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-12 col-lg-7 ml-auto order-lg-2 position-relative mb-5" data-aos="fade-up">
        <figure class="img-absolute">
          <img src="images/food-1.jpg" alt="Image" class="img-fluid">
        </figure>
        <img src="images/img_1.jpg" alt="Image" class="img-fluid rounded">
      </div>
      <div class="col-md-12 col-lg-4 order-lg-1" data-aos="fade-up">
        <h2 class="heading">Wisma Albakor</h2>
        <p class="mb-4">{{$about->body}}</p>
        <p><a href="about" class="btn btn-primary text-white py-2 mr-3">Learn More</a> <span class="mr-3 font-family-serif"><em>or</em></span> <a href={{$about->video}} data-fancybox class="text-uppercase letter-spacing-1">See video</a></p>
      </div>

    </div>
  </div>
</section>
<!-- End section About -->

<section class="section bg-light">

  <div class="container">
    <div class="row justify-content-center text-center mb-5">
      <div class="col-md-7">
        <h2 class="heading" data-aos="fade">Rooms &amp; Suitess</h2>
        <p data-aos="fade">{{$description->room}}</p>
      </div>
    </div>
    <?php $i = 1; ?>
    @foreach ($category_albk as $cate)
    <div class="site-block-half d-block d-lg-flex bg-white" data-aos="fade" data-aos-delay="100">
      <a href="#" class="image d-block bg-image-2 @if ($i % 2==0) order-2 @endif " style="background-image: url({{ Storage::url("{$cate->image}") }});"></a>
      <div class="text @if ($i % 2==0) order-1 @endif">
        <span class="d-block mb-4"><span class="display-4 text-primary">IDR{{number_format($cate['price'], 0, "," , ".")}}</span> <span class="text-uppercase">/ per night</span> </span>
        <h2 class="mb-4">{{$cate->name}}</h2>
        <p>{{$cate->description}}</p>
        <p><a href="reservation/{{$cate->id}}" class="btn btn-primary text-white">Book Now</a></p>
      </div>
    </div>
    <?php $i++; ?>
    @endforeach

  </div>
</section>

@include('layout.slide')
<!-- END Slide section -->
<!-- END section Menu -->

<!-- End Footer -->
@endsection