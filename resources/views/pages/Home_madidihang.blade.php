@extends('layout.index')
@section('content')

<!--  Welcome -->
<section class="site-hero overlay" style="background-image: url(images/hero_4.jpg)" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row site-hero-inner justify-content-center align-items-center">
      <div class="col-md-10 text-center" data-aos="fade-up">
        <span class="custom-caption text-uppercase text-white d-block  mb-3">Welcome To Guest House</span>
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
        <img src="images/madidihang_building.jpg" alt="Image" class="img-fluid rounded">
      </div>
      <div class="col-md-12 col-lg-4 order-lg-1" data-aos="fade-up">
        <h2 class="heading">Wisma Madidihang</h2>
        <p class="mb-4">{{$about->body}}</p>
        <p><a href="about" class="btn btn-primary text-white py-2 mr-3">Learn More</a> <span class="mr-3 font-family-serif"><em>or</em></span> <a href={{$about->video}} data-fancybox class="text-uppercase letter-spacing-1">See video</a></p>
      </div>

    </div>
  </div>
</section>
<!-- End section About -->

<!-- Room -->
<section class="section bg-light">

  <div class="container">
    <div class="row justify-content-center text-center mb-5">
      <div class="col-md-7">
        <h2 class="heading" data-aos="fade">Rooms &amp; Suitess</h2>
        <p data-aos="fade">{{$description->room}}</p>
      </div>
    </div>
    <?php $i = 1; ?>
    @foreach ($categoryMad as $cate)
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

<!-- Menu -->
<section class="section bg-image overlay" style="background-image: url('images/hero_3.jpg');">
  <div class="container">
    <div class="row justify-content-center text-center mb-5">
      <div class="col-md-7">
        <h2 class="heading text-white" data-aos="fade">Our Restaurant Menu</h2>
        <p class="text-white" data-aos="fade" data-aos-delay="100">{{$description->menu}}</p>
      </div>
    </div>
    <div class="food-menu-tabs" data-aos="fade">
      <ul class="nav nav-tabs mb-5" id="myTab" role="tablist">
        @foreach ($food_category as $fc)
        <li class="nav-item">
          <a class="nav-link @if ($fc->id==1) active @endif letter-spacing-2" id="{{$fc->name}}-tab" data-toggle="tab" href="#{{$fc->name}}" role="tab" aria-controls={{$fc->name}} aria-selected="true">{{$fc->name}}</a>
        </li>
        @endforeach
      </ul>
      <div class="tab-content py-5" id="myTabContent">

        @foreach ($food_category as $fc)
        <?php $i = 1; ?>
        <div class="tab-pane fade @if ($fc->id==1) show active @endif text-left" id={{$fc->name}} role="tabpanel" aria-labelledby="{{$fc->name}}-tab">
          <div class="row">

            @foreach ($fc->getFood as $f)

            @if ($i==1 )
            <div class="col-md-6"> @endif

              <div class="food-menu mb-5">
                <span class="d-block text-primary h4 mb-3">IDR {{number_format($f['price'], 0, "," , ".")}}</span>
                <h3 class="text-white"><a href="#" class="text-white">{{$f->name}}</a></h3>
                <p class="text-white text-opacity-7">{{$f->description}}</p>
              </div>
              @if ($i == count($fc->getFood)/2 )
            </div>
            <div class="col-md-6">
              @endif
              <?php $i++; ?>
              @endforeach
            </div>

          </div>

        </div> <!-- .tab-pane -->
        @endforeach

      </div>
    </div>
  </div>
</section>

<!--  Event -->
<?php $ev = $event->take(3); ?>
<section class="section blog-post-entry bg-light">
  <div class="container">
    <div class="row justify-content-center text-center mb-5">
      <div class="col-md-7">
        <h2 class="heading" data-aos="fade-up">Events</h2>
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