
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

          <div class="col-md-7">
            <!-- Bar chart -->

            <div class="card card-purple card-outline shadow">
              <div class="card-header">
                <h3 class="card-title">Resultados {{ $dataelecciones->name }} <spam class="text-muted text-xs">- Disponible al finalizar la jornada</spam></h3>

              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
            </div>
        </div>
        <div class="col-md-5 d-flex">
                <div class="card card-purple card-outline shadow">
                <div class="card-header text-muted border-bottom-0">
                  {{ $elected[0]->candidate->election->name }}
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>{{ $elected[0]->candidate->person->first_name." ".$elected[0]->candidate->person->first_last_name." ".$elected[0]->candidate->person->second_last_name }}</b></h2>
                      <p class="text-muted text-sm"><b>{{ $elected[0]->program }} </b>  </p>
                      <p class="text-muted text-sm"><b>Votos: </b>{{ $elected[0]->votes }} </p>
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
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card card-purple card-outline shadow">
              <div class="card-header">
                <h3 class="card-title">
                  Candidatos a {{ $dataelecciones->name }}
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row justify-content-md-center">
                  <div class="row justify-content-md-center">
                    @foreach($dataelecciones->candidates as $candidate)
                    <div class="col-md-3 d-flex">
                      <div class="card shadow">
                        <div class="card-body box-profile">
                          <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                 src="{{ asset('evs/images/'.$candidate->avatar) }}"
                                 alt="User profile picture">
                          </div>
                          <h3 class="profile-username text-center text-sm">{{ $candidate->person->first_name." ".$candidate->person->first_last_name." ".$candidate->person->second_last_name }}</h3>
                          <p class="text-muted text-center text-sm">{{ $candidate->person->apprentices[0]->course->program->program_type." en ".$candidate->person->apprentices[0]->course->program->name." - ".$candidate->person->apprentices[0]->course->code }}</p>
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
                    <div class="col-md-3 d-flex">
                      <div class="card shadow">
                        <div class="card-body box-profile">
                          <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                 src="{{ asset('evs/images/blanco1.png') }}"
                                 alt="User profile picture">
                          </div>
                          <h3 class="profile-username text-center text-sm">Voto en Blanco</h3>
                          <p class="text-muted text-center text-sm"> ------------ No aplica -----------</p>
                        </div>
                        <div class="">
                            <ul class="list-group">
                              <li class="list-group-item">
                                <b>Numero</b> <a href="#" class="btn btn-outline-primary float-right"><b>00</b></a>
                              </li>
                            </ul>
                        </div>
                      </div>
                    </div>
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
{{ $mostrar }}
<script src="{{ asset('AdminLTE/plugins/chart.js/Chart.min.js') }}"></script>

<!-- page script -->
<script>
$(document).ready(function(){
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */
// Get context with jQuery - using jQuery's .get() method.

    var areaChartData = {
      labels  : [
      @foreach($dataelecciones->candidates as $candidate)
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
            @if($mostrar==true) 
              @foreach($dataelecciones->candidates as $candidate)
                {{ count($candidate->votes) }},
              @endforeach
              {{ $blanco }},
            @endif
          ]
        },
      ]
    }



    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = jQuery.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]

    barChartData.datasets[0] = temp0


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

    var barChart = new Chart(barChartCanvas, {
      type: 'bar', 
      data: barChartData,
      options: barChartOptions
    })


  })
</script>

@stop