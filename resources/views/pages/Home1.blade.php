@extends('layout.index')
@section('content')

<!--  Welcome -->
<section class="site-hero overlay" style="background-image: url(images/hero_4.jpg)" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row site-hero-inner justify-content-center align-items-center">
      <div class="col-md-10 text-center" data-aos="fade-up">
        <span class="custom-caption text-uppercase text-white d-block  mb-3">Welcome To Reservasi Guest House & Rumah Singgah</span>
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

<section class="section">
  <div class="container">
    <div class="row justify-content-center text-center mb-5">
      <div class="col-md-7">
        <a href="rooms">
          <h2 class="heading" data-aos="fade-up">Wisma in PondokDadap</h2>
        </a>
        <p data-aos="fade-up" data-aos-delay="100">Layanan Fasilitas Guesthouse dan Rumah Singgah
          Unit Pelaksana Teknis Pelabuhan Perikanan Pantai Pondokdadap</p>
      </div>
    </div>
    <div class="row">
      <!-- madidihang -->
      <div class="col-md-6 col-lg-6" data-aos="fade-up">
        <a href="madidihang" class="room position-wrap">
          <figure class="img-wrap">
            <img class="homeimg" src="http://wisma.infopondokdadap.com/wp-content/uploads/2019/12/IMG_21491-768x512.jpg">
          </figure>
          <div class="p-3 text-center room-info">
            <h2>Madidihang</h2>
          </div>
        </a>
      </div>
      <!-- albakor -->
      <div class="col-md-6 col-lg-6" data-aos="fade-up">
        <a href="albakor" class="room position-wrap">
          <figure class="img-wrap">
            <img class="homeimg" src="http://wisma.infopondokdadap.com/wp-content/uploads/2019/02/20190212_144413-768x432.jpg">
          </figure>
          <div class="p-3 text-center room-info">
            <h2>Albakor</h2>
          </div>
        </a>
      </div>
    </div>
  </div>
</section>

@include('layout.slide')
<!-- END Slide section -->

<!--  Event -->
<?php $ev = $event->take(3); ?>
<section class="section blog-post-entry bg-light">
  <div class="container">
    <div class="row justify-content-center text-center mb-5">
      <div class="col-md-7">
        <h2 class="heading" data-aos="fade-up">Destinasi Wisata</h2>
        <p data-aos="fade-up">{{$description->event}} </p>
      </div>
    </div>
    <div class="row">

      @foreach ($ev as $e)
      <div class="col-lg-4 col-md-6 col-sm-6 col-12 post" data-aos="fade-up" data-aos-delay="100">

        <div class="media media-custom d-block mb-4 h-100">
          <a href="#" class="mb-4 d-block"><img src="{{ Storage::url($e->image) }}" alt="Image placeholder" class="img-fluid"></a>
          <div class="media-body">
            <span class="meta-post">{{$e->created_at}}</span>
            <h2 class="mt-0 mb-3"><a href="#">{{$e->name}}</a></h2>
            <p>{{$e->body}}</p>
          </div>
        </div>

      </div>
      @endforeach

    </div>
  </div>
</section>



<!-- End Footer -->
@endsection