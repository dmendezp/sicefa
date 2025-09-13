@extends('evs::layouts.master')

@section('title','Resultados de votación')

@section('breadcrumb')
<li class="breadcrumb-item active">
  <a href="{{ route('cefa.evs.voto.resultados') }}">
    <i class="fas fa-chart-bar"></i> {{ __('Voting results') }}
  </a>
</li>
@endsection

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="timeline">
          <div class="time-label">
            <span class="bg-purple">Elecciones</span>
          </div>

          @foreach($dataelecciones as $election)
          <div>
            <i class="fas fa-calendar-alt {{ ($election->status == 'Activo') ? 'bg-green' : 'bg-red'}}"></i>
            <div class="timeline-item">
              <span class="time {{ ($election->status == 'Activo') ? 'text-green' : 'text-red'}}">
                <i class="fas fa-clock"></i> {{ $election->start_date." -> ".$election->end_date }}
              </span>
              <h3 class="timeline-header">{{ $election->name }}</h3>

              <div class="timeline-body row">
                <div class="row col-md-12">
                  <div class="col-md-7">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Resultados <span class="text-muted text-xs">- Disponible al finalizar la jornada</span></h3>
                      </div>
                      <div class="card-body">
                        <canvas id="barChart{{ $election->id }}" style="height:250px; max-width:100%;"></canvas>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-5">
                    <div class="card">
                      <div class="card-header">
                        Candidato elegido
                      </div>
                      <div class="card-body">
                        @if(isset($election->electeds[0]))
                        <div class="row">
                          <div class="col-7">
                            <h2 class="lead">
                              <b>{{ $election->electeds[0]['candidate']->person->first_name." ".$election->electeds[0]['candidate']->person->first_last_name." ".$election->electeds[0]['candidate']->person->second_last_name }}</b>
                            </h2>
                            <p><b>{{ $election->electeds[0]['job'] }}</b></p>
                            <p><b>Votos: {{ $election->electeds[0]['votes'] }}</b></p>
                            <ul class="ml-4 mb-0 fa-ul">
                              <li class="small"><i class="far fa-envelope"></i> {{ $election->electeds[0]['email'] }}</li>
                              <li class="small"><i class="fas fa-phone"></i> {{ $election->electeds[0]['telephone'] }}</li>
                            </ul>
                          </div>
                          <div class="col-5 text-center">
                            <img src="{{ asset($election->electeds[0]['candidate']->avatar) }}" class="img-circle img-fluid">
                          </div>
                        </div>
                        @else
                          <h2 class="lead"><b>Candidato aun no publicado</b></h2>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row col-md-12 mt-3">
                  <div class="col-md-12">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Candidatos a {{ $election->name }}</h3>
                      </div>
                      <div class="card-body">
                        <div class="row">
                          @foreach($election->candidates as $candidate)
                          <div class="col-lg-3 col-md-4 col-sm-6 d-flex">
                            <div class="card w-100 h-100 d-flex flex-column">
                              <div class="card-body text-center flex-grow-1">
                                <img src="{{ asset($candidate->avatar) }}" class="img-circle img-fluid mb-2" style="width:110px; height:110px; object-fit:cover;">
                                <h6>
                                  {{ $candidate->person->first_name." ".$candidate->person->first_last_name." ".$candidate->person->second_last_name }}
                                </h6>
                                <p class="small">
                                  @if(isset($candidate->person->apprentices[0]))
                                    {{ $candidate->person->apprentices[0]->course->program->name }}
                                  @else
                                    <em>Sin titulación registrada</em>
                                  @endif
                                </p>
                              </div>
                              <div class="card-footer text-center">
                                <span><b>Número:</b> {{ $candidate->number }}</span>
                              </div>
                            </div>
                          </div>
                          @endforeach
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
          @endforeach

          <div>
            <i class="fas fa-clock bg-gray"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="{{ asset('AdminLTE/plugins/chart.js/Chart.min.js') }}"></script>
<script>
$(function(){
  var barChartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    scales: { yAxes: [{ ticks: { beginAtZero: true } }] }
  }

  @foreach($dataelecciones as $election)
  var areaChartData{{ $election->id }} = {
    labels: [
      @foreach($election->candidates as $candidate)
        '{{ $candidate->person->first_name }}',
      @endforeach
      'VOTO EN BLANCO',
    ],
    datasets: [{
      label: 'Número de votos',
      backgroundColor: 'rgba(60,141,188,0.9)',
      borderColor: 'rgba(60,141,188,0.8)',
      data: [
        @foreach($election->candidates as $candidate)
          {{ count($candidate->votes) }},
        @endforeach
        {{ $election->votes_count }},
      ]
    }]
  }

  var ctx = $('#barChart{{ $election->id }}').get(0).getContext('2d')
  new Chart(ctx, { type: 'bar', data: areaChartData{{ $election->id }}, options: barChartOptions })
  @endforeach
})
</script>
@stop
