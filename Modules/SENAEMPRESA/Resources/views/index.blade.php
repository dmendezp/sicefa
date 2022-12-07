@extends('senaempresa::layouts.master')

@section('content')
<main id="main">
    <div class="Contenido">
        <h1>Bievenido al Modulo {!! config('senaempresa.name') !!}</h1>

    </div>
    <video src="{{asset('senaempresa/video/LA_ANGOSTURA.mp4')}}" muted autoplay loop type="video/mp4"></video>
    <div class="capa">

    </div>
</main>



@endsection