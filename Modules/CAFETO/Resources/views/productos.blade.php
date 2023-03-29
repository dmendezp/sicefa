@extends('cafeto::layouts.master')
@section('style')
<style>
.card {
    color: green;
    justify-content: center;
    align-items: center;
}


</style>
@endsection
@section('content')
    <h1>Bienvenidos ala pagina Productos</h1>

    <p>
        This view is loaded from module: {!! config('cafeto.name') !!}
    </p>

    <div class="card" style="width: 18rem;">
        <div class="front">
        <img src="{{asset('cafeto\images\3.jpg')}}" class="card-img-top">
        <div class="card-body">
          <h5 class="card-title">Cafe Americano</h5>
          <p class="card-text">1500 $</p>
        </div>
        </div>
      </div>
@endsection
