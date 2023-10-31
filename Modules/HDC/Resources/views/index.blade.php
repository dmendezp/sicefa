@extends('hdc::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('hdc::hdcgeneral.Indicator_Homepage') }}</li>
@endpush

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="text-center">{{ trans('hdc::hdcgeneral.title1') }}</h2>
            <h4 class="text-center">{{ trans('hdc::hdcgeneral.caption1') }}</h4>
            <hr>
            <div class="row">
                <div class="col-6">
                    <h3>{{ trans('hdc::hdcgeneral.title2') }}</h3>
                    <p>{{ trans('hdc::hdcgeneral.text1') }}</p>
                    <br><br><br>
                    <h3>{{ trans('hdc::hdcgeneral.title3') }}</h3>
                    <p>{{ trans('hdc::hdcgeneral.text2') }}</p>
                </div>
                <div class="col-6">
                    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active" data-bs-interval="3000">
                                <img src="{{ asset('modules/HDC/img/fish.jpg') }}" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item" data-bs-interval="3000">
                                <img src="{{ asset('modules/HDC/img/plants.jpg') }}" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item" data-bs-interval="3000">
                                <img src="{{ asset('modules/HDC/img/ganado.jpg') }}" class="d-block w-100" alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h3>{{ trans('hdc::hdcgeneral.title4') }}</h3>
                    <div id="container"></div>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h3>{{ trans('hdc::hdcgeneral.title5') }}</h3>
                    <p>{{ trans('hdc::hdcgeneral.text3') }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
<!-- Scripts Highcharts -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<!-- Contenedor para el gráfico -->
<figure class="highcharts-figure">
    <div id="container"></div>
</figure>



<!-- Script del gráfico -->
<!-- Script del gráfico -->
<!-- Script del gráfico -->
<script type="text/javascript">
    // Tu PHP data aquí
    var data = <?php echo json_encode($aspectosAmbientales); ?>;

    // Organizar los datos por sector
    var sectorsData = {};
    data.forEach(function (aspecto) {
        var sectorName = aspecto.sector_name;
        if (!sectorsData[sectorName]) {
            sectorsData[sectorName] = [];
        }
        sectorsData[sectorName].push({
            name: aspecto.productive_unit_name,
            y: parseFloat(aspecto.carbon_footprint),
            sector: sectorName // Agrega el nombre del sector a los datos
        });
    });

    // Crear la serie con los totales por sector
    var seriesData = Object.keys(sectorsData).map(function (sectorName) {
        return {
            name: sectorName,
            y: sectorsData[sectorName].reduce(function (total, aspecto) {
                return total + aspecto.y;
            }, 0),
            drilldown: sectorName
        };
    });

    // Crear la serie de drilldown
    var drilldownSeries = Object.keys(sectorsData).map(function (sectorName) {
        return {
            name: sectorName,
            id: sectorName,
            data: sectorsData[sectorName]
        };
    });

    // Inicializar el gráfico de Highcharts
    var chart = Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            align: 'left',
            text: 'Huella de Carbono por Sector'
        },
        accessibility: {
            announceNewData: {
                enabled: true
            }
        },
        xAxis: {
            type: 'category'
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
            series: {
                point: {
                    events: {
                        click: function () {
                            // Manejar el clic en un sector
                            console.log('Sector clickeado:', this.name);

                            // Acceder a las unidades productivas de este sector y actualizar el gráfico de drilldown
                            var clickedSector = this.name;
                            var clickedDrilldownData = sectorsData[clickedSector];

                            // Actualizar el gráfico de drilldown con los datos de la unidad productiva
                            chart.addSeries({
                                name: clickedSector,
                                id: clickedSector,
                                data: clickedDrilldownData
                            });
                        }
                    }
                }
            },
            column: {
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}' // Muestra la huella de carbono sobre la barra
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{point.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">Sector</span>: {point.sector}<br>' +
                          '<span style="color:{point.color}">Carbon Footprint</span>: <b>{point.y:.2f}</b><br/>'
        },
        series: [{
            name: "Sectors",
            colorByPoint: false,
            data: seriesData
        }],
        drilldown: {
            series: drilldownSeries
        }
    });
</script>


@endpush
