@extends('evs::layouts.master')

@section('title','Candidates')

@section('breadcrumb')
<li class="breadcrumb-item active">
  <a href="{{ route('evs.admin.candidates') }}"><i class="fas fa-id-card-alt"></i> {{ __('Candidates') }}</a>
</li>
@endsection

@section('content')
    <!-- Main content -->
    <section class="content" >
      <div class="container-fluid">

		<div class="">
        <div class="card card-purple card-outline shadow">
          <div class="card-header">
            <h3 class="card-title">Candidatos</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
	  	<div class="row">
	      <div class="col-md-12">
	            <!-- The time line -->
	            <div class="timeline">
	              <div class="time-label">
	                <span class="bg-blue">Elecciones</span>
	              </div>
                
	              @forelse($candidates as $election)
	              <div>
	                <i class="fas fa-calendar-alt bg-green"></i>
	                <div class="timeline-item">
	                  <span class="time">
                        <i class="fas fa-clock"></i> 
                        {{ $election->start_date ?? '---' }} -> {{ $election->end_date ?? '---' }}
                      </span>
	                  <h3 class="timeline-header">{{ $election->name ?? 'Sin nombre' }}</h3>

	                  <div class="timeline-body row">
	                  	@forelse($election->candidates as $candidate)
                        <div class="col-md-3 d-flex align-items-stretch">
                            <div class="card card-purple card-outline shadow w-100">
                                <!-- Imagen uniforme -->
                                <div class="text-center mt-3">
                                    <img class="img-fluid rounded-circle"
                                        style="width:120px; height:120px; object-fit:cover; border:3px solid #6f42c1;"
                                        src="{{ $candidate->avatar ? asset($candidate->avatar) : asset('images/default-avatar.png') }}"
                                        alt="Foto Candidato">
                                </div>

                                <div class="card-body d-flex flex-column">
                                  
                                  <h5 class="profile-username text-center">
                                      {{ $candidate->person->first_name ?? '' }}
                                      {{ $candidate->person->first_last_name ?? '' }}
                                      {{ $candidate->person->second_last_name ?? '' }}
                                  </h5>
                                  
                                  <p class="text-muted text-center">
                                      {{ $candidate->person->apprentices[0]->course->program->name ?? 'No asignado' }}
                                  </p>

                                  <p class="text-muted text-center">{{ $candidate->number ?? '---' }}</p>
                                </div>
                                <div class="mbottom16 text-center">
                                 	@if(($election->status ?? '') == 'Activo')
                                    <a href="{{ url('evs/admin/candidates/edit/'.$candidate->id) }}" class="btn btn-warning btn-circle" title="Editar"><i class="fas fa-edit"></i></a>
                                  <a href="{{ route('evs.admin.candidates.delete', $candidate->id) }}"
                                    onclick="return confirm('¿Seguro que deseas eliminar este candidato?')"
                                    class="btn btn-danger btn-circle"
                                    title="Eliminar">
                                    <i class="fas fa-trash-alt"></i>
                                  </a>
                             		@endif
                                </div>
                             </div>
                        </div>
                        @empty
                          <div class="col-12 text-center text-muted">No hay candidatos registrados</div>
                        @endforelse
	                  </div>

	                  <div class="timeline-footer">
	                  	@if(($election->status ?? '') == 'Activo')
	                    <a class="btn btn-info btn-sm" href="{{ url('evs/admin/candidates/add/'.$election->id) }}">Agregar Candidato</a>
	                    @endif
	                  </div>
	                </div>
	              </div>
	              @empty
	                <div class="text-center text-muted">No hay elecciones registradas</div>
	              @endforelse
                
	              <div>
                    <i class="fas fa-clock bg-gray"></i>
                  </div>
            </div>
          </div>
        </div>
      </div>
          </div>
        </div>
      </div>
  </section>
@stop
