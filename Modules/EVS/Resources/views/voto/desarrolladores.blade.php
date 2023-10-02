
@extends('evs::layouts.master')

@section('title','Desarrolladores')

@section('breadcrumb')
<li class="breadcrumb-item active">
  <a href="{{ route('cefa.evs.voto.desarrolladores') }}"><i class="fas fa-users"></i> {{ __('Developers') }}</a>
</li>
@endsection

@section('content')
    <!-- Main content -->
    <div class="content">

      <div class="container-fluid">
        <div class="row justify-content-md-center">
			<div class="col-md-3">
            <div class="card card-purple card-outline shadow">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{ asset('evs/images/Diego.png') }}"
                       alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">Diego Andres Mendez Pastrana</h3>
                <p class="text-muted text-center">Instructor - Tgo. Analisis y desarollo de sistemas de información</p>
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
        <!-- /.row -->
        <div class="row">
          <div class="col-md-12">
            <div class="card card-purple card-outline shadow">
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
                    <li>Iconos diseñados por <a href="https://www.flaticon.es/autores/freepik" title="Freepik" target="blank"> Freepik </a> de <a href="https://www.flaticon.es/" title="Flaticon" target="blank"> www.flaticon.es</a></li>
                  </ul>
                        
                </div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>

      </div><!-- /.container-fluid -->
    <!-- /.content -->
  </div>

@stop