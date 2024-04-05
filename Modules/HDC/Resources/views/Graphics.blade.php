@extends('hdc::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('hdc::Graficas.Graphics') }}</li>
@endpush

@section('content')
    <div class="card card-green card-outline shadow" style="border: 6px solid #1FA247;">
        <div class="row col-12">
            <div class="card-body">
                <h2 class="text-center">{{ trans('hdc::Graficas.Carbon_Footprint_Graphics') }}</h2>
                <hr>
                <div class="row">
                    <div class="col-6">
                        <!-- Contenedor para el gráfico -->
                        <figure class="highcharts-figure">
                            <div id="container1"></div>
                            <p class="highcharts-description" style="text-align: center;">
                                <span
                                    style="background-color: rgba(42, 157, 143, 0.7); border-radius: 50%; display: inline-block; height: 15px; width: 15px; margin-right: 5px;"></span>
                                Huella de Carbono Generada
                            </p>
                        </figure>
                    </div>
                    <div class="col-6">
                        <!-- Contenedor para el gráfico -->
                        <figure class="highcharts-figure">
                            <div id="container"></div>
                            <p class="highcharts-description" style="text-align: center;">
                                <span
                                    style="background-color: rgba(42, 157, 143, 0.7); border-radius: 50%; display: inline-block; height: 15px; width: 15px; margin-right: 5px;"></span>
                                Huella de Carbono Generada
                            </p>
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>

    @push('scripts')

    <script type="text/javascript">
        // Datos dinámicos para Highcharts
        var chartData = <?php echo json_encode($chartData); ?>;

        Highcharts.chart('container1', {
            title: {
                text: 'Huella de Carbono Mensual',
                align: 'center'
            },
            yAxis: {
                title: {
                    text: 'Huella de Carbono'
                }
            },
            xAxis: {
                categories: [
                    @for ($i = 1; $i <= 12; $i++)
                        '{{ trans("hdc::ConsumptionRegistry.month$i") }}'@if ($i < 12),@endif
                    @endfor
                ],
                accessibility: {
                    description: ''
                }
            },
            plotOptions: {
                series: {
                    connectNulls: true // Esto permite conectar líneas a través de valores nulos
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },
            series: chartData,
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });

    </script>


        <script type="text/javascript">
            // Tu PHP data aquí
            var data = <?php echo json_encode($aspectosAmbientales); ?>;

            // Organizar los datos por sector
            var sectorsData = {};

            // Obtener la lista completa de sectores (sin duplicados)
            var allSectors = [...new Set(data.map(aspecto => aspecto.sector_name))];

            // Inicializar los datos para todos los sectores
            allSectors.forEach(function(sectorName) {
                sectorsData[sectorName] = [];
            });

            // Llenar los datos de las unidades productivas para cada sector
            data.forEach(function(aspecto) {
                var sectorName = aspecto.sector_name;
                var carbonFootprint = parseFloat(aspecto.carbon_footprint) || 0;

                // Manejar el caso de valores nulos o no definidos
                sectorsData[sectorName].push({
                    name: aspecto.productive_unit_name,
                    y: carbonFootprint,
                    sector: sectorName
                });
            });

            // Crear la serie con los totales por sector
            var seriesData = Object.keys(sectorsData).map(function(sectorName) {
                return {
                    name: sectorName,
                    y: sectorsData[sectorName].reduce(function(total, aspecto) {
                        return total + aspecto.y;
                    }, 0),
                    drilldown: sectorName,
                    sector: sectorName
                };
            });

            // Crear la serie de drilldown
            var drilldownSeries = Object.keys(sectorsData).map(function(sectorName) {
                return {
                    name: sectorName,
                    id: sectorName,
                    data: sectorsData[sectorName]
                };
            });

            // Variable para almacenar el título del gráfico
            var chartTitle = 'Huella de Carbono Anual';
            var tituloGrafico = ''; // Inicialmente, el título es 'Sectores'

            // Inicializar el gráfico de Highcharts
            var chart = Highcharts.chart('container', {
                chart: {
                    type: 'column',
                    events: {
                        drilldown: function(event) {
                            if (event.point && event.point.category) {
                                var sectorClickeado = event.point.category;
                            }
                        }
                    }
                },
                title: {
                    align: 'center',
                    text: chartTitle
                },
                accessibility: {
                    announceNewData: {
                        enabled: true
                    }
                },
                xAxis: {
                    type: 'category',
                    title: {
                        text: tituloGrafico,
                    },
                    labels: {
                        formatter: function() {
                            return this.value;
                        }
                    }
                },
                yAxis: {
                    title: {
                        text: 'Huella de Carbono'
                    }
                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    column: {
                        dataLabels: {
                            enabled: true,
                            format: '<span style="color:black; text-decoration: none !important;">{point.y:.5f}</span>', // Ajusta el número de decimales aquí
                        }
                    }
                },
                tooltip: {
                    formatter: function() {
                        if (this.point.sector) {
                            return '<span style="font-size:11px">' + this.point.name + '</span><br>' +
                                '<span style="color:black">Sector</span>: ' + this.point.sector + '<br>' +
                                '<span style="color:black">Carbon Footprint</span>: <b>' + Highcharts.numberFormat(
                                    this.point.y, 5, '.', ',') + '</b>'; // Ajusta el número de decimales aquí
                        }
                    }
                },
                series: [{
                    name: 'Sectores',
                    colorByPoint: false,
                    data: seriesData,
                    drilldown: {
                        series: drilldownSeries
                    }
                }],
                drilldown: {
                    series: drilldownSeries,
                    activeDataLabelStyle: {
                        textDecoration: 'none !important;',
                        color: 'black'
                    },
                    activeAxisLabelStyle: {
                        textDecoration: 'none !important;',
                        color: 'black'
                    }
                }
            });
        </script>
    @endpush
@endsection
