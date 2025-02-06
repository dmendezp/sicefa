@extends('tilabs::layouts.master')

@section('stylesheet')
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-6 d-flex align-items-stretch flex-column">
                    <div class="card bg-light d-flex flex-fill">
                        <div class="card-header text-muted border-bottom-0">
                            {{ trans('tilabs::developers.Title_Instructor') }}
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="lead"><b>Diego Andres Mendez Pastrana</b></h2>
                                    <p class="text-muted text-sm"><b>About: </b> Developer / UX / Coffee Lover
                                    </p>
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span>
                                            Address: SENA - La Angostura</li>
                                    </ul>
                                </div>
                                <div class="col-5 text-center">
                                    <img src="{{ asset('modules/sica/images/Diego.png') }}" alt="user-avatar"
                                        class="img-circle img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">
                                <a href="#" class="btn btn-sm bg-primary">
                                    <i class="fab fa-facebook"></i>
                                </a>
                                <a href="#" class="btn btn-sm bg-primary">
                                    <i class="fab fa-linkedin"></i>
                                </a>
                                <a href="#" class="btn btn-sm bg-primary">
                                    <i class="fab fa-github"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 d-flex align-items-stretch flex-column">
                    <div class="card bg-light d-flex flex-fill">
                        <div class="card-header text-muted border-bottom-0">
                            {{ trans('tilabs::developers.Title_Team') }}
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="lead"><b>{{ trans('tilabs::developers.Text_Team') }}</b></h2>
                                    <p class="text-muted text-sm"><b>About: </b> Developers / Web Designers / UX / Graphic
                                        Artists / Coffee Lovers
                                    </p>
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span>
                                            Address: SENA - La Angostura</li>
                                    </ul>
                                </div>
                                <div class="col-5 text-center">
                                    <img src="{{ asset('modules/sica/images/logofs.png') }}" alt="user-avatar"
                                        class="img-circle img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">
                                <a href="#" class="btn btn-sm bg-primary">
                                    <i class="fab fa-facebook"></i>
                                </a>
                                <a href="#" class="btn btn-sm bg-primary">
                                    <i class="fab fa-linkedin"></i>
                                </a>
                                <a href="#" class="btn btn-sm bg-primary">
                                    <i class="fab fa-github"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-trophy"></i>
                                {{ trans('tilabs::developers.Title_Credits') }}
                            </h3>
                        </div>

                        <div class="card-body">
                            <ul>
                                <li>Plantilla de AdminLTE: <a href="https://adminlte.io" title="AdminLTE" target="blank">adminlte.io/</a></li>
                                <li>Iconos Fontawesome: <a href="https://fontawesome.com/icons?d=gallery" title="Flaticon" target="blank"> fontawesome.com</a></li></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('script')
@endsection
