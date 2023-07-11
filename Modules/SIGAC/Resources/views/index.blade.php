@extends('sigac::layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-7 col-md-8 col-sm-10 col-xs-12">
            <h1 class="hmax h-lg-max h-md-max h-sm-max h-xs-max">{{ trans('sigac::index.Title') }}</h1>
        </div>

        <div class="d-flex flex-wrap justify-content-around">
            <div class="card col-12 col-md-4 text-center mb-4 shadow-lg border-0" style="width: 18rem;">
                <img src="{{ asset('modules/sigac/images/burbuja-de-dialogo.gif') }}" class="card-img-top custom-img align-self-center" alt="...">
                <div class="card-body">
                    <h3>{{ trans('sigac::index.CardTitle1') }}</h3>
                    <p class="card-text">
                        {{ trans('sigac::index.CardDescription1') }}
                    </p>
                </div>
            </div>

            <div class="card col-12 col-md-4 text-center mb-4 shadow-lg border-0" style="width: 18rem;">
                <img src="{{ asset('modules/sigac/images/libros.gif') }}" class="card-img-top custom-img align-self-center" alt="...">
                <div class="card-body">
                    <h3>{{ trans('sigac::index.CardTitle2') }}</h3>
                    <p class="card-text">{{ trans('sigac::index.CardDescription2') }}</p>
                </div>
            </div>

            <div class="card col-12 col-md-4 text-center mb-4 shadow-lg border-0" style="width: 18rem;">
                <img src="{{ asset('modules/sigac/images/buscar.gif') }}" class="card-img-top custom-img align-self-center" alt="...">
                <div class="card-body">
                    <h3>{{ trans('sigac::index.CardTitle3') }}</h3>
                    <p class="card-text">
                        {{ trans('sigac::index.CardDescription3') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
