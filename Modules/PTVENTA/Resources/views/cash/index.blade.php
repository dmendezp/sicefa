@extends('ptventa::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('ptventa.cash.index') }}" class="text-decoration-none">Caja</a>
    <li class="breadcrumb-item active">Apertura de Caja</li>
    </li>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-center">Apertura de Caja</h4>
                    <hr>
                    {!! Form::open(['route' => 'ptventa.cashCount.store', 'id' => 'arqueo-form']) !!}
                        <!-- Campos del formulario -->
                        <div class="form-group">
                            {{ Form::label('person_id', 'Encargado de apertura:') }}
                            {{ Form::text('person_id', Auth::user()->person->full_name, ['class' => 'form-control', 'disabled']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('date', 'Fecha de Apertura') }}
                            {{ Form::datetimeLocal('date', null, ['class' => 'form-control', 'required', 'readonly']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('initial_balance', 'Saldo Inicial') }}
                            {{ Form::number('initial_balance', null, ['class' => 'form-control', 'step' => '0.01', 'required']) }}
                            <div class="form-text">*Utilice directamente las teclas de su teclado</div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('final_balance', 'Saldo Final') }}
                            {{ Form::number('final_balance', null, ['class' => 'form-control', 'step' => '0.01', 'required'])}}
                        </div>

                        <div class="form-group">
                            {{ Form::label('closing_time', 'Hora de Cierre') }}
                            {{ Form::time('closing_time', null, ['class' => 'form-control', 'required'])}}
                        </div>

                        <div class="text-center">
                            {{ Form::submit('Guardar', ['class' => 'btn btn-primary']) }}
                        </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
        <div class="col-md-8">
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
                                    <th scope="col">Hora de cierre</th>
                                    <th scope="col">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cashCounts as $cashCount)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $cashCount->person->full_name}}</td>
                                    <td>{{ $cashCount->date }}</td>
                                    <td>{{ $cashCount->initial_balance }}</td>
                                    <td>{{ $cashCount->final_balance }}</td>
                                    <td>{{ $cashCount->difference }}</td>
                                    <td>{{ $cashCount->closing_time }}</td>
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

                Swal.fire({
                    title: '¿Deseas guardar el arqueo?',
                    text: 'Esta acción no se puede deshacer',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Guardar',
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
                    'Cierre de caja hecho!',
                    'success'
                );
            @endif
        });
    </script>
    <script>
        $(document).ready(function () { /* Initialización of Datatables ---Category */
            $('#tableCashCount').DataTable({
                // opciones de configuración para la tabla 1
            });
        });
    </script>
    <script src="{{ asset('modules/ptventa/js/cashCount/dateTimeNow.js')}}"></script>    
@endpush
