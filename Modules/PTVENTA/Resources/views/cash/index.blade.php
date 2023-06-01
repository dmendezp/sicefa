@extends('ptventa::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('ptventa.cash.index') }}" class="text-decoration-none">Caja</a>
    <li class="breadcrumb-item active">Arqueo Caja</li>
    </li>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-center">Arqueo de Caja</h4>
                    <hr>
                    <form id="arqueo-form" method="POST" action="{{ route('ptventa.cashCount.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="person_id">Encargado de apertura:</label>
                            <input type="text" id="person_id" class="form-control" value="{{ Auth::User()->person->full_name }}" disabled>
                        </div>

                        <div class="form-group">
                            <label for="date">Fecha de Apertura</label>
                            <input type="datetime-local" id="date" name="date" class="form-control" required readonly>
                        </div>

                        <div class="form-group">
                            <label for="initial_balance">Saldo Inicial</label>
                            <input type="number" id="initial_balance" name="initial_balance" class="form-control" step="0.01" required>
                            <div class="form-text">*Utilice directamente las teclas de su teclado</div>
                        </div>

                        <div class="form-group">
                            <label for="final_balance">Saldo Final</label>
                            <input type="number" id="final_balance" name="final_balance" class="form-control" step="0.01" required>
                        </div>

                        <div class="form-group">
                            <label for="closing_time">Hora de Cierre</label>
                            <input type="time" id="closing_time" name="closing_time" class="form-control" required>
                        </div>

                        <div class="text-center"> <!-- Agregar la clase text-center al contenedor del botón -->
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
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
                event.preventDefault();

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
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const dateInput = document.getElementById('date');
    
            function formatDateTime(date) {
                const year = date.getFullYear();
                const month = (date.getMonth() + 1).toString().padStart(2, '0');
                const day = date.getDate().toString().padStart(2, '0');
                const hours = date.getHours().toString().padStart(2, '0');
                const minutes = date.getMinutes().toString().padStart(2, '0');
                const seconds = date.getSeconds().toString().padStart(2, '0');
                return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
            }
    
            function updateDate() {
                const currentDate = formatDateTime(new Date());
                dateInput.value = currentDate;
            }
    
            updateDate(); // Actualizar la fecha inicialmente
    
            setInterval(updateDate, 1000); // Actualizar la fecha cada segundo
        });
    </script>
    
@endpush
