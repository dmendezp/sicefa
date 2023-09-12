@extends('agroindustria::layouts.master')
@include('agroindustria::layouts.partials.head')

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

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Insumos.</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            {!! Form::open(['route' => 'cefa.agroindustria.storer.create', 'method' => 'POST', 'id' => 'inventoryForm']) !!}
                            {{ csrf_field() }}
                            
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        {!! Form::label('element_id', 'Elemento.', ['class' => 'form-label']) !!}
                                        {!! Form::select('element_id', $elements->pluck('name', 'id'), null, ['class' => 'form-select', 'placeholder' => 'Seleccione elemento', 'required']) !!}
                                        <div class="invalid-feedback">Por favor seleccione un elemento.</div>
                                    </div>
                                    
                                    @foreach ($productiveunitwarehouses as $productiveunitwarehouse)
                                        {!! Form::hidden('productive_unit_warehouse_id', $productiveunitwarehouse->id) !!}
                                        {!! Form::hidden('person_id', '2') !!}
                                        
                                    @endforeach
                                    @foreach ( $inventories as $inventory )
                                    {!! Form::hidden('id', $inventory->id) !!}
                                    @endforeach

                                   
                                    
                                    <div class="mb-3">
                                        {!! Form::label('description', 'Descripcion.', ['class' => 'form-label']) !!}
                                        {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Descripcion.', 'required']) !!}
                                        <div class="invalid-feedback">Por favor ingrese una descripción.</div>
                                    </div>
                                </div>
                        
                                <div class="col">
                                    <div class="mb-3">
                                        {!! Form::label('price', 'Precio.', ['class' => 'form-label']) !!}
                                        {!! Form::number('price', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Precio.', 'required']) !!}
                                        <div class="invalid-feedback">Por favor ingrese un precio.</div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        {!! Form::label('stock', 'Disponible.', ['class' => 'form-label']) !!}
                                        {!! Form::number('stock', null, ['class' => 'form-control', 'placeholder' => 'Ingrese cantidad disponible.', 'required']) !!}
                                        <div class="invalid-feedback">Por favor ingrese la cantidad disponible.</div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        {!! Form::label('expiration_date', 'Fecha de expiracion.', ['class' => 'form-label']) !!}
                                        {!! Form::date('expiration_date', null, ['class' => 'form-control', 'placeholder' => 'Seleccione Fecha de vencimiento.', 'required']) !!}
                                        <div class="invalid-feedback">Por favor seleccione una fecha de expiración.</div>
                                    </div>

                                </div>
                            </div>
                            
                            <div class="modal-footer">
                                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        {!! Form::close() !!}
                        
                        
                        </div>
                    </div>
                </div>
            </div>

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
                                <button class="btn btn-primary float-end mb-2" style="width: 45px; height: 35px;" data-bs-toggle="modal" data-bs-target="#editmodal">
                                    <i class="fa-solid fa-pen-to-square fa-sm"></i>
                                </button>
                                <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">ditar.</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                {!! Form::open(['route' => 'cefa.agroindustria.storer.create', 'method' => 'POST', 'id' => 'inventoryForm']) !!}
                                                {{ csrf_field() }}
                                                
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            {!! Form::label('element_id', 'Elemento.', ['class' => 'form-label']) !!}
                                                            {!! Form::select('element_id', $elements->pluck('name', 'id'), null, ['class' => 'form-select', 'placeholder' => 'Seleccione elemento', 'required']) !!}
                                                            <div class="invalid-feedback">Por favor seleccione un elemento.</div>
                                                        </div>
                                                        
                                                        @foreach ($productiveunitwarehouses as $productiveunitwarehouse)
                                                            {!! Form::hidden('productive_unit_warehouse_id', $productiveunitwarehouse->id) !!}
                                                            {!! Form::hidden('person_id', '2') !!}
                                                            
                                                        @endforeach
                                                        @foreach ( $inventories as $inventory )
                                                        {!! Form::hidden('id', $inventory->id) !!}
                                                        @endforeach
                    
                                                       
                                                        
                                                        <div class="mb-3">
                                                            {!! Form::label('description', 'Descripcion.', ['class' => 'form-label']) !!}
                                                            {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Descripcion.', 'required']) !!}
                                                            <div class="invalid-feedback">Por favor ingrese una descripción.</div>
                                                        </div>
                                                    </div>
                                            
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            {!! Form::label('price', 'Precio.', ['class' => 'form-label']) !!}
                                                            {!! Form::number('price', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Precio.', 'required']) !!}
                                                            <div class="invalid-feedback">Por favor ingrese un precio.</div>
                                                        </div>
                                                        
                                                        <div class="mb-3">
                                                            {!! Form::label('stock', 'Disponible.', ['class' => 'form-label']) !!}
                                                            {!! Form::number('stock', null, ['class' => 'form-control', 'placeholder' => 'Ingrese cantidad disponible.', 'required']) !!}
                                                            <div class="invalid-feedback">Por favor ingrese la cantidad disponible.</div>
                                                        </div>
                                                        
                                                        <div class="mb-3">
                                                            {!! Form::label('expiration_date', 'Fecha de expiracion.', ['class' => 'form-label']) !!}
                                                            {!! Form::date('expiration_date', null, ['class' => 'form-control', 'placeholder' => 'Seleccione Fecha de vencimiento.', 'required']) !!}
                                                            <div class="invalid-feedback">Por favor seleccione una fecha de expiración.</div>
                                                        </div>
                    
                                                    </div>
                                                </div>
                                                
                                                <div class="modal-footer">
                                                    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                                </div>
                                            {!! Form::close() !!}
                                            
                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>



                               
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

@endsection

@section('script')
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
