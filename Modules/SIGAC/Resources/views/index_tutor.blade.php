@extends('sigac::layouts.master')

@push('head')
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('sigac::index.Breadcrumb_Active_Main') }}</li>
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-8 col-12">
                <h1>{{ trans('sigac::index.Title_General') }}</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-5 col-md-5 col-12">
                <div class="row">
                    {{-- Aquí van los small-box --}}
                </div>
            </div>

            <div class="col-lg-7 col-md-7 col-12">
                <div class="row">
                    {{-- Aquí van las tarjetas con imágenes y descripciones --}}
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-1 mb-2">
        <a class="btn" id="scrollButton" style="margin-top: 10px; margin-bottom: 20px;">
            <i class="fa-solid fa-angles-down fa-fade fa-2xl"></i>
        </a>
    </div>

    <hr>

    <div class="card" data-aos="fade-up">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center mb-3">
                    <div class="text-center">
                        <h1>{{ trans('sigac::index.Card_Title_Current_Quarter') }}</h1>
                        <h4></h4>
                        <p>{{ trans('sigac::index.Text_From') }} <strong></strong> {{ trans('sigac::index.Text_Until') }} <strong></strong></p>
                    </div>
                </div>

                <div class="col-12 col-md-8" style="position: relative; background-image: url(''); background-size: cover; background-position: center;">
                    <div class="card" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 1;"></div>
                    <div class="card-body d-flex flex-column align-items-center text-white" style="position: relative; z-index: 2;">
                        <h5 class="mb-3">{{ trans('sigac::index.Card_Title_Programming_Consult') }}</h5>
                        <div>
                            {{-- Aquí van los botones --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById("scrollButton").addEventListener("click", function () {
            var scrollHeight = 500;
            window.scrollTo({
                top: scrollHeight,
                behavior: "smooth"
            });
        });
    </script>
@endpush
