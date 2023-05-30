@extends('ptventa::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('ptventa.cash.index') }}" class="text-decoration-none">Caja</a>
    <li class="breadcrumb-item active">Arqueo Caja</li>
    </li>
@endpush

 @section('content')
 <div class="row">
     <div class="col-md-6">
         <div class="card">
             <div class="card-body">
                 <h1>Arqueo de Caja</h1>

                 <form id="arqueo-form" method="POST" action="{{ route('ptventa.cashCount.store') }}">
                     @csrf

                     <div class="form-group">
                         <label for="person_id">Nombre del encargado de apertura:</label>
                         <input type="text" id="person_id" class="form-control"
                             value="{{ Auth::User()->person->full_name }}" disabled>
                     </div>

                     <div class="form-group">
                         <label for="date">Fecha de Apertura</label>
                         <input type="datetime-local" id="date" name="date" class="form-control" required>
                     </div>

                     <div class="form-group">
                         <label for="initial_balance">Saldo Inicial</label>
                         <input type="number" id="initial_balance" name="initial_balance" class="form-control"
                             step="0.01" required>
                     </div>

                     <div class="form-group">
                         <label for="final_balance">Saldo Final</label>
                         <input type="number" id="final_balance" name="final_balance" class="form-control"
                             step="0.01" required>
                     </div>

                     <div class="form-group">
                        <label for="closing_time">Hora de Cierre</label>
                        <input type="time" id="closing_time" name="closing_time" class="form-control" required>
                     </div>

                     <button type="submit" class="btn btn-primary">Guardar</button>
                 </form>
             </div>
         </div>
     </div>
     <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">N°</th>
                            <th scope="col">Encargado</th>
                            <th scope="col">Fecha de apertura</th>
                            <th scope="col">Saldo Inicial</th>
                            <th scope="col">Saldo Final</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>25-05-2023</td>
                            <td>300000</td>
                            <td>300000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
 </div>
@endsection

@include('ptventa::layouts.partials.plugins.sweetalert2')

@push('scripts')
 <script>
     document.addEventListener('DOMContentLoaded', () => { // Agrega un evento que se activa cuando el contenido de la página se ha cargado completamente.
         const form = document.getElementById('arqueo-form'); // Se obtiene el elemento del formulario con el ID "arqueo-form" y se almacena en la variable form.

         form.addEventListener('submit', (event) => {
             event.preventDefault();

             Swal.fire({
                 title: '¿Deseas guardar el arqueo?',
                 text: 'Esta acción no se puede deshacer',
                 icon: 'warning',
                 showCancelButton: true,
                 confirmButtonText: 'Guardar',
                 cancelButtonText: 'Cancelar'
             }).then((result) => {  //  Promesa (then) que se activa cuando el usuario hace clic en uno de los botones del cuadro de diálogo. Si el usuario confirma (isConfirmed), se envía el formulario llamando a form.submit().
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
@endpush