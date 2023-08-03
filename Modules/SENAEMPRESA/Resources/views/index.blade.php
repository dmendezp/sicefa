@extends('senaempresa::layouts.master')

@section('content')
    <main id="main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="custCarousel" class="carousel slide" data-ride="carousel" align="center">
                        <!-- slides -->
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('senaempresa/images/imagentres.jpg') }}" alt="Hills">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Bievenido al Modulo {!! config('senaempresa.name') !!}</h5>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <img src="{{ asset('senaempresa/images/imagenuno.jpg') }}" alt="Hills">
                            </div>

                            <div class="carousel-item">
                                <img src="{{ asset('senaempresa/images/imagencuatro.jpg') }}" alt="Hills">
                            </div>

                        </div>

                        <!-- Left right -->
                        <a class="carousel-control-prev" href="#custCarousel" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </a>
                        <a class="carousel-control-next" href="#custCarousel" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </a>

                        <!-- Thumbnails -->
                        <ol class="carousel-indicators list-inline">
                            <li class="list-inline-item active">
                                <a id="carousel-selector-0" class="selected" data-slide-to="0" data-target="#custCarousel">
                                    <img src="{{ asset('senaempresa/images/imagentres.jpg') }}" class="img-fluid">
                                </a>
                            </li>

                            <li class="list-inline-item">
                                <a id="carousel-selector-1" data-slide-to="1" data-target="#custCarousel">
                                    <img src="{{ asset('senaempresa/images/imagenuno.jpg') }}" class="img-fluid">
                                </a>
                            </li>

                            <li class="list-inline-item">
                                <a id="carousel-selector-2" data-slide-to="2" data-target="#custCarousel">
                                    <img src="{{ asset('senaempresa/images/imagencuatro.jpg') }}" class="img-fluid">
                                </a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div><br>
    </main>
@endsection
