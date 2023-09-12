@extends('agroindustria::layouts.master')
@section('content')
<div class="container">
    <div class="card" style="width: 1100px;">
        <div class="card-body">
            <h1 class="text-center">Inventario</h1>
            @if (\Session::has('success'))
            <div class="alert alert-success">
                <p>{{\Session::get('success')}}</p>
            </div>
            @endif
            @if (\Session::has('destroy'))
            <div class="alert alert-danger">
                <p>{{\Session::get('destroy')}}</p>
            </div>
            @endif
            <button class="btn btn-success float-end mb-2" style="width: 45px; height: 35px;" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fa-solid fa-plus fa-sm"></i>
            </button>
            {!! Form::open(['route' => 'cefa.agroindustria.storer.create', 'method' => 'POST', 'id' => 'inventoryForm']) !!}
            {{ csrf_field() }}
            @include('agroindustria::storer.form')
            {!! Form::close() !!}


            <table id="example" class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Categoria</th>
                        <th>Precio</th>
                        <th>Disponible</th>
                        <th>Fecha de expiracion</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inventories as $inventory)
                        <tr>
                            <td>{{ $inventory->id }}</td>
                            <td>{{ $inventory->element->name }}</td>
                            <td>{{ $inventory->description }}</td>
                            <td>{{ $inventory->element->category->name }}</td>
                            <td>{{ $inventory->price }}</td>
                            <td>{{ $inventory->stock }}</td>
                            <td>{{ $inventory->expiration_date }}</td>
                            <td>
                                <button class="btn btn-primary float-end mb-2" style="width: 45px; height: 35px;" data-bs-toggle="modal" data-bs-target="#editModal{{$inventory->id}}">
                                    <i class="fa-solid fa-pen-to-square fa-sm"></i>
                                </button>
                                {!! Form::open(['route' => ['cefa.agroindustria.storer.show', $inventory->id], 'method' => 'POST', 'style' => 'display:inline;']) !!}
                                @include('agroindustria::storer.edit')
                                {!! Form::close() !!}     

                                {!! Form::open(['route' => ['cefa.agroindustria.storer.inventory.delete', $inventory->id], 'method' => 'delete', 'class' => 'aa', 'style' => 'display:inline;']) !!}
                                <button type="submit"  style="width: 45px; height: 35px;"  class="btn btn-danger"><i class="fa-solid fa-trash fa-sm"></i></button>                            
                                {!! Form::close() !!}

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@section('script')
@endsection
<script>
    /* Script validacion */
    document.addEventListener('DOMContentLoaded', function() {
        var inventoryForm = document.getElementById('inventoryForm');
        inventoryForm.addEventListener('submit', function(event) {
            if (!inventoryForm.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            inventoryForm.classList.add('was-validated');
        });
    });
</script>
<script>
    function confirmarEliminacion(event) {
      event.preventDefault(); // Evita el envío del formulario por defecto

      if (confirm("¿Estás seguro de que quieres eliminar este elemento de inventario?")) {
          // Si el usuario confirma, entonces procedemos a enviar el formulario
          event.target.submit();
      } else {
          // Si el usuario cancela, no hacemos nada
          // Puedes agregar aquí cualquier otra acción que desees realizar
      }
  }

  // Agregamos un escuchador de eventos para el formulario con la clase 'aa'
  document.addEventListener('DOMContentLoaded', function() {
      var formulario = document.querySelector('.aa');
      formulario.addEventListener('submit', confirmarEliminacion);
  });
</script>

@endsection