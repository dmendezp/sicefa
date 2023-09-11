@extends('ptventa::layouts.master')

@push('head')
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('ptventa::mainPage.Breadcrumb_Active_Main') }}</li>
@endpush

@section('content')
    <h5 class="display-5" data-aos="fade-right">{{ trans('ptventa::mainPage.Title_Page_Admin') }}</h5>

    <div class="row">
        <div class="col-md-5 col-lg-5" data-aos="fade-up" data-aos-duration="1000">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">{{ trans('ptventa::mainPage.Title_Chart_Sales') }}</h3>
                        <a href="{{ route('ptventa.' . getRoleRouteName(Route::currentRouteName()) . '.reports.sales') }}" class="btn btn-danger btn-sm">{{ trans('ptventa::mainPage.Btn_Chart_Report') }} 
                            <i class="fa-solid fa-file-pdf"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <p class="d-flex flex-column">
                            <span class="text-bold text-lg">{{ $maxSalesMonth }}</span>
                            <span>{{ trans('ptventa::mainPage.Info_Chart_Sales_1') }}</span>
                        </p>
                        <p class="ml-auto d-flex flex-column text-right">
                            @if ($percentageChange > 0)
                                <span class="text-success">
                                    <i class="fas fa-arrow-up"></i> {{ number_format($percentageChange, 2) }}%
                                </span>
                                <span class="text-muted">{{ trans('ptventa::mainPage.Option_Chart_Sales_1') }}</span>
                            @elseif ($percentageChange < 0)
                                <span class="text-danger">
                                    <i class="fas fa-arrow-down"></i> {{ number_format(abs($percentageChange), 2) }}%
                                </span>
                                <span class="text-muted">{{ trans('ptventa::mainPage.Option_Chart_Sales_2') }}</span>
                            @else
                                <span class="text-muted">{{ trans('ptventa::mainPage.Option_Chart_Sales_3') }}</span>
                            @endif
                        </p>
                    </div>
                    <div class="position-relative mb-4">
                        <div>
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-duration="1500">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('ptventa::mainPage.Title_Recently_Added') }}</h3>
                </div>
                <div class="card-body p-0">
                    @if (count($recentlyAddedInventory) > 0)
                        <ul class="products-list product-list-in-card pr-2">
                            @foreach ($recentlyAddedInventory as $inventory)
                                <li class="item">
                                    <div class="product-info">
                                        <span class="product-title">{{ $inventory->element->name }}</span>
                                        <span class="badge badge-success float-right">{{ priceFormat($inventory->price) }}</span>
                                        <span class="product-description">{{ $inventory->description }}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-center"> <em>No hay productos agregados.</em> </p>
                    @endif
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('ptventa.admin.inventory.index') }}" class="btn btn-success uppercase">
                        {{ trans('ptventa::mainPage.Btn_Recently_Added') }}
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-3" data-aos="fade-up" data-aos-duration="2000">
            <div class="info-box mb-3 bg-success">
                <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">{{ trans('ptventa::mainPage.Title_Sumary_1') }}</span>
                    <span class="info-box-number">{{ $totalInventory }}</span>
                </div>
            </div>
            <div class="info-box mb-3 bg-olive">
                <span class="info-box-icon"><i class="fa-solid fa-cash-register"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">{{ trans('ptventa::mainPage.Title_Sumary_2') }}</span>
                    <span class="info-box-number">{{ $closedCashCounts }}</span>
                </div>
            </div>
            <div class="info-box mb-3 bg-teal">
                <span class="info-box-icon"><i class="fa-solid fa-warehouse"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">{{ trans('ptventa::mainPage.Title_Sumary_3') }}</span>
                    <span class="info-box-number">{{ $totalWarehouses }}</span>
                </div>
            </div>
            <div class="info-box mb-3 bg-info">
                <span class="info-box-icon"><i class="fa-solid fa-industry"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">{{ trans('ptventa::mainPage.Title_Sumary_4') }}</span>
                    <span class="info-box-number">{{ $totalProductiveUnits }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('AdminLTE/plugins/chart.js/Chart.min.js') }}"></script>

    <script src="{{ asset('AdminLTE/plugins/chart.js/Chart.min.js') }}"></script>
    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($months) !!}, // Array de nombres de meses obtenidos del controlador
                datasets: [{
                    label: '# Total de Ventas',
                    data: {!! json_encode($salesTotals) !!}, // Array de totales de ventas por mes obtenidos del controlador
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 100, 1)',
                    borderWidth: 1,
                    pointStyle: 'triangle',
                    pointBackgroundColor: ' rgba(46, 204, 113, 0.1)',
                    backgroundColor: 'rgba(54, 162, 100, 0.7)'
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpush
