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
                        <h3 class="card-title">{{ trans('hdc::calculatefootprint.Title_Card_Carbon_Footprint_Table') }}
                            {{ Auth::user()->person->full_name }}</h3>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('cefa.hdc.Carbonfootprint.form.calculates', Auth::user()->person->id) }}"
                            class="btn btn-success mb-2"><i class="fa-solid fa-plus"></i></a>
                        <div id="container" style="height: 400px;"></div>
                        <div class="mtop16">
                            @if ($environmeaspect->isNotEmpty())
                                <table id="example1" class="table table-bordered">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>N°</th>
                                            <th>{{ trans('hdc::ConsumptionRegistry.Title_Header_Table_Column_Date') }}</th>
                                            <th>{{ trans('hdc::ConsumptionRegistry.Title_Header_Table_Column_Environmental_Aspect') }}
                                            </th>
                                            <th>{{ trans('hdc::ConsumptionRegistry.Title_Header_Table_Column_Quantity') }}
                                            </th>
                                            <th>CO2 (%)</th>
                                            <th>{{ trans('hdc::ConsumptionRegistry.Title_Header_Table_Column_Action') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $total = 0; @endphp
                                        @foreach ($environmeaspect as $index => $aspect)
                                            <tr>

                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ trans('hdc::ConsumptionRegistry.month' . \Carbon\Carbon::parse($aspect->anio . '-' . $aspect->mes)->format('n')) }}
                                                    {{ \Carbon\Carbon::parse($aspect->anio . '-' . $aspect->mes)->format('Y') }}
                                                </td>
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
                                                    @if (\Carbon\Carbon::parse($aspect->anio . '-' . $aspect->mes)->year >= date('Y'))
                                                        @if ($aspect->personenvironmentalaspects->isNotEmpty())
                                                            <a href="{{ route('cefa.hdc.carbonfootprint.edit_consumption', $aspect->id) }}"
                                                                class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>

                                                            <form class="delete-form"
                                                                action="{{ route('cefa.hdc.carbonfootprint.eliminar', ['id' => $aspect->personenvironmentalaspects->first()->id]) }}"
                                                                method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btnEliminar" type="button"><i class="fas fa-trash-alt"></i></button>
                                                            </form>
                                                        @endif
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
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const deleteForms = document.querySelectorAll('.delete-form');

                deleteForms.forEach((deleteForm) => {
                    deleteForm.addEventListener('submit', (event) => {
                        event.preventDefault(); // Prevenir el comportamiento predeterminado del formulario

                        const formId = deleteForm.dataset.formId;
                        const form = document.getElementById(formId);

                        Swal.fire({
                            title: '¿Estás seguro?',
                            text: 'Esta acción no se puede deshacer',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Sí, eliminar',
                            cancelButtonText: 'Cancelar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Envía el formulario de manera convencional
                                deleteForm.submit();
                            } else {
                                Swal.fire('Cancelado', 'La acción ha sido cancelada', 'info');
                            }
                        });
                    });
                });
            });

            const datosMes = {!! json_encode(
                $environmeaspectgraph->map(function ($entry) {
                    $month = trans("hdc::ConsumptionRegistry.month{$entry['mes']}");
                    $year = $entry['anio'];
                    return "$month $year";
                }),
            ) !!};
            // Después de la línea que obtiene datosCarbonPrint
            let datosCarbonPrint = {!! json_encode($environmeaspectgraph->pluck('carbon_print')) !!};
            // Limpiar cualquier carácter no numérico y convertir a números
            datosCarbonPrint = datosCarbonPrint.map(value => parseFloat(value.replace(/[^0-9.]/g, '')));


            // Código de Highcharts
            Highcharts.chart('container', {
                title: {
                    text: 'Calcula tu Huella',
                    align: 'left'
                },
                subtitle: {
                    text: 'Huella de carbono generada mensualmente.',
                    align: 'left'
                },
                yAxis: {
                    title: {
                        text: 'CO2(%)'
                    }
                },
                xAxis: {
                    categories: datosMes
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle'
                },
                series: [{
                    name: 'Huella De Carbono ',
                    data: datosCarbonPrint
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
