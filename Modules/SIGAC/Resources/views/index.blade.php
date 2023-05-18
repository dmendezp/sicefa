@extends('sigac::layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-7 col-md-8 col-sm-10 col-xs-12">
          <h1 class="hmax h-lg-max h-md-max h-sm-max h-xs-max">{{ trans('sigac::general.Welcome to the Integrated Academic Management System') }}</h1>
        </div>

        <div class="d-flex flex-wrap justify-content-around">
            <div class="card col-12 col-md-4 text-center mb-4 shadow-lg border-0" style="width: 18rem;">
                <img src="{{asset('modules/sigac/images/burbuja-de-dialogo.gif')}}" class="card-img-top custom-img align-self-center" alt="...">
                <div class="card-body">
                    <h3>{{ trans('sigac::general.What is SIGAC?') }}</h3>
                    <p class="card-text">{{ trans('sigac::general.The integrated academic management system is an application that allows the administration of the trainees attendance at the agro-industrial training center "La Angostura".') }}</p>
                </div>
            </div>

            <div class="card col-12 col-md-4 text-center mb-4 shadow-lg border-0" style="width: 18rem;">
                <img src="{{asset('modules/sigac/images/libros.gif')}}" class="card-img-top custom-img align-self-center" alt="...">
                <div class="card-body">
                    <h3>{{ trans('sigac::general.Who is SIGAC for?') }}</h3>
                    <p class="card-text">{{ trans('sigac::general.It is for the use of instructors and academic coordination.')}}</p>
                </div>
            </div>

            <div class="card col-12 col-md-4 text-center mb-4 shadow-lg border-0" style="width: 18rem;">
                <img src="{{asset('modules/sigac/images/buscar.gif')}}" class="card-img-top custom-img align-self-center" alt="...">
                <div class="card-body">
                    <h3>{{ trans('sigac::general.What will you find?') }}</h3>
                    <p class="card-text">{{ trans('sigac::general.Here you will find everything related to the attendance and non-attendance of the apprentices, you will be able to keep an organized control for each apprentice so that the dropout of trainees in the training center is less and less.')}}</p>
                </div>
            </div>
        </div>
    </div>

@endsection
