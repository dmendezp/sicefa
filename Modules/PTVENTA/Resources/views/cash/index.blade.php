@extends('ptventa::layouts.master')

@push('head')
    <link rel="stylesheet" href="{{asset('modules/ptventa/css/custom_styles.css')}}">
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('ptventa.cash.index') }}" class="text-decoration-none">{{ trans('ptventa::cash.Cash') }}</a>
    <li class="breadcrumb-item active">{{ trans('ptventa::cash.Cash Control') }}</li>
    </li>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card" data-aos="zoom-in-down">
                <div class="card-body">
                    <div class="d-flex justify-content-center align-items-center flex-column">
                        <h4 class="text-center">{{ trans('ptventa::cash.TitleCard1') }}</h4>
                        <div class="mt-3">
                          @if(!isset($active_cash))
                            {!! Form::open(['route' => 'ptventa.cash.store', 'class' => 'form-row']) !!}
                                <button type="submit" class="btn btn-success btn-block w-auto">
                                    <i class="fas fa-check"></i> {{ trans('ptventa::cash.Btn1') }}
                                </button>
                            {!! Form::close() !!}
                          @endif
                        </div>
                      </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">{{ trans('ptventa::cash.1T1') }} </th>
                                    <th scope="col"><i class="fa-solid fa-user-tie"></i> {{ trans('ptventa::cash.1T2') }} </th>
                                    <th scope="col"><i class="fa-solid fa-calendar-days"></i> {{ trans('ptventa::cash.1T3') }}</th>
                                    <th scope="col"><i class="fa-solid fa-circle-dollar-to-slot"></i> {{ trans('ptventa::cash.1T4') }}</th>
                                    <th scope="col"><i class="fa-solid fa-circle-dollar-to-slot"></i> {{ trans('ptventa::cash.1T10') }}</th>
                                    <th scope="col"><i class="fa-solid fa-check"></i> {{ trans('ptventa::cash.1T5') }}</th>
                                    <th scope="col"><i class="fa-solid fa-sort"></i> {{ trans('ptventa::cash.1T6') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($active_cash))
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>{{ $active_cash->person->full_name }}</td>
                                        <td>{{ $active_cash->opening_date }}</td>
                                        <td>{{ priceFormat($active_cash->initial_balance) }}</td>
                                        <td>{{ priceFormat($active_cash->total_sales) }}</td>
                                        <td>{{ $active_cash->state }}</td>
                                        <td>
                                            <div data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="{{ trans('ptventa::cash.TextTooltip1') }}">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-danger btn-block" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal"
                                                    data-cash-count-id="{{ $active_cash->id }}"
                                                    data-opening-manager="{{ $active_cash->person->full_name }}"
                                                    data-date="{{ $active_cash->opening_date }}"
                                                    data-initial-balance="{{ priceFormat($active_cash->initial_balance) }}"
                                                    data-total-sales="{{ priceFormat($active_cash->total_sales) }}"
                                                    data-warehouse="{{ $active_cash->productive_unit_warehouse->warehouse->name }}">
                                                    <i class="fa-solid fa-circle-xmark"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card" data-aos="zoom-in-up">
                <div class="card-body">
                    <h4 class="text-center">{{ trans('ptventa::cash.TitleCard2') }}</h4>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableCashCountAll">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col" class="text-center">{{ trans('ptventa::cash.1T1') }}</th>
                                    <th scope="col">{{ trans('ptventa::cash.1T2') }}</th>
                                    <th scope="col" class="text-center">{{ trans('ptventa::cash.1T3') }}</th>
                                    <th scope="col" class="text-center">{{ trans('ptventa::cash.1T8') }}</th>
                                    <th scope="col" class="text-center">{{ trans('ptventa::cash.1T4') }}</th>
                                    <th scope="col" class="text-center">{{ trans('ptventa::cash.1T7') }}</th>
                                    <th scope="col" class="text-center">{{ trans('ptventa::cash.1T10') }}</th>
                                    <th scope="col" class="text-center">{{ trans('ptventa::cash.1T5') }}</th>
                                    <th scope="col">{{ trans('ptventa::cash.1T9') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cash_counts as $cc)
                                    <tr>
                                        <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                                        <td>{{ $cc->person->full_name }}</td>
                                        <td class="text-center">{{ $cc->opening_date }}</td>
                                        <td class="text-center">{{ $cc->closing_date ?: 'N/A' }}</td>
                                        <td class="text-center">{{ priceFormat($cc->initial_balance) }}</td>
                                        <td class="text-center">{{ $cc->final_balance !== null ? priceFormat($cc->final_balance) : 'N/A' }}</td>
                                        <td class="text-center">{{ priceFormat(12000) }}</td>
                                        <td class="text-center">{{ $cc->state }}</td>
                                        <td>{{ $cc->productive_unit_warehouse->warehouse->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ trans('ptventa::cash.TitleModal') }}
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => 'ptventa.cash.close', 'id' => 'cierre-caja-form', 'class' => 'form-row']) !!}
                        <!-- Campos del formulario -->
                        <div class="form-group col-md-4">
                            {{ Form::label('opening_manager', trans('ptventa::cash.1T2')) }}
                            {{ Form::text('opening_manager', null, ['class' => 'form-control', 'readonly', 'id' => 'opening_manager']) }}
                        </div>

                        <div class="form-group col-md-4">
                            {{ Form::label('opening_date', trans('ptventa::cash.1T3')) }}
                            {{ Form::datetimeLocal('opening_date', null, ['class' => 'form-control', 'readonly']) }}
                        </div>

                        <div class="form-group col-md-4">
                            {{ Form::label('initial_balance', trans('ptventa::cash.1T4')) }}
                            {{ Form::text('initial_balance', null, ['class' => 'form-control', 'readonly', 'id' => 'initial_balance']) }}
                        </div>

                        <div class="form-group col-md-4">
                            {{ Form::label('final_balance', trans('ptventa::cash.1T7')) }}
                            {{ Form::text('final_balance', null, ['class' => 'form-control price-format', 'step' => '0.01', 'required']) }}
                        </div>

                        <div class="form-group col-md-4">
                            {{ Form::label('total_sales', trans('ptventa::cash.1T10')) }}
                            {{ Form::text('total_sales', null, ['class' => 'form-control', 'disabled', 'id' => 'total_sales']) }}
                        </div>

                        <div class="form-group col-md-4">
                            {{ Form::label('date', trans('ptventa::cash.1T8')) }}
                            {{ Form::datetimeLocal('date', null, ['class' => 'form-control', 'readonly']) }}
                        </div>

                        <div class="form-group col-md-4">
                            {{ Form::label('warehouse_name', trans('ptventa::cash.1T9')) }}
                            {{ Form::text('warehouse_name', null, ['class' => 'form-control', 'readonly', 'id' => 'warehouse']) }}
                        </div>

                        <div class="form-group mt-4 col-md-4 d-flex justify-content-end">
                            {{ Form::hidden('cash_count_id', null, ['id' => 'cash-count-id']) }}
                            <button type="submit" class="btn btn-danger btn-block" id="cerrar-caja-btn">{{ trans('ptventa::cash.Close cash') }}</button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@include('ptventa::layouts.partials.plugins.sweetalert2')
