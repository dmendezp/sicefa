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

      <div class="col-md-12 d-flex">
        <div class="card card-purple card-outline shadow w-100">
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
                  <img class="d-block w-100" src="{{ asset('modules/evs/images/portada.jpg') }}" alt="First slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="{{ asset('modules/evs/images/1.jpg') }}" alt="Second slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="{{ asset('modules/evs/images/11.jpg') }}" alt="Third slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="{{ asset('modules/evs/images/10.jpg') }}" alt="Fourth slide">
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
        </div>
      </div>

    <!-- 🔹 RESULTADOS DE ELECCIONES -->
<div class="row">
  @foreach($dataelecciones as $eleccion)
    <div class="col-lg-6 col-md-12 mb-4">
      <div class="card shadow-lg border-0 h-100 d-flex flex-column">
        
        <!-- Header -->
        <div class="card-header 
            {{ $eleccion->status == 'Activo' ? 'bg-success' : 'bg-danger' }} 
            text-white rounded-top">
          <h5 class="mb-0 fw-bold">
            {{ $eleccion->name }}
            <small class="fw-normal">({{ $eleccion->status }})</small>
          </h5>
          <small>
            <i class="far fa-calendar-alt"></i> {{ $eleccion->start_date }}
            &nbsp;|&nbsp;
            <i class="far fa-calendar-check"></i> {{ $eleccion->end_date }}
          </small>
        </div>

        <!-- Body -->
        <div class="card-body d-flex flex-row align-items-center justify-content-between" style="min-height: 220px;">
          @if($eleccion->winner)
            <!-- Info -->
            <div class="flex-grow-1 pe-3">
              <h6 class="fw-bold mb-1">
                {{ $eleccion->winner->person->first_name }}
                {{ $eleccion->winner->person->first_last_name }}
              </h6>
              <small class="text-muted d-block mb-2">
                <i class="far fa-id-card"></i>
                {{ $eleccion->winner->person->document_type }}
                {{ $eleccion->winner->person->document_number }}
              </small>
              <p class="mb-1">
                <i class="fas fa-graduation-cap text-primary"></i>
                <b>Programa: </b>
                {{ $eleccion->winner->person->apprentices[0]->course->program->name ?? 'No registra' }}
              </p>
              <p class="mb-1">
                <i class="fas fa-vote-yea text-success"></i>
                <b>Votos: </b> {{ $eleccion->winner->votes->count() }}
              </p>
              <p class="mb-0">
                <i class="far fa-square text-danger"></i>
                <b>Blanco: </b> {{ $eleccion->votes_count }}
              </p>
            </div>

            <!-- Foto -->
            <div class="text-center">
              <img src="{{ asset($eleccion->winner->avatar) }}"
                   class="rounded-circle border border-3 border-secondary shadow-sm"
                   style="width: 140px; height: 140px; object-fit: cover;">
            </div>
          @else
            <p class="text-muted mb-0">
              <i class="fas fa-exclamation-circle"></i>
              No hay ganador registrado en esta elección.
            </p>
          @endif
        </div>

        <!-- Footer -->
        @if($eleccion->winner)
          <div class="card-footer d-flex justify-content-end gap-2 bg-light">
            <a href="mailto:{{ $eleccion->winner->person->personal_email ?? '#' }}" 
               class="btn btn-sm btn-primary">
              <i class="far fa-envelope"></i> Contactar
            </a>
            @if($eleccion->winner->person->telephone1)
              <a href="https://wa.me/{{ $eleccion->winner->person->telephone1 }}" 
                 target="_blank" 
                 class="btn btn-sm btn-success">
                <i class="fab fa-whatsapp"></i> WhatsApp
              </a>
            @endif
          </div>
        @endif
      </div>
    </div>
  @endforeach
</div>


    <!-- /.row -->

    <!-- 🔹 CARRUSEL Y COMO VOTAR -->
    <div class="row">
    

      <!-- Como votar -->
      <div class="col-md-12 d-flex">
        <div class="card card-purple card-outline shadow w-100">
          <div class="card-header">
            <h3 class="card-title">Como votar</h3>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-8">
                <ol>
                  <li class="text-sm">Ingresar al link de elecciones 
                    <a href="http://siscefa.com/evs/votar" target="_blank">http://siscefa.com/evs/votar</a>
                  </li>
                  <li class="text-sm">Digitar su número de documento de identificación y código suministrado</li>
                  <li class="text-sm">Votar por el/la candidata de su preferencia</li>
                  <li class="text-sm">Diligenciar el link de asistencia</li>
                  <li class="text-sm">
                    Asistencia 
                    <a target="_blank" href="https://forms.office.com/Pages/ResponsePage.aspx?id=gcPCyy4vk02R0VBskxas52sNM4FDeylOhg4URln-zc9UNk5JNDVHWTlZWlBCNzVINU9VUDJYMFhUVS4u">clic aqui</a>
                  </li>
                </ol>
              </div>
              <div class="col-md-4">
                <img class="d-block w-100" src="{{ asset('modules/evs/images/LogoBienestarAprendiz.png') }}" alt="Logo Bienestar">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.row -->

  </div><!-- /.container-fluid -->
</div>
@stop
