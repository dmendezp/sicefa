@extends('sica::layouts.master')

@section('content')

<div class="content">
  <div class="container-fluid">

    <h3>Registros</h3>
    <div class="mtop16">
      <a class="btn btn-app btn-app-2">
        <span class="badge bg-info">{{ number_format($people,0,",",".") }}</span>
        <i class="fas fa-users"></i> Personas
      </a>
      <a class="btn btn-app  btn-app-2">
        <span class="badge bg-info">{{ number_format($apprentices,0,",",".") }}</span>
        <i class="fas fa-user-graduate"></i> Aprendices
      </a>
      <a class="btn btn-app  btn-app-2">
        <span class="badge bg-info">0</span>
        <i class="fas fa-chalkboard-teacher"></i> Instructores
      </a>
      <a class="btn btn-app btn-app-2">
        <span class="badge bg-info">0</span>
        <i class="fas fa-user-tie"></i> Administrativos
      </a>
      <a class="btn btn-app btn-app-2">
        <span class="badge bg-info"></span>
        <i class="fas fa-graduation-cap"></i> Cursos
      </a>
      <a class="btn btn-app btn-app-2">
        <span class="badge bg-info">0</span>
        <i class="fas fa-map-marked-alt"></i> Ambientes
      </a>

    </div>

    <h3>Resumen</h3>
    <div class="mtop16">
    {{ $attendance }} 
      <p>Tablas o graficas por evento, tipo persona, población</p>
     
      
     
      <div class="row">
     @foreach($attendance as $a)
     <a class="btn btn-app  btn-app-2">
        <span class="badge bg-info">{{ $a->total }}</span>
        <i class="fas fa-user-graduate"></i> Asistentes - {{$a->event}} <br>{{$a->date}}
      </a>


      
          <div class="col-4">
                <div class="card card-orange card-outline shadow">
                <div class="card-header text-muted border-bottom-0">
                  Centro de formación Agroindustrial
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>Nombre del evento</b></h2>
                      <p class="text-muted text-sm"><b> </b>  </p>
                      <br>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        </span> Descripción</li>
                        
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="http://localhost/expo/sicefa/public/evs/images/photos/shares/evs/blanco.png" alt="" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <a href="#" class="small ">
                      estadísticas de participación
                    </a>
                    
                  </div>
                </div>
              </div>
            </div>
            
      
     


     @endforeach

     </div>


    </div>
  </div>
</div>
@endsection
