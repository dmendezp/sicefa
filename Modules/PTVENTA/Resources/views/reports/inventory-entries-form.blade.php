@extends('ptventa::layouts.master')

@push('head')
    <link rel="stylesheet" href="{{ asset('modules/ptventa/css/custom_styles.css') }}">
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('ptventa.'.getRoleRouteName(Route::currentRouteName()).'.reports.index') }}"
            class="text-decoration-none">{{ trans('ptventa::reports.Reports') }}</a>
    </li>
    <li class="breadcrumb-item active">{{ trans('ptventa::reports.Inventory Entries') }}</li>
@endpush

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row mb-3">
                        <div class="col-md-auto">
                            <form class="form-inline" action="{{ route('ptventa.'.getRoleRouteName(Route::currentRouteName()).'.reports.generate.inventory.entries') }}"
                                method="POST">
                                @csrf
                                <div class="form-group mr-3">
                                    <label class="mr-2">{{ trans('ptventa::reports.TextForm1') }}</label>
                                    <input type="date" class="form-control" name="start_date" id="start_date"
                                        value="{{ $start_date }}" required>
                                </div>
                                <div class="form-group mr-3">
                                    <label class="mr-2">{{ trans('ptventa::reports.TextForm2') }}</label>
                                    <input type="date" class="form-control" name="end_date" id="end_date"
                                        value="{{ $end_date }}" required>
                                </div>
                                <button type="submit" class="btn btn-primary">{{ trans('ptventa::reports.Btn1') }} <i
                                        class="fa-solid fa-magnifying-glass"></i></button>
                            </form>
                        </div>
                        <div class="col-md">
                            <form action="{{ route('ptventa.'.getRoleRouteName(Route::currentRouteName()).'.reports.generate.entries.pdf') }}" method="post">
                                @csrf
                                <input type="hidden" name="start_date" value="{{ $start_date }}">
                                <input type="hidden" name="end_date" value="{{ $end_date }}">
                                <button type="submit" class="btn btn-danger">{{ trans('ptventa::reports.Btn2') }} <i
                                        class="fa-solid fa-file-pdf"></i></button>
                            </form>
                        </div>
                    </div>

                    <hr>

                    @if (isset($movements) && $movements->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th class=text-center>{{ trans('ptventa::reports.1') }}</th>
                                        <th class="text-center">{{ trans('ptventa::reports.2') }}</th>
                                        <th>{{ trans('ptventa::reports.3') }}</th>
                                        <th>{{ trans('ptventa::reports.4') }}</th>
                                        <th>{{ trans('ptventa::reports.5') }}</th>
                                        <th class="text-center">{{ trans('ptventa::reports.6') }}</th>
                                        <th class="text-center">{{ trans('ptventa::reports.7') }}</th>
                                        <th class="text-center">{{ trans('ptventa::reports.8') }}</th>
                                        <th class="text-center">{{ trans('ptventa::reports.9') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $rowNumber = 0; // Variable para hacer un seguimiento del número de fila actual
                                    @endphp

                                    @foreach ($movements as $key => $movement)
                                        @foreach ($movement->movement_details as $index => $movement_detail)
                                            <tr>
                                                @if ($index === 0)
                                                    {{-- Verificar si es la primera fila del movimiento --}}
                                                    <td class="text-center"
                                                        rowspan="{{ count($movement->movement_details) }}"
                                                        style="vertical-align: middle;">{{ $key + 1 }}</td>
                                                    <td class="text-center"
                                                        rowspan="{{ count($movement->movement_details) }}"
                                                        style="vertical-align: middle;">{{ $movement->voucher_number }}
                                                    </td>
                                                    <td rowspan="{{ count($movement->movement_details) }}"
                                                        style="vertical-align: middle;">
                                                        {{ $movement->movement_responsibilities->where('role', 'ENTREGA')->first()->person->full_name }}
                                                    </td>
                                                    <td rowspan="{{ count($movement->movement_details) }}"
                                                        style="vertical-align: middle;">{{ $movement->registration_date }}
                                                    </td>
                                                @endif
                                                <td>{{ $movement_detail->inventory->element->product_name }}</td>
                                                <td class="text-center">{{ $movement_detail->amount }}</td>
                                                <td class="text-center">{{ priceFormat($movement_detail->price) }}</td>
                                                <td class="text-center">
                                                    {{ priceFormat($movement_detail->amount * $movement_detail->price) }}
                                                </td>
                                                @if ($index === 0)
                                                    {{-- Solo mostrar el precio en la primera fila del movimiento --}}
                                                    <td class="text-center fw-bold"
                                                        rowspan="{{ count($movement->movement_details) }}"
                                                        style="vertical-align: middle;">{{ priceFormat($movement->price) }}
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>{{ trans('ptventa::reports.AltText') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@include('ptventa::layouts.partials.plugins.sweetalert2')

@push('scripts')
    <script>
        // Función para actualizar los atributos min y max de los campos de fecha
        function updateDateAttributes() {
            const startDateInput = document.getElementById('start_date');
            const endDateInput = document.getElementById('end_date');

            endDateInput.min = startDateInput.value;
            startDateInput.max = endDateInput.value;
        }

        // Eventos para actualizar los atributos al cambiar las fechas
        document.getElementById('start_date').addEventListener('change', updateDateAttributes);
        document.getElementById('end_date').addEventListener('change', updateDateAttributes);
    </script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'info',
            title: '{{ trans('ptventa::reports.title') }}'
        })
    </script>
@endpush
