@extends('cpd::layouts.master')

@section('breadcrumb')
    <li class="breadcrumb-item">{{ trans('cpd::mainPage.Breadcrumb_Home') }}</li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid row">
            <div class="card card-warning card-outline col-auto mx-auto">
                <div class="card-body">
                    <h3> <em>{{ $view['titleView'] }}</em> </h3>
                    <div class="row justify-content-center">
                        <div class="col-auto">
                            <img src="{{ asset('cpd/images/CPD Portada.jpg') }}" alt="Main cover image" class="img-fluid" style="max-height:450px">
                        </div>
                        <div class="col-auto">
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="max-width:378px; max-height:450px;">
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="d-block img-fluid" src="{{ asset('cpd/images/Home-1.jpg') }}" alt="Home-1">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block img-fluid" src="{{ asset('cpd/images/Home-2.jpg') }}" alt="Home-2">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block img-fluid" src="{{ asset('cpd/images/Home-3.jpg') }}" alt="Home-3">
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                    data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                    data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('scripts')
@endsection