@include('ptventa::layouts.partials.plugins.datatables')

@push('scripts')
    <!-- Recursos para los formatedores de datos -->
    <script src="{{ asset('libs/cleave.js-1.6.0/dist/cleave.js') }}"></script>
    <!-- Formateadores de datos -->
    <script src="{{ asset('modules/ptventa/js/data-formats.js') }}"></script>
    <script>
        // Deshabilitar el botón de cerrar caja al enviar el formulario
        const form = document.getElementById('cierre-caja-form');
        const cerrarCajaBtn = document.getElementById('cerrar-caja-btn');

        form.addEventListener('submit', () => {
            cerrarCajaBtn.disabled = true;
            cerrarCajaBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';

            // Simulando un proceso que tarda unos segundos
            setTimeout(() => {
                // Aquí colocas el código del proceso que se ejecuta al enviar el formulario
                // Por ejemplo, puedes enviar una petición al servidor o realizar alguna acción asincrónica.

                // Una vez que el proceso ha terminado, restablecer el botón a su estado original
                cerrarCajaBtn.disabled = false;
                cerrarCajaBtn.innerHTML = 'Cerrar Caja'; // Cambia este texto al texto original del botón
            }, 3000); // Ejemplo: Esperar 3 segundos antes de restaurar el botón
        });

        // Evento para restaurar el botón a su estado original cuando se carga la página
        window.addEventListener('load', () => {
            cerrarCajaBtn.disabled = false;
            cerrarCajaBtn.innerHTML = 'Cerrar Caja'; // Cambia este texto al texto original del botón
        });
    </script>
    <script>
        // Permite la aplicacion de datatables y la vez la traduccion de las tablas
        $(document).ready(function() {
            /* Initialización of Datatables CashCountAll */
            $('#tableCashCountAll').DataTable({
                language: language_datatables, // Agregar traducción a español
            });
        });
    </script>
    <script>
        // Muestra los datos en el modal de cierre de caja
        var modal = new bootstrap.Modal(document.getElementById('exampleModal'), {});

        $('#exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var cashCountId = button.data('cash-count-id');
            var openingManager = button.data('opening-manager');
            var openingDate = button.data('date');
            var initialBalance = button.data('initial-balance');
            var totalSales = button.data('total-sales');
            var warehouse = button.data('warehouse');

            modal._element.querySelector('#cash-count-id').value = cashCountId;
            modal._element.querySelector('#opening_manager').value = openingManager;
            modal._element.querySelector('#opening_date').value = openingDate;
            modal._element.querySelector('#initial_balance').value = initialBalance;
            modal._element.querySelector('#total_sales').value = totalSales;
            modal._element.querySelector('#warehouse').value = warehouse;
        });
    </script>
    <script>
        //Alertas de sweetalert que permiten la confirmacion de si desea cerrar la caja
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('cierre-caja-form');

            form.addEventListener('submit', (event) => {
                event.preventDefault();

                Swal.fire({
                    title: '{{ trans('ptventa::cash.Title1') }}',
                    text: '{{ trans('ptventa::cash.Text1') }}',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: '{{ trans('ptventa::cash.Btn2') }}',
                    cancelButtonText: '{{ trans('ptventa::cash.Btn3') }}'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    } else {
                        Swal.fire(
                            '{{ trans('ptventa::cash.Title2') }}',
                            '{{ trans('ptventa::cash.Text2') }}',
                            'info'
                        );
                    }
                });
            });

            // Verificar si hay mensajes de éxito o error desde el servidor
            const successMessage = "{{ session('success') }}";
            const errorMessage = "{{ session('error') }}";

            if (successMessage) {
                Swal.fire('{{ trans('ptventa::cash.Title3') }}', successMessage, 'success');
            }

            if (errorMessage) {
                Swal.fire('{{ trans('ptventa::cash.Title4') }}', errorMessage, 'error');
            }
        });
    </script>
    <script src="{{ asset('modules/ptventa/js/cash/index/dateTimeNow.js') }}"></script>
@endpush
