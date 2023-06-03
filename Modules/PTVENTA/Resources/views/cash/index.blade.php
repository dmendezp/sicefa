@extends('ptventa::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('ptventa.cash.index') }}" class="text-decoration-none">Caja</a>
    <li class="breadcrumb-item active">Apertura de Caja</li>
    </li>
@endpush

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="text-center">Apertura de Caja</h4>
                <hr>
                {!! Form::open(['route' => 'ptventa.cashCount.store', 'id' => 'arqueo-form', 'class' => 'form-row']) !!}
                    <!-- Campos del formulario -->
                    <div class="form-group col-md-4">
                        {{ Form::label('person_id', 'Encargado de apertura:') }}
                        {{ Form::text('person_id', Auth::user()->person->full_name, ['class' => 'form-control', 'disabled']) }}
                    </div>

                    <div class="form-group col-md-3">
                        {{ Form::label('date', 'Fecha de Apertura') }}
                        {{ Form::datetimeLocal('date', null, ['class' => 'form-control', 'required', 'readonly']) }}
                    </div>

                    <div class="form-group col-md-3">
                        {{ Form::label('initial_balance', 'Saldo Inicial') }}
                        {{ Form::number('initial_balance', null, ['class' => 'form-control', 'step' => '0.01', 'required']) }}
                        <div class="form-text">*Utilice directamente las teclas de su teclado</div>
                    </div>

                    <div class="form-group col-md-2 d-flex align-items-center justify-content-end">
                        <button type="submit" class="btn btn-success btn-block">
                            <i class="fas fa-check"></i> Abrir
                        </button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="text-center">Histórico de Cajas</h4>
                <hr>
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="tableCashCount">
                        <thead class="table-dark">
                            <tr>
                                    <th scope="col">N°</th>
                                    <th scope="col">Encargado</th>
                                    <th scope="col">Fecha de apertura</th>
                                    <th scope="col">Saldo Inicial</th>
                                    <th scope="col">Saldo Final</th>
                                    <th scope="col">Diferencia</th>
                                    <th scope="col">Fecha de Cierre</th>
                                    <th scope="col">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cashCounts as $cashCount)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $cashCount->person->full_name}}</td>
                                    <td>{{ $cashCount->opening_date }}</td>
                                    <td>{{ $cashCount->initial_balance }}</td>
                                    <td>{{ $cashCount->final_balance ?: 'N/A' }}</td>
                                    <td>{{ $cashCount->difference ?: '0' }}</td>
                                    <td>{{ $cashCount->closing_time ?: 'N/A' }}</td>
                                    <td>{{ $cashCount->state }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>          
    </div>
</div>
@endsection

@include('ptventa::layouts.partials.plugins.sweetalert2')
@include('ptventa::layouts.partials.plugins.datatables')

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded',
        () => { // Agrega un evento que se activa cuando el contenido de la página se ha cargado completamente.
            const form = document.getElementById(
            'arqueo-form'); // Se obtiene el elemento del formulario con el ID "arqueo-form" y se almacena en la variable form.

            form.addEventListener('submit', (event) => {
                event.preventDefault();

                Swal.fire({
                    title: '¿Iniciar una nueva caja?',
                    text: 'Esta acción no se puede deshacer',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Confirmar',
                    cancelButtonText: 'Cancelar'
                }).then((
                result) => { //  Promesa (then) que se activa cuando el usuario hace clic en uno de los botones del cuadro de diálogo. Si el usuario confirma (isConfirmed), se envía el formulario llamando a form.submit().
                    if (result.isConfirmed) {
                        form.submit(); // Enviar el formulario si se confirma la acción
                    }
                });
            });

            @if (session('success'))
                Swal.fire(
                    'Operación realizada con Éxito',
                    'Has iniciado una nueva caja!',
                    'success'
                );
            @endif
        });
    </script>
    <script>
        $(document).ready(function () { /* Initialización of Datatables CashCount */
            $('#tableCashCount').DataTable({
                // opciones de configuración para la tabla 1
            });
        });
    </script>
    <script src="{{ asset('modules/ptventa/js/cash/index/dateTimeNow.js')}}"></script>    
@endpush
