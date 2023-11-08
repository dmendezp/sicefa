@extends('hdc::layouts.master')
@push('breadcrumbs')
    <li class="breadcrumb-item active"><a href=""></a>{{ trans('hdc::developers.Indicator_developers')}}</li>
@endpush

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row  justify-content-md-center">
            <div class="col-lg-4">
                <div class="card card-primary card-outline shadow">
                    <div class="card-header">
                        <h3 class="card-title">Desarrolladores</h3>
                    </div>
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" 
                                src="{{ asset('modules/HDC/img/Diego.png')}}" 
                                alt="User profile picture">
                        </div>
                        <h3 class="profile-username text-center">Diego Andres Mendez Pastrana</h3>
                        <p class="text-muted text-center">Instructor - Tgo. Analisis y desarrollo de software</p>
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

            <div class="col-lg-4">
                <div class="card card-primary card-outline shadow">
                    <div class="card-header">
                        <h3 class="card-title">Desarrolladores</h3>
                    </div>
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="{{ asset('modules/HDC/img/mary.png') }}" 
                                alt="User profile picture">
                        </div>
                        <h3 class="profile-username text-center">Mary Luz Aldana Vidarte</h3>
                        <p class="text-muted text-center">Aprendiz - Tgo. Analisis y desarrollo de software</p>
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
        </div>
    </div>
</div>
@endsection