@extends('hdc::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">Manual de usuario</li>
@endpush
@push('head')
<!-- Menu CSS -->
<link rel="stylesheet" href="{{ asset('modules/HDC/css/menu.css') }} ">
@endpush

@section('content')
<body>
    <div class="container">
        <section class="hero_container container">
            <h1 class="hero_title">Manual de Usuario</h1>
            <p class="hero_paragraph">Bienvenido al Manual de Usuario. Aquí encontrarás información detallada sobre cómo utilizar nuestra aplicación.</p>
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
