@extends('hdc::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('hdc::calculatefootprint.Indicator_Calculate_Your_Footprint') }} </li>
@endpush

@section('content')
<div class="row justify-content-center">
    <!-- card -->
    <div class="content mt-3">
        <div class="container-fluid">
            <div class="card card-success card-outline shadow mt-3">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('hdc::calculatefootprint.Title_Card_Carbon_Footprint_Table')}} {{ Auth::user()->person->full_name }}</h3>
                </div>
                <div class="card-body">
                    <div id="container" style="height: 400px;"></div>
                    <a href="{{ route('hdc.'.getRoleRouteName(Route::currentRouteName()).'.Carbonfootprint.form.calculates', Auth::user()->person->id) }}" class="btn btn-success mb-2"><i
                            class="fa-solid fa-plus"></i></a>
                    <div class="mtop16">
                        @if ($environmeaspect->isNotEmpty())
                            <table id="example1" class="table table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>N°</th>
                                        <th>{{ trans('hdc::ConsumptionRegistry.Title_Header_Table_Column_Date')}}</th>
                                        <th>{{ trans('hdc::ConsumptionRegistry.Title_Header_Table_Column_Environmental_Aspect')}}</th>
                                        <th>{{ trans('hdc::ConsumptionRegistry.Title_Header_Table_Column_Quantity')}}</th>
                                        <th>CO2 (%)</th>
                                        <th>{{ trans('hdc::ConsumptionRegistry.Title_Header_Table_Column_Action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $total = 0; @endphp
                                    @foreach ($environmeaspect as $index => $aspect)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $aspect->mes }} {{ $aspect->anio }}</td>

                                            <td>
                                                <ul>
                                                    @foreach ($aspect->personenvironmentalaspects as $innerPersonAspect)
                                                        <li>{{ $innerPersonAspect->environmental_aspect->name }}</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>
                                                <ul>
                                                    @foreach ($aspect->personenvironmentalaspects as $innerPersonAspect)
                                                        <li>{{ $innerPersonAspect->consumption_value }}</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>
                                                @foreach ($aspect->personenvironmentalaspects as $innerPersonAspect)
                                                    @php
                                                        $total += $innerPersonAspect->consumption_value * $innerPersonAspect->environmental_aspect->conversion_factor;
                                                    @endphp
                                                @endforeach
                                                {{ $total }} {{-- Mostrar el total en la columna CO2 (%) --}}
                                                @php $total = 0; @endphp {{-- Reiniciar el total para la próxima iteración --}}
                                            </td>
                                            <td>
                                                @if ($aspect->personenvironmentalaspects->isNotEmpty())
                                                    <a href="{{ route('hdc.'.getRoleRouteName(Route::currentRouteName()).'.carbonfootprint.edit_consumption', $aspect->id) }}"
                                                        class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                                    <form
                                                        action="{{ route('hdc.'.getRoleRouteName(Route::currentRouteName()).'.carbonfootprint.eliminar', ['id' => $aspect->personenvironmentalaspects->first()->id]) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('¿Estás seguro de que quieres eliminar este registro?')"><i class="fas fa-trash-alt"></i></button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>No hay datos disponibles.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    Highcharts.chart('container', {
        title: {
            text: 'Huella de Carbono de los Últimos 3 Meses',
            align: 'left'
        },
        yAxis: {
            title: {
                text: 'Huella de Carbono'
            }
        },
        xAxis: {
            categories: [
                '{{ now()->subMonths(2)->format("F Y") }}',
                '{{ now()->subMonths(1)->format("F Y") }}',
                '{{ now()->format("F Y") }}',
            ],
            accessibility: {
                rangeDescription: 'Range: Últimos 3 meses'
            }
        },
        series: [{
            name: 'Huella de Carbono',
            data: [
                {{ $ultimos3Meses[2]->huella_carbono ?? 0 }},
                {{ $ultimos3Meses[1]->huella_carbono ?? 0 }},
                {{ $ultimos3Meses[0]->huella_carbono ?? 0 }},
            ]
        }],
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
@endpush

@endsection
