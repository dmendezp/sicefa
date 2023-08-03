
@extends('evs::layouts.master')

@section('title','Home')

@section('breadcrumb')
<li class="breadcrumb-item active">
  <a href="{{ route('cefa.evs.voto.index') }}"><i class="fas fa-home"></i> {{ __('Home') }}</a>
</li>
@endsection

@section('content')
    <!-- Main content -->
    <div class="content">

      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6 d-flex">
                <div class="card card-purple card-outline shadow">
                <div class="card-header text-muted border-bottom-0">
                  {{ $elected[0]->candidate->election->name }}
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>{{ $elected[0]->candidate->person->first_name." ".$elected[0]->candidate->person->first_last_name." ".$elected[0]->candidate->person->second_last_name }}</b></h2>
                      <p class="text-muted text-sm"><b>{{ $elected[0]->program }} </b>  </p>
                      <br>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="far fa-envelope"></i></span> Correo: {{ $elected[0]->email }}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-phone"></i></span> Phone #: {{ $elected[0]->telephone }}</li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="{{ asset('evs/images/'.$elected[0]->candidate->avatar) }}" alt="" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <a href="#" class="btn btn-sm bg-teal">
                      <i class="fab fa-whatsapp"></i>
                    </a>
                    <a href="#" class="btn btn-sm btn-primary">
                      <i class="fab fa-facebook-f"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 d-flex">
            <div class="card card-purple card-outline shadow">
              <!-- /.card-header -->
              <div class="card-body">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                  <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                  </ol>
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <img class="d-block w-100" src="{{ asset('evs/images/v0.jpg') }}" alt="First slide">
                    </div>
                    <div class="carousel-item">
                      <img class="d-block w-100" src="{{ asset('evs/images/v1.jpg') }}" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                      <img class="d-block w-100" src="{{ asset('evs/images/v2.jpg') }}" alt="Third slide">
                    </div>
                    <div class="carousel-item">
                      <img class="d-block w-100" src="{{ asset('evs/images/v3.jpg') }}" alt="Third slide">
                    </div>
                  </div>
                  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-md-12">
            <div class="card card-purple card-outline shadow">
              <div class="card-header">
                <h3 class="card-title">
                  Como votar
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <ol>
                      <li class="text-sm">Ingresar al link de elecciones 
 http://siscefa.com/evs/votar</li>
                      <li class="text-sm">Digitar su número de documento de identificación y código suministrado</li>
                      <li class="text-sm">Votar por el/la candidata  de su preferencia</li>
                      <li class="text-sm">Diligenciar el link de asistencia</li>
                      <li class="text-sm">Asistencia <a target="_blank" href="https://forms.office.com/Pages/ResponsePage.aspx?id=gcPCyy4vk02R0VBskxas52sNM4FDeylOhg4URln-zc9UNk5JNDVHWTlZWlBCNzVINU9VUDJYMFhUVS4u">clic aqui</a></li>

                    </ol>
                  </div>
                  <div class="col-md-4">
                    <img class="d-block w-100" src="{{ asset('evs/images/LogoBienestarAprendiz.png') }}" alt="Third slide">
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    <!-- /.content -->
  </div>

@stop