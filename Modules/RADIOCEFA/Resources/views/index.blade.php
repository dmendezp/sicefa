@extends('radiocefa::layouts.master')

<div class="wrapper">
@include('radiocefa::layouts/partials/hero')

@include('radiocefa::layouts/partials/navbar')

@section('content')

	<br>
 <div>
<!--Cards-->

<div class ="row" >
    <div class="card col-4 card-align-center" style="width: 18rem;">
        <img src="..." class="card-img-top" alt="...">
        <div class="card-body">
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
      </div>

      <div class="card col-4 card-align-center" style="width: 18rem;">
        <img src="..." class="card-img-top" alt="...">
        <div class="card-body">
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
      </div>

      <div class="card col-4 card-align-center" style="width: 18rem;">
        <img src="..." class="card-img-top" alt="...">
        <div class="card-body">
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
      </div>
    </div>
{{-- end cards --}}

        <div style="text-align:center;">
        </body>
        <iframe src="https://zeno.fm/player/radio-cefa" width="768" height="600" frameborder="0" scrolling="no"></iframe><a href="https://zeno.fm/" target="_blank" style="display: block; font-size: 0.9em; line-height: 10px;">A Zeno.FM Station</a></iframe>
  

</div>

 
@endsection

</div>