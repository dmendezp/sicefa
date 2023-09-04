@extends('agrocefa::layouts.master')

@section('content')
        <h1>Bodega Actual: {{ $warehouses->first()->name }}</h1>

        <div class="container_inventory">
        <form method="POST" action="{{ route('agrocefa.inventory.showWarehouseFilter') }}">
            @csrf
            <div class="form-group">
                <label for="category">Seleccionar Categoría:</label>
                <select name="category" id="category" class="form-control">
                    <option value="">Todas las categorías</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <button id="filter" type="submit" class="btn btn-primary">Filtrar</button>
        </form>

        <div class="card-header" id="tarjeta">
        @if (!empty($filteredElements))
            <h3>Resultados del Filtrado</h3>
            </div>
        <div class="card">
            <div class="card-body">
                <table class="table table-sm table-bordered table-striped" >
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <!-- Agrega más encabezados según tus necesidades -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($filteredElements as $element)
                        <tr>
                            <td>{{ $element->name }}</td>
                            <td>{{ $element->description }}</td>
                            <td>{{ $element->price }}</td>
                            <!-- Agrega más columnas según tus necesidades -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
        @else
            <p>No hay elementos disponibles.</p>
        @endif
    </div>

    <style>
        #filter{
            margin-top: 5px;
            margin-bottom: 5px; 
        }
        .container_inventory{
            width :90% ;
        }
    </style>

@endsection
