@extends('sica::layouts.master')

@section('content')

<div class="content">
  <div class="container-fluid">

    <h3>Registro histórico total</h3>
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
<<<<<<< HEAD
        <span class="badge bg-info">{{ number_format($event,0,",",".") }}</span>
        <i class="fa-regular fa-calendar-check"></i> Eventos
=======
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
>>>>>>> f3988bec51fa25b1d4a064c75a64deb172f633a8
      </a>

    </div>

    <h3>Asistencia a eventos</h3>

    <div class="mtop16">
<<<<<<< HEAD
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


=======
<<<<<<< HEAD
      <div class="row">
     @foreach($eas as $a)
      
          <div class="col-12">
            <div class="card card-orange card-outline shadow">
              <div class="card-header h5">
              Centro de formación Agroindustrial - <b class="h4">{{ $a->name }}</b>
              </div>
              <div class="card-body">
                <div class="row">   
                @foreach($a->attendance as $at)
                  <div class="col-md-2">
                    <div class="info-box mb-3 bg-info">
                      <span class="info-box-icon"><i class="fa-solid fa-calendar-days"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">{{ $at->date }}</span>
                        <span class="info-box-number">{{ $at->total }} <i class="fa-regular fa-user"></i></span>
                      </div>
                    </div>
                  </div>
                @endforeach
                  <div class="col-md-2">
                    <div class="info-box mb-3 bg-success">
                      <span class="info-box-icon"><i class="fa-regular fa-calendar-check"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Evento</span>
                        <span class="info-box-number">{{ $a->total }} <i class="fa-regular fa-user"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6 p-0 m-0">
                      <figure class="highcharts-figure">
                      <div id="rage{{ $loop->iteration }}"></div>
                      </figure>
                    </div>
                    <div class="col-md-6 p-0 m-0">
                      <figure class="highcharts-figure">
                      <div id="pop{{ $loop->iteration }}"></div>
                      </figure>
                    </div>
                </div>
              </div>
              <div class="card-footer">
                <div class="text-right">
                  <span class="small ">
                    Estadísticas de participación
                  </span>
                  
                </div>
              </div>
            </div>
          </div>
            
     @endforeach

     </div>
=======
      <p>Tablas o graficas por evento, tipo persona, población</p>
      {{ $attendance }}
>>>>>>> f3988bec51fa25b1d4a064c75a64deb172f633a8
>>>>>>> e70fa6db5c7880216b279cab69538183e1c4e441
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
  @foreach($eas as $a)
  Highcharts.chart('rage{{ $loop->iteration }}', {
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45,
            beta: 0
        }
    },
    title: {
        text: 'Asistentes por tipo de documento'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b> de {series.total}'
    },
    plotOptions: { 
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            depth: 35,
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.y}'
            }
        }
    },
    series: [{
        type: 'pie',
        name: 'Cantidad',
        data: [
          @foreach($a->rage as $r)
            ['{{$r->document_type}}', {{$r->val}}],
          @endforeach
        ]
    }]
  });

  Highcharts.chart('pop{{ $loop->iteration }}', {
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45,
            beta: 0
        }
    },
    title: {
        text: 'Asistentes por grupo poblacional'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            depth: 35,
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.y}'
            }
        }
    },
    series: [{
        type: 'pie',
        name: 'Cantidad',
        data: [
          @foreach($a->pop as $p)
            ['{{$p->name}}', {{$p->val}}],
          @endforeach
        ]
    }]
  });
  @endforeach


</script>
@endsection
