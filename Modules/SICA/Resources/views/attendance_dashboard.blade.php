@extends('sica::layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <h3>Registro histórico total</h3>
            <div class="mtop16">
                <a class="btn btn-app btn-app-2">
                    <span class="badge bg-info">{{ number_format($people, 0, ',', '.') }}</span>
                    <i class="fas fa-users"></i> Personas
                </a>
                <a class="btn btn-app  btn-app-2">
                    <span class="badge bg-info">{{ number_format($apprentices, 0, ',', '.') }}</span>
                    <i class="fas fa-user-graduate"></i> Aprendices
                </a>
                <a class="btn btn-app  btn-app-2">
                    <span class="badge bg-info">{{ number_format($events, 0, ',', '.') }}</span>
                    <i class="fas fa-calendar-check"></i> Eventos
                </a>
                <a class="btn btn-app btn-app-2">
                    <span class="badge bg-info">{{ number_format($courses, 0, ',', '.') }}</span>
                    <i class="fas fa-graduation-cap"></i> Cursos
                </a>
                <a class="btn btn-app btn-app-2">
                    <span class="badge bg-info">{{ number_format($environments, 0, ',', '.') }}</span>
                    <i class="fas fa-map-marked-alt"></i> Ambientes
                </a>
            </div>

            <h3>Asistencia a eventos</h3>
            <div class="mtop16">
                <div class="row">
                    @foreach ($eas as $a)
                        <div class="col-12">
                            <div class="card card-orange card-outline shadow">
                                <div class="card-header h5">
                                    Centro de Formación Agroindustrial - Evento: <strong>{{ $a->name }}</strong> ({{ $a->start_date }} - {{ $a->end_date }})
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        @foreach ($a->attendance as $at)
                                            <div class="col-md-2">
                                                <div class="info-box mb-3 bg-info">
                                                    <span class="info-box-icon">
                                                      <i class="fa-solid fa-calendar-days"></i>
                                                    </span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text">{{ $at->date }}</span>
                                                        <span class="info-box-number">
                                                            {{ $at->total }}
                                                            <i class="fa-regular fa-user"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="col-md-2">
                                            <div class="info-box mb-3 bg-success">
                                                <span class="info-box-icon">
                                                    <i class="fa-regular fa-calendar-check"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Evento</span>
                                                    <span class="info-box-number">
                                                        {{ $a->total }}
                                                        <i class="fa-regular fa-user"></i>
                                                    </span>
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
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        @foreach ($eas as $a)
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
                        @foreach ($a->rage as $r)
                            ['{{ $r->document_type }}', {{ $r->val }}],
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
                        @foreach ($a->pop as $p)
                            ['{{ $p->name }}', {{ $p->val }}],
                        @endforeach
                    ]
                }]
            });
        @endforeach
    </script>
@endsection
