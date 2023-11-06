@extends('hdc::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('hdc::Graficas.Graphics')}}</li>
@endpush
@push('head')
<!-- Menu CSS -->
<link rel="stylesheet" href="{{ asset('modules/HDC/css/menu.css') }} ">
@endpush

@section('content')
<body>
    <div class="container">
        <section class="hero" style="background-image: linear-gradient(180deg, #0000008c 0%, #0000008c 100%), url('{{ asset('modules/HDC/img/plants2.jpg') }}');">
            <h1 class="hero_title">Manual de Usuario</h1>
            <p class="hero_paragraph">Bienvenido al Manual de Usuario. Aquí encontrarás información detallada sobre cómo utilizar nuestra aplicación.</p>
            <a href="#" class="cta">Comienza Ahora</a>
        </section>
    </div>
    
    

<section class="price container">
    
    <div class="price_table">

        <div class="price_element">
            <article class="card" onclick="showDetails('icopor')">
                <div class="temporary_text">
                    <img src="{{ asset('modules/HDC/img/panelcontroladmin.png') }}" alt="" class="icopor">
                </div>
                <div class="card_content">
                    <span class="card_title">Panel de Control del Administrador</span>
                </div>
            </article>
        </div>

        <div class="price_element">
            <article class="card" onclick="showDetails('chicle')">
                <div class="temporary_text">
                    <img src="./imagenes/chicle.jpg" alt="" class="icopor">
                </div>
                <div class="card_content">
                    <span class="card_title">Panel de control del Encargado</span>
                   
                </div>
            </article>
        </div>

    </div>
</section>
</body>
<br>

@endsection
