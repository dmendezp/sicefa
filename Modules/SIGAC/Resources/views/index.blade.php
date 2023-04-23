@extends('sigac::layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
          <h1 class="hmax h-lg-max h-md-max h-sm-max h-xs-max">Bienvenido al Sistema Integrado de Gestión Académica</h1>
        </div>
    
        <div class="d-flex flex-wrap justify-content-around">
            <div class="card col-12 col-md-4 text-center mb-4 shadow-lg border-0" style="width: 18rem;">
                <img src="{{asset('sigac/images/burbuja-de-dialogo.gif')}}" class="card-img-top custom-img align-self-center" alt="...">
                <div class="card-body">
                    <h3>Qué es SIGAC?</h3>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
                        content.</p>
                </div>
            </div>
     
            <div class="card col-12 col-md-4 text-center mb-4 shadow-lg border-0" style="width: 18rem;">
                <img src="{{asset('sigac/images/libros.gif')}}" class="card-img-top custom-img align-self-center" alt="...">
                <div class="card-body">
                    <h3>Para quién es SIGAC?</h3>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
                        content.</p>
                </div>
            </div>

            <div class="card col-12 col-md-4 text-center mb-4 shadow-lg border-0" style="width: 18rem;">
                <img src="{{asset('sigac/images/buscar.gif')}}" class="card-img-top custom-img align-self-center" alt="...">
                <div class="card-body">
                    <h3>Que encontrarás?</h3>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
                        content.</p>
                </div>
            </div>
        </div>
    </div>

@endsection
