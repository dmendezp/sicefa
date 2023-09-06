
@extends('agrocefa::layouts.master')

@section('content')
    <h1>Inventario</h1>
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
    @if (!empty($inventory))

    <div class="card">
        <div class="card-header">
            <h3>Registros de Inventario</h3>
        </div>
    <div class="card-body">
    <table class="table table-sm table-bordered table-striped" style="font-size: 0.9rem;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Unidad productiva</th>
                <th>Bodega</th>
                <th>Elemento</th>
                <th>Descripcion</th>
                <th>Categoria</th>
                <th>Precio</th>

                <!-- Agrega más encabezados según tus necesidades -->
            </tr>
        </thead>
        <tbody>
            @foreach ($inventory as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->productive_unit_warehouse->productive_unit->name}}</td>
                    <td>{{ $item->productive_unit_warehouse->warehouse->name}}</td>
                    <td>{{ $item->element->name}}</td>
                    <td>{{ $item->element->description}}</td>
                    <td>{{ $item->element->category->name}}</td>
                    <td>{{ $item->price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
    @else
    <p>No hay registros disponibles.</p>
    @endif


    <style>
        #filter {
            margin-top: 5px;
            margin-bottom: 5px;
        }
        .container_inventory {
            margin-right: 50px;
        }
    </style>

@endsection
