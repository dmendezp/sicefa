@extends('sigac::layouts.master')

@push('head')

@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('sigac::general.BTitle') }}</li>
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-8 col-12">
                <h1>{{ trans('sigac::index.Title') }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-5 col-md-5 col-12">
                <div class="row">
                    <div class="col-md-6 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h4>65</h4>
                                <p>{{ trans('sigac::index.SmallBox1') }}</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-school"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h4>65</h4>
                                <p>{{ trans('sigac::index.SmallBox2') }}</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-chalkboard-teacher"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h4>300</h4>
                                <p>{{ trans('sigac::index.SmallBox3') }}</p>
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
                                <p>{{ trans('sigac::index.SmallBox4') }}</p>
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
                                <p>{{ trans('sigac::index.SmallBox5') }}</p>
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
                                <img src="{{ asset('modules/sigac/images/burbuja-de-dialogo.gif') }}"
                                    class="card-img-top custom-img align-self-center" alt="...">
                                <div class="card-body p-2">
                                    <h6>{{ trans('sigac::index.CardTitle1') }}</h6>
                                    <p class="card-text mb-0">{{ trans('sigac::index.CardDescription1') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-12">
                        <div class="card shadow-lg border-0" data-aos="fade-up" data-aos-duration="2000">
                            <div class="row no-gutters">
                                <div class="col-md-6 col-12 d-flex align-items-center justify-content-center">
                                    <img src="{{ asset('modules/sigac/images/libros.gif') }}" class="card-img custom-img"
                                        alt="...">
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="card-body">
                                        <h6>{{ trans('sigac::index.CardTitle2') }}</h6>
                                        <span class="card-text">{{ trans('sigac::index.CardDescription2') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card shadow-lg border-0 mt-3" data-aos="fade-up" data-aos-duration="3000">
                            <div class="row no-gutters">
                                <div class="col-md-6 col-12 d-flex align-items-center justify-content-center">
                                    <img src="{{ asset('modules/sigac/images/buscar.gif') }}" class="card-img custom-img"
                                        alt="...">
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="card-body">
                                        <h6>{{ trans('sigac::index.CardTitle3') }}</h6>
                                        <span class="card-text">{{ trans('sigac::index.CardDescription3') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center mb-3">
                    <div class="text-center">
                        <h1>{{ trans('sigac::index.TitleCard') }}</h1>
                        <span>Tercer trimestre del calendario 2023</span>
                        <p>Del 20/04/2023 hasta el 20/07/2023</p>
                    </div>
                </div>                
                <div class="col-12 col-md-8" style="position: relative; background-image: url('/modules/sigac/images/backgrounds/background-time.webp'); background-size: cover; background-position: center;" data-aos="fade-up">
                    <div class="card" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 1;">
                    </div>
                    <div class="card-body d-flex flex-column align-items-center text-white"
                        style="position: relative; z-index: 2;">
                        <p class="mb-3">{{ trans('sigac::index.TextCard') }}</p>
                        <div class="btn-group" role="group">
                            <a href="#" class="btn btn-light mb-2 mx-2">{{ trans('sigac::index.BtnCard1') }} <i class="fa-solid fa-school fa-fw"></i></a>
                            <a href="#" class="btn btn-light mb-2 mx-2">{{ trans('sigac::index.BtnCard2') }} <i class="fa-solid fa-chalkboard-user fa-fw"></i></a>
                            <a href="#" class="btn btn-light mb-2 mx-2">{{ trans('sigac::index.BtnCard3') }} <i class="fa-solid fa-book fa-fw"></i></a>
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
