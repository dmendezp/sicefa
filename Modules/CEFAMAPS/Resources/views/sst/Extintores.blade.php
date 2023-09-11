@extends('cefamaps::layouts.master')

@section('content')
<<<<<<< HEAD

<div id="carouselExampleCaptions" class="carousel slide">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
    <img src="{{asset('cefamaps\images\SST\extintores4.jpg')}}" style="width: 1250px; 
height: 650px">
      <div class="carousel-caption d-none d-md-block">
      </div>
    </div>
    <div class="carousel-item">
      <img src="{{asset('cefamaps\images\SST\extintores3.jpg')}}" style="width: 1200px; 
height: 650px">
      <div class="carousel-caption d-none d-md-block">
      </div>
    </div>
    <div class="carousel-item">
    <img src="{{asset('cefamaps\images\SST\extintores4.jpg')}}"  style="width: 1200px; 
height: 650px">  
      <div class="carousel-caption d-none d-md-block">
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<br>

<p class="card-text">Information of extintores</p>
<div class="container">
<div class="row">

<div class="col-6">
<iframe width="560" height="315" src="https://www.youtube.com/embed/n8NkEB1T-fw" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
</div>
<br>
<div class="col-6">
<iframe width="560" height="315" src="https://www.youtube.com/embed/aWkwRObF5OY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>

</div>
</div>
</div>

@endsection

@section('script')
<script>
$('.carousel').carousel();

</script>

=======
<div class="container">
        <p class="card-text">{{ trans('cefamaps::sst.Title_Card_Fire_Extinguishers') }}</p>
        <div class="row">

            <div class="col-6">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/n8NkEB1T-fw"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen></iframe>
            </div>
            <br>
            <div class="col-6">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/aWkwRObF5OY"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen></iframe>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('.carousel').carousel();
    </script>
>>>>>>> FABRICA4
@endsection
