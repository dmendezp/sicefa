@extends('pqrs::layouts.master')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="d-flex justify-content-center">
            <div class="card card-blue card-outline shadow col-md-4">
                <div class="col">
                    <img src="{{asset('modules/pqrs/img/julian.jpeg')}}" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><strong>Julian Javier Ramirez Diaz</strong></h5>
                        <p class="card-text">Teg. Análisis y Desarrollo de Software</p>
                        <a href="https://github.com/Julianchiki" class="btn btn-dark"><i class="fab fa-github"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection