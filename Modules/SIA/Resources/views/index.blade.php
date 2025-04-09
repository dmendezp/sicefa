@extends('sia::layouts.master')

@push('head')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMt23cez/3paNdF+Zl5Y5z5F5F5F5F5F5F5F5F5F5" crossorigin="anonymous">
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('sia::mainPage.Breadcrumb_Active_Main') }}</li>
@endpush

@section('content')
    <h5 class="display-5">{{ trans('sia::mainPage.Title_General') }}</h5>
    <h5 data-aos="fade-down">{{ trans('sia::mainPage.Description_General') }}</h5>

    <div class="row">
        <div class="col-md-6">
            <div class="card text-center mb-3 shadow-sm" data-aos="fade-right">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-center">
                        <div>
                            <h5 class="text-center">{{ trans('sia::mainPage.Title_Card_Projects') }}</h5>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap justify-content-center mt-3">

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <h5 class="text-center">{{ trans('sia::mainPage.T_Item_Research') }}</h5>
                            <div class="card-projects mx-auto">
                                <img src="{{ asset('modules/sia/images/cardsIndex/Research.webp') }}" alt="ResearchImage"
                                    class="card-img-top" width="180px" height="260px">
                                <div class="card-body">
                                    <p class="card-text head">{{ trans('sia::mainPage.T_Name_Research') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <h5 class="text-center">{{ trans('sia::mainPage.T_Item_Events') }}</h5>
                            <div class="card-projects mx-auto">
                                <img src="{{ asset('modules/sia/images/cardsIndex/Events.webp') }}" alt="EventsImage"
                                    class="card-img-top" width="140px" height="260px">
                                <div class="card-body">
                                    <p class="card-text head">{{ trans('sia::mainPage.T_Name_Events') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <h5 class="text-center">{{ trans('sia::mainPage.T_Item_Resources') }}</h5>
                            <div class="card-projects mx-auto">
                                <img src="{{ asset('modules/sia/images/cardsIndex/Resources.webp') }}" alt="ResourcesImage"
                                    class="card-img-top" width="140px" height="260px">
                                <div class="card-body">
                                    <p class="card-text head">{{ trans('sia::mainPage.T_Name_Resources') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-center mb-3 shadow-sm" data-aos="fade-left">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-7 order-md-2">
                            <h3 class="featurette-heading">{{ trans('sia::mainPage.Title_Card_Advertising') }} <span
                                    class="text-muted">{{ trans('sia::mainPage.Title_Card_Advertising_pt2') }}</span></h3>
                            <p class="lead">{{ trans('sia::mainPage.Description_Advertising') }} </p>
                        </div>
                        <div class="col-md-5 order-md-1">
                            <img src="{{ asset('modules/sia/images/cardsIndex/Innovation.webp') }}" alt="InnovationImage"
                                class="img-fluid" width="290" height="290">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h3 class="text-center mt-2">{{ trans('sia::mainPage.Title_Developers') }}</h3>
                <div class="card-body">
                    <div class="container text-center">
                        <div class="row">
                            <div class="col-lg-3 mb-4" data-aos="zoom-in">
                                <img class="bd-placeholder-img rounded-circle" src="{{ asset('modules/sia/images/developers/Developer1.webp') }}" alt="Developer1" width="140" height="140">
                                <h4>{{ trans('sia::mainPage.Description_Apprentice') }}</h4>
                                <p>Jesús David Guevara Munar</p>
                                <a class="btn btn-primary" href="https://www.linkedin.com/in/jdgm0331/">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a class="btn btn-dark" href="https://github.com/JDGM0331">
                                    <i class="fab fa-github"></i>
                                </a>
                                <a class="btn btn-primary" href="https://www.facebook.com/JDGM0331">
                                    <i class="fab fa-facebook"></i>
                                </a>
                            </div>
                            <div class="col-lg-3 mb-4" data-aos="zoom-in">
                                <img class="bd-placeholder-img rounded-circle" src="{{ asset('modules/sia/images/developers/Developer2.webp') }}" alt="Developer2" width="140" height="140">
                                <h4>{{ trans('sia::mainPage.Description_Apprentice') }}</h4>
                                <p>Manuel Steven Ossa Lievano</p>
                                <a class="btn btn-primary" href="https://www.linkedin.com/in/manuel-steven-ossa-lievano-014b3b267/">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a class="btn btn-dark" href="https://github.com/SrManuel-1">
                                    <i class="fab fa-github"></i>
                                </a>
                                <a class="btn btn-info custom-instagram-btn" href="https://www.instagram.com/st._.manuel07/">
                                    <i class="fa-brands fa-instagram"></i>
                                </a>
                            </div>
                            <div class="col-lg-3 mb-4" data-aos="zoom-in">
                                <img class="bd-placeholder-img rounded-circle" src="{{ asset('modules/sia/images/developers/Developer3.webp') }}" alt="Developer3" width="140" height="140">
                                <h4>{{ trans('sia::mainPage.Description_Apprentice') }}</h4>
                                <p>Nelsy Yulied Gomez Morales</p>
                                <a class="btn btn-primary" href="www.linkedin.com/in/nelsy-yulied-gomez-morales-5b1b37267">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a class="btn btn-dark" href="https://github.com/nelsygomez11">
                                    <i class="fab fa-github"></i>
                                </a>
                            </div>
                            <div class="col-lg-3 mb-4" data-aos="zoom-in">
                                <img class="bd-placeholder-img rounded-circle" src="{{ asset('modules/sia/images/developers/Developer4.webp') }}" alt="Developer4" width="140" height="140">
                                <h4>{{ trans('sia::mainPage.Description_Apprentice') }}</h4>
                                <p>Anyi Katherine Rojas Arce</p>
                                <a class="btn btn-primary" href="https://www.linkedin.com/in/anyi-rojas-25a003268/">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a class="btn btn-dark" href="https://github.com/anyi-rojas">
                                    <i class="fab fa-github"></i>
                                </a>
                                <a class="btn btn-info custom-twitter-btn" href="https://twitter.com/AnyiRojas0">
                                    <i class="fa-brands fa-twitter"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-center">
                        <a class="btn" id="scrollButton">
                            <h5>{{ trans('sia::mainPage.View_Credits') }}</h5>
                            <i class="fas fa-chevron-down animated-icon"></i>
                        </a>
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
