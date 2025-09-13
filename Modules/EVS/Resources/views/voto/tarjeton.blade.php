@extends('evs::layouts.master')

@section('title','Desarrolladores')

@section('breadcrumb')
<li class="breadcrumb-item active">
  <a href="{{ route('cefa.evs.voto.votar') }}"><i class="fas fa-vote-yea"></i> Votar</a>
</li>
<li class="breadcrumb-item active">
  <a href="{{ route('cefa.evs.voto.tarjeton') }}"><i class="fas fa-th-large"></i> Tarjeton</a>
</li>
@endsection

@section('content')
<!-- Main content -->
<div class="content">
  <div class="container-fluid">

    <!-- Datos del votante -->
    <div class="d-flex justify-content-start">
      <div class="p-3 mb-2 bg-info text-dark">
        Votante: 
        {{ $people[0]->first_name ?? '-' }}
        {{ $people[0]->first_last_name ?? '-' }}
        {{ $people[0]->second_last_name ?? '-' }}
      </div>
    </div>

    {!! Form::open(['url' => route('cefa.evs.voto.votar.registrar')]) !!}
    {!! Form::hidden('election_id', $dataelecciones[0]->id ?? '', ['class' => 'form-control']) !!}
    {!! Form::hidden('authorized_id', $people[0]->authorizeds[0]->id ?? '', ['class' => 'form-control']) !!}

    @foreach($dataelecciones ?? [] as $election)
      <p class="h3 text-center mb-4">Candidatos a {{ $election->name ?? '-' }}</p>   
      
      <div class="row justify-content-md-center">
        @foreach($election->candidates ?? [] as $candidate)
          <div class="col-md-3 d-md-flex align-self-stretch">
            <div class="flex-fill card card-purple card-outline shadow h-100">
              
              <div class="card-body box-profile text-center">
                <!-- Foto del candidato -->
                <img class="user-img img-fluid rounded mb-3"
                     src="{{ asset($candidate->avatar ?? 'modules/evs/images/default.png') }}"
                     style="width: 100%; max-height: 200px; object-fit: contain; background: #fff; padding: 5px;">
                
                <!-- Nombre -->
                <h5 class="profile-username text-dark fw-bold">
                  {{ $candidate->person->first_name ?? '-' }}
                  {{ $candidate->person->first_last_name ?? '-' }}
                  {{ $candidate->person->second_last_name ?? '-' }}
                </h5>

                <!-- Titulación -->
                <p class="text-muted small">
                  {{ optional(optional(optional($candidate->person->apprentices[0] ?? null)->course)->program)->program_type ?? '-' }}
                  {{ isset($candidate->person->apprentices[0]) ? 'en ' . $candidate->person->apprentices[0]->course->program->name : '-' }}
                  {{ isset($candidate->person->apprentices[0]) ? '- '.$candidate->person->apprentices[0]->course->code : '-' }}
                </p>
              </div>

              <!-- Número y botón -->
              <div class="card-footer bg-light border-top text-center">
                <p class="h4 text-muted">{{ $candidate->number ?? '-' }}</p>
                {{ Form::button('SELECCIONAR', [
                    'class' => 'btn btn-outline-info font-weight-bold',
                    'type' => 'submit',
                    'name' =>'candidate_id',
                    'value' => $candidate->id ?? 0
                ]) }}
              </div>
            </div>
          </div>
        @endforeach

        <!-- Tarjeta de Voto en Blanco -->
        <div class="col-md-3 d-md-flex align-self-stretch">
          <div class="flex-fill card card-purple card-outline shadow h-100">
            <div class="card-body box-profile text-center">
              <img class="user-img img-fluid rounded mb-3"
                   src="{{ asset('modules/evs/images/blanco1.png') }}"
                   style="width: 100%; max-height: 200px; object-fit: contain; background: #fff; padding: 5px;">
              <h5 class="profile-username text-dark fw-bold">Voto en Blanco</h5>
              <p class="text-muted small">-</p>
            </div>
            <div class="card-footer bg-light border-top text-center">
              <p class="h4 text-muted">-</p>
              {{ Form::button('SELECCIONAR', [
                  'class' => 'btn btn-outline-info font-weight-bold',
                  'type' => 'submit',
                  'name' =>'candidate_id',
                  'value' => '0'
              ]) }}
            </div>
          </div>
        </div>

      </div>
    @endforeach

    {!! Form::close() !!}

  </div>
</div>
@stop
