
@extends('evs::layouts.master')

@section('title','Resultados de votación')

@section('breadcrumb')
<li class="breadcrumb-item active">
  <a href="{{ route('cefa.evs.voto.resultados') }}"><i class="fas fa-chart-bar"></i> {{ __('Voting results') }}</a>
</li>
@endsection

@section('content')
    <!-- Main content -->
    <div class="content">

      <div class="container-fluid">


      <div class="row">
        <div class="col-md-12">
              <!-- The time line -->
              <div class="timeline">
                <!-- timeline time label -->
                <div class="time-label">
                  <span class="bg-purple">Elecciones</span>
                </div>
                <!-- /.timeline-label -->
                <!-- timeline item -->
                
                
                @foreach($dataelecciones as $election)

                <div>
                  <i class="fas fa-calendar-alt {{ ($election->status == 'Activo') ? 'bg-green' : 'bg-red'}}"></i>
                  <div class="timeline-item">
                    <span class="time {{ ($election->status == 'Activo') ? 'text-green' : 'text-red'}}"><i class="fas fa-clock"></i> {{ $election->start_date." -> ".$election->end_date }} </span>
                    <h3 class="timeline-header">{{ $election->name }}</h3>
                    <div class="timeline-body row">

        <div class="row col-md-12 p-3">

          <div class="col-md-7">
            <!-- Bar chart -->

            <div class="card card-purple card-outline shadow">
              <div class="card-header">
                <h3 class="card-title">Resultados <spam class="text-muted text-xs">- Disponible al finalizar la jornada</spam></h3>

              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="barChart{{ $election->id }}" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
            </div>
        </div>

        <div class="col-md-5">
                <div class="card card-purple card-outline shadow">
                <div class="card-header text-muted border-bottom-0">
                  Candidato elegido
                </div>
                <div class="card-body pt-0">

                  @if(isset($election->electeds[0]))

                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>{{ $election->electeds[0]['candidate']->person->first_name. " " .$election->electeds[0]['candidate']->person->first_last_name. " " .$election->electeds[0]['candidate']->person->second_last_name }}</b></h2>
                      <p class="text-muted text-sm"><b>{{ $election->electeds[0]['job'] }}</b>  </p>
                      <p class="text-muted text-sm"><b>Votos: {{ $election->electeds[0]['votes'] }}</b></p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="far fa-envelope"></i></span> {{ $election->electeds[0]['email'] }}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-phone"></i></span> Phone #: {{ $election->electeds[0]['telephone'] }}</li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="{{ asset('storage/'.$election->electeds[0]['candidate']->avatar) }}" alt="" class="img-circle img-fluid">
                    </div>
                  </div>

                  @else
                    <h2 class="lead"><b>Candidato aun no publicado</b></h2>

                  @endif

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


      </div>
      <div class="row col-md-12 p-3">


          <div class="col-md-12">
            <div class="card card-purple card-outline shadow">
              <div class="card-header">
                <h3 class="card-title">
                  Candidatos a {{ $election->name }}
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
                  <div class="row justify-content-md-center">
                    @foreach($election->candidates as $candidate)
                    <div class="col-md-2">
                      <div class="card shadow">
                        <div class="card-body ">
                          <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                 src="{{ asset('storage/'.$candidate->avatar) }}"
                                 alt="User profile picture">
                          </div>
                          <h3 class="profile-username text-center text-sm">{{ $candidate->person->first_name." ".$candidate->person->first_last_name." ".$candidate->person->second_last_name }}</h3>
                          <p class="text-muted text-center text-sm"></p>
                        </div>
                        <div class="">
                            <ul class="list-group">
                              <li class="list-group-item">
                                <b>Numero</b> <a href="#" class="btn btn-outline-primary float-right"><b>{{ $candidate->number }}</b></a>
                              </li>
                            </ul>
                        </div>
                      </div>
                    </div>
                    @endforeach

                  
                </div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>

        </div>
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


        <!-- /.row -->
      </div><!-- /.container-fluid -->
    <!-- /.content -->
  </div>

<script src="{{ asset('AdminLTE/plugins/chart.js/Chart.min.js') }}"></script>

<!-- page script -->
<script>
$(document).ready(function(){

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false,
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
          }
        }],
      }
    }


@foreach($dataelecciones as $election)
     
    var areaChartData{{ $election->id }} = {
      labels  : [
      @foreach($election->candidates as $candidate)
        '{{ $candidate->person->first_name }}',
      @endforeach
      'VOTO EN BLANCO',
      ],
      datasets: [
        {
          label               : 'Numero de votos',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [
            
        @php
        $ffin = $election->end_date;
        date_default_timezone_set('America/Bogota');
        $factual = date("Y-m-d H:i:s");
        @endphp
        @if($factual>$ffin)
              @foreach($election->candidates as $candidate)
                {{ count($candidate->votes) }},
              @endforeach
              {{ $election->votes_count }},            
        @endif
        

          ]
        },
      ]
    }

    var barChartCanvas{{ $election->id }} = $('#barChart{{ $election->id }}').get(0).getContext('2d')
    var barChartData{{ $election->id }} = jQuery.extend(true, {}, areaChartData{{ $election->id }})
    var temp0{{ $election->id }} = areaChartData{{ $election->id }}.datasets[0]

    barChartData{{ $election->id }}.datasets[0] = temp0{{ $election->id }}     

    var barChart{{ $election->id }} = new Chart(barChartCanvas{{ $election->id }}, {
      type: 'bar', 
      data: barChartData{{ $election->id }},
      options: barChartOptions
    })


@endforeach






})

</script>

@stop