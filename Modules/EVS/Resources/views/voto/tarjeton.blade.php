
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
        <div class="d-flex justify-content-start">
          <div class="p-3 mb-2 bg-info text-dark">Votante: {{ $people[0]->first_name." ".$people[0]->first_last_name." ".$people[0]->second_last_name }}</div>
        </div>
        {!! Form::open(['url' => route('cefa.evs.voto.votar.registrar')]) !!}
        {!! Form::hidden('election_id', $dataelecciones[0]->id, ['class' => 'form-control']) !!}
        {!! Form::hidden('authorized_id', $people[0]->authorizeds[0]->id, ['class' => 'form-control']) !!}

        @foreach($dataelecciones as $election)
              <p class="h3 text-center">Candidatos a {{ $election->name }}</p>   
             <div class="row justify-content-md-center">


            @foreach($election->candidates as $candidate)

    			<div class="col-md-3 d-md-flex align-self-stretch">
                <div class="flex-fill card card-purple card-outline shadow">
                  <div class="card-body box-profile">
                    <div class="text-center">
                      <img class="user-img img-fluid"
                           src="{{ asset('storage/'.$candidate->avatar) }}">
                    </div>
                    <h3 class="profile-username text-center">{{ $candidate->person->first_name." ".$candidate->person->first_last_name." ".$candidate->person->second_last_name }}</h3>

                    <p class="text-muted text-center">{{ $candidate->person->apprentices[0]->course->program->program_type." en ".$candidate->person->apprentices[0]->course->program->name." - ".$candidate->person->apprentices[0]->course->code }}</p>
                    

                  </div>
                  <div class="card-footer">
                    <p class="h1 text-muted text-center">{{ $candidate->number }}</p>
                  <div class="d-flex justify-content-center">
                    <ul class="list-group list-group-unbordered mb-3">
                      <li class="list-group-item">
                        {{ Form::button('SELECCIONAR', array('class' => 'btn btn-outline-info font-weight-bold', 'type' => 'submit', 'name' =>'candidate_id', 'value' => $candidate->id)) }}
                      </li>
                    </ul>
                  </div> 
                  </div>

                </div>
    			</div>

            @endforeach
       

    			<div class="col-md-3 d-md-flex align-self-stretch">
                <div class="flex-fill card card-purple card-outline shadow">
                  <div class="card-body box-profile">
                    <div class="text-center">
                      <img class="user-img img-fluid"
                           src="{{ asset('evs/images/blanco1.png') }}">
                    </div>
                    <h3 class="profile-username text-center">Voto en Blanco</h3>
                    <p class="text-muted text-center">-</p>
                  </div>
                  <div class="card-footer">
                  <p class="h1 text-muted text-center">-</p>
                  <div class="d-flex justify-content-center">
                    <ul class="list-group list-group-unbordered mb-3">
                      <li class="list-group-item">
                        {{ Form::button('SELECCIONAR', array('class' => 'btn btn-outline-info font-weight-bold', 'type' => 'submit', 'name' =>'candidate_id', 'value' => '0')) }}
                      </li>
                    </ul>
                  </div> 
                  </div>
                </div>
    			</div>

        </div>
         @endforeach

         {!! Form::close() !!}
        <!-- /.row -->

      </div><!-- /.container-fluid -->
    <!-- /.content -->
  </div>

@stop