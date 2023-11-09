@extends('hdc::layouts.master')
@push('breadcrumbs')
    <li class="breadcrumb-item active"><a href=""></a>{{ trans('hdc::developers.developers') }}</li>
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row  justify-content-md-center">
                <!-- /.col-md-6 -->
                    <div class="col-lg-3">
                        <div class="card card-green card-outline shadow">
                            <div class="card-header">
                                <h5 class="m-0">{{ trans('hdc::developers.developers')}}</h5>
                            </div>
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ asset('modules/HDC/img/Diego.png') }}"
                                        alt="User profile picture">
                                </div>
                                <h3 class="profile-username text-center">Diego Andres Mendez Pastrana</h3>
                                <p class="text-muted text-center">Instructor - Tgo. Analisis y desarollo de software</p>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Facebook</b> <a href="#" class="btn btn-outline-primary float-right"><b><i class="fab fa-facebook-f"></i></b></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>LinkedIn</b> <a href="#" class="btn btn-outline-primary float-right"><b><i class="fab fa-linkedin-in"></i></b></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="card card-green card-outline shadow">
                            <div class="card-header">
                                <h5 class="m-0">{{ trans('hdc::developers.developers')}}</h5>
                            </div>
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ asset('modules/HDC/img/Mary.png') }}"
                                        alt="User profile picture">
                                </div>
                                <h3 class="profile-username text-center">Mary Luz Aldana Vidarte</h3>
                                <p class="text-muted text-center">Aprendiz - Tgo. Analisis y desarollo de software</p>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Facebook</b> <a href="#" class="btn btn-outline-primary float-right"><b><i class="fab fa-facebook-f"></i></b></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>LinkedIn</b> <a href="#" class="btn btn-outline-primary float-right"><b><i class="fab fa-linkedin-in"></i></b></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card card-green card-outline shadow">
                        <div class="card-header">
                            <h5 class="m-0">{{ trans('hdc::developers.developers')}}</h5>
                        </div>
                        <div class="card-body box-profile">
                            <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="{{ asset('modules/HDC/img/David.png') }}"
                                alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center">Andrés David Cumaco Rojas</h3>
                            <p class="text-muted text-center">Aprendiz - Tgo. Analisis y desarollo de software</p>
                            <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Facebook</b> <a href="#" class="btn btn-outline-primary float-right"><b><i class="fab fa-facebook-f"></i></b></a>
                            </li>
                                <li class="list-group-item">
                                <b>LinkedIn</b> <a href="#" class="btn btn-outline-primary float-right"><b><i class="fab fa-linkedin-in"></i></b></a>
                            </li>
                            </ul>
                        </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card card-green card-outline shadow">
                            <div class="card-header">
                                <h5 class="m-0">{{ trans('hdc::developers.developers')}}</h5>
                            </div>
                            <div class="card-body box-profile">
                                <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{ asset('modules/HDC/img/Sofia.png') }}"
                                    alt="User profile picture">
                                </div>
                                <h3 class="profile-username text-center">Leidy Sofia Osorio vera</h3>
                                <p class="text-muted text-center">Aprendiz - Tgo. Analisis y desarollo de software</p>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Facebook</b> <a href="#" class="btn btn-outline-primary float-right"><b><i class="fab fa-facebook-f"></i></b></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>LinkedIn</b> <a href="#" class="btn btn-outline-primary float-right"><b><i class="fab fa-linkedin-in"></i></b></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                <!-- /.col-md-6 -->
            </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-green card-outline shadow">
                            <div class="card-header">
                                <h3 class="card-title">
                                Créditos y reconocimientos
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <ul>
                                        <li>Plantilla AdminLTE de <a href="https://adminlte.io" title="AdminLTE" target="blank">adminlte.io/</a></li>
                                        <li>Iconos gratuitos de <a href="https://fontawesome.com/icons?d=gallery" title="Flaticon" target="blank"> fontawesome.com</a></li>
                                    </ul>
                                </div>
                            </div>
                        <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
    </div>
@endsection