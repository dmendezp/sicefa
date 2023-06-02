@extends('ptventa::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('ptventa.cash.index') }}" class="text-decoration-none">Caja</a>
    <li class="breadcrumb-item active">Cierre de Caja</li>
    </li>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-center">Cierre de Caja</h4>
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
                                    <th scope="col">Hora de cierre</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Cierre</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cashCounts as $cashCount)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $cashCount->person->full_name }}</td>
                                        <td>{{ $cashCount->date }}</td>
                                        <td>{{ $cashCount->initial_balance }}</td>
                                            <td></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>{{ $cashCount->state }}</td>
                                        <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-danger btn-block" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                data-id="{{ $cashCount->id }}"
                                                data-initial-balance="{{ $cashCount->initial_balance }}">
                                                <i class="fas fa-close"></i> Cerrar Caja
                                            </button>
                                        </td>
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Realizar corte de caja</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => 'ptventa.cashCount.close', 'id' => 'cierre-caja-form', 'class' => 'form-row']) !!}
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
                        {{ Form::number('initial_balance', null, ['class' => 'form-control', 'step' => '0.01', 'required', 'readonly']) }}
                        <div class="form-text">*Utilice directamente las teclas de su teclado</div>
                    </div>
                
                    <div class="form-group col-md-3">
                        {{ Form::label('final_balance', 'Saldo Final') }}
                        {{ Form::number('final_balance', null, ['class' => 'form-control', 'step' => '0.01', 'required']) }}
                    </div>
                
                    <div class="form-group col-md-3">
                        {{ Form::label('closing_time', 'Hora de Cierre') }}
                        {{ Form::time('closing_time', null, ['class' => 'form-control', 'required']) }}
                    </div>
                
                    <div class="form-group col-md-2 d-flex align-items-center justify-content-end">
                        {{ Form::hidden('cash_count_id', null, ['id' => 'cash-count-id']) }}
                        <button type="submit" class="btn btn-success btn-block">
                            <i class="fas fa-check"></i> Cerrar
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
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
                    'arqueo-form'
                ); // Se obtiene el elemento del formulario con el ID "arqueo-form" y se almacena en la variable form.

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
                        result
                    ) => { //  Promesa (then) que se activa cuando el usuario hace clic en uno de los botones del cuadro de diálogo. Si el usuario confirma (isConfirmed), se envía el formulario llamando a form.submit().
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
        $(document).ready(function() {
            /* Initialización of Datatables CashCount */
            $('#tableCashCount').DataTable({
                // opciones de configuración para la tabla 1
            });
        });
    </script>
<script>
    $(document).ready(function() {
        $('#exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var cashCountId = button.data('id');
            var initialBalance = button.data('initial-balance');
            var date = button.data('date');

            var modal = $(this);
            modal.find('#cash-count-id').val(cashCountId);
            modal.find('#initial_balance').val(initialBalance);
            modal.find('#date').val(date);
        });
    });
</script>
    <script src="{{ asset('modules/ptventa/js/cash/index/dateTimeNow.js') }}"></scrip>
@endpush
