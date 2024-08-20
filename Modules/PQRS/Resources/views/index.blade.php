@extends('pqrs::layouts.master')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="d-flex justify-content-center">
            <div class="card card-blue card-outline shadow col-md-12">
                <div class="card-header">
                    <h1 class="card-title"><strong>PQRS</strong></h1>            
                </div>
                <div class="card-body">
                    <div id="carouselExample" class="carousel slide">
                        <div class="carousel-inner">
                          <div class="carousel-item active">
                            <img src="{{ asset('modules/pqrs/img/tracking.jpg') }}" class="d-block w-100" height="400px">
                          </div>
                      </div>
                    <p>
                        El proyecto PQRS, está dedicado a desarrollar un aplicativo destinado a optimizar los
                        procesos seguimiento y respuesta de las PQRS. El estado actual del cargo implica la
                        creación de una herramienta integral que permita un control eficiente del
                        seguimiento de manera práctica. Entre las características destacadas del cargo se
                        encuentran la capacidad de enviar correos electrónicos de las PQRS que estén
                        próximas a vencer a los funcionarios y apoyos correspondientes, además de hacer un
                        registro masivo de PQRS por medio de un archivo Excel.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
