@if (!empty($inventory) && count($inventory) > 0)
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
                        <th>Acciones</th>
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
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @else
    <!-- Aquí muestras el mensaje cuando no hay registros -->
    <br>
    <p>No hay registros disponibles.</p>
    @endif

