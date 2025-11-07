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
                    <div class="col-md-6 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h4>{{ $employees->count() }}</h4>
                                <p>{{ trans('sigac::index.SmallBox_Plant_Instructors') }}</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-school"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h4>{{ $contractors->count() }}</h4>
                                <p>{{ trans('sigac::index.SmallBox_Contract_Instructors') }}</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-chalkboard-teacher"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h4>{{ $apprentices->count() }}</h4>
                                <p>{{ trans('sigac::index.SmallBox_Current_Apprentices') }}</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h4>44</h4>
                                <p>{{ trans('sigac::index.SmallBox_Tecnology_Stage') }}</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-book-open"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h4>10</h4>
                                <p>{{ trans('sigac::index.SmallBox_Practical_Technologists') }}</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-walking"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-7 col-12">
                <div class="row">
                    <div class="col-md-4 col-12 d-flex justify-content-center">
                        <div class="card shadow-lg border-0" data-aos="fade-up" data-aos-duration="1000">
                            <div class="card-body text-center">
                                <img src="{{ asset('modules/sigac/images/gifs/burbuja-de-dialogo.gif') }}"
                                    class="card-img-top custom-img align-self-center" alt="...">
                                <div class="card-body p-2">
                                    <h6>{{ trans('sigac::index.Card_Title_What_is_SIGAC') }}</h6>
                                    <p class="card-text mb-0">{{ trans('sigac::index.Card_Description_What_is_SIGAC') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-12">
                        <div class="card shadow-lg border-0" data-aos="fade-up" data-aos-duration="2000">
                            <div class="row no-gutters">
                                <div class="col-md-6 col-12 d-flex align-items-center justify-content-center">
                                    <img src="{{ asset('modules/sigac/images/gifs/libros.gif') }}" class="card-img custom-img"
                                        alt="...">
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="card-body">
                                        <h6>{{ trans('sigac::index.Card_Title_Who_is_SIGAC') }}</h6>
                                        <span class="card-text">{{ trans('sigac::index.Card_Description_Who_is_SIGAC') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card shadow-lg border-0 mt-3" data-aos="fade-up" data-aos-duration="3000">
                            <div class="row no-gutters">
                                <div class="col-md-6 col-12 d-flex align-items-center justify-content-center">
                                    <img src="{{ asset('modules/sigac/images/gifs/buscar.gif') }}" class="card-img custom-img"
                                        alt="...">
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="card-body">
                                        <h6>{{ trans('sigac::index.Card_Title_What_find') }}</h6>
                                        <span class="card-text">{{ trans('sigac::index.Card_Description_What_find') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById("scrollButton").addEventListener("click", function() {
            var scrollHeight = 500; // Altura de desplazamiento deseada (ajusta este valor según tus necesidades)
            window.scrollTo({
                top: scrollHeight,
                behavior: "smooth"
            });
        });
    </script>
@endpush
