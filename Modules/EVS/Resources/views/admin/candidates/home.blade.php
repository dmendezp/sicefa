
@extends('evs::layouts.master')

@section('title','Candidates')

@section('breadcrumb')
<li class="breadcrumb-item active">
  <a href="{{ route('evs.admin.candidates') }}"><i class="fas fa-id-card-alt"></i> {{ __('Candidates') }}</a>
</li>
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

		<div class="">
        <div class="card card-purple card-outline shadow">
          <div class="card-header">
            <h3 class="card-title">Candidatos</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
          <!-- Timelime example  -->

	        <!-- Timelime example  -->
	  	<div class="row">
	  <div class="col-md-12">
	            <!-- The time line -->
	            <div class="timeline">
	              <!-- timeline time label -->
	              <div class="time-label">
	                <span class="bg-blue">Elecciones</span>
	              </div>
	              <!-- /.timeline-label -->
	              <!-- timeline item -->
                
	              @foreach($candidates as $election)

	              <div>
	                <i class="fas fa-calendar-alt bg-green"></i>
	                <div class="timeline-item">
	                  <span class="time"><i class="fas fa-clock"></i> {{ $election->start_date." -> ".$election->end_date }} </span>
	                  <h3 class="timeline-header">{{ $election->name }}</h3>

	                  <div class="timeline-body row">
	                  	@foreach($election->candidates as $candidate)
	                  	<div class="col-md-3">
	                  	    <div class="card card-purple card-outline shadow">
                                <img class="profile-user-img mtop16"
                                   src="{{ asset('storage/'.$candidate->avatar) }}"
                                   alt="User profile picture">
                                  <div class="card-body box-profile">
                                  
                                  <h5 class="profile-username text-center">{{ $candidate->person->first_name." ".$candidate->person->first_last_name." ".$candidate->person->second_last_name }}</h5>
                                  <p class="text-muted text-center">Titulacion</p>
                                  <p class="text-muted text-center">{{ $candidate->number }}</p>
                                </div>
                                <div class="mbottom16 text-center">
                                 	@if($election->status=='Activo')
                                    <a href="{{ url('evs/admin/candidates/edit/'.$candidate->id) }}" class="btn btn-warning btn-circle" title="Editar"><i class="fas fa-edit"></i></a>
                                    <a class="btn btn-danger btn-circle btn-delete" href="#" data-action="delete" data-toggle='tooltip' data-placement="top" data-object="{{ $candidate->id }}" data-path="evs/admin/candidates" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                             		@endif
                                </div>
                             </div>
                        </div>
                        @endforeach
	                  </div>
	                  <div class="timeline-footer">
	                  	@if($election->status=='Activo')
	                    <a class="btn btn-info btn-sm" href="{{ url('evs/admin/candidates/add/'.$election->id) }}">Agregar Candidato</a>
	                    @endif
	                  </div>
	                </div>
	              </div>
	              @endforeach
                
	              <!-- END timeline item -->
              <div>
                <i class="fas fa-clock bg-gray"></i>
              </div>
            </div>
          </div>
          <!-- /.col -->
        </div>
      </div>
      <!-- /.timeline -->




          </div>
        </div>
      </div>


      </div>



  </section>


@stop