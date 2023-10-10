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
                                <h4>65</h4>
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
                                <h4>65</h4>
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
                                <h4>300</h4>
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
                        <h4>Tercer trimestre</h4>
                        <p>{{ trans('sigac::index.Text_From') }} <strong>20/04/2023</strong> {{ trans('sigac::index.Text_Until') }} <strong>20/07/2023</strong></p>
                    </div>
                </div>                
                <div class="col-12 col-md-8" style="position: relative; background-image: url('/modules/sigac/images/backgrounds/background-time.webp'); background-size: cover; background-position: center;">
                    <div class="card" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 1;">
                    </div>
                    <div class="card-body d-flex flex-column align-items-center text-white"
                        style="position: relative; z-index: 2;">
                        <h5 class="mb-3">{{ trans('sigac::index.Card_Title_Programming_Consult') }}</h5>
                        <div>
                            <a href="#" class="btn btn-info text-light">{{ trans('sigac::index.Card_Btn_Env') }} <i class="fa-solid fa-school fa-fw"></i></a>
                            <a href="#" class="btn btn-info text-light">{{ trans('sigac::index.Card_Btn_Instructor') }} <i class="fa-solid fa-chalkboard-user fa-fw"></i></a>
                            <a href="#" class="btn btn-info text-light">{{ trans('sigac::index.Card_Btn_Titled') }} <i class="fa-solid fa-book fa-fw"></i></a>
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
