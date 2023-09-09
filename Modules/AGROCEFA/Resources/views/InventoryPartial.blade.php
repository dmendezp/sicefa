@if (!empty($inventory) && count($inventory) > 0)
    <div class="card">
        <div class="card-header">
            Registros
            <button class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#crearspecie"><i
                    class='bx bx-plus icon'></i></button>
        </div>
        <div class="card-body">
            <table class="table table-sm table-bordered table-striped" style="font-size: 0.9rem;">
                <thead>
                    <tr>
                        <th>ID</th>
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
                            <td>{{ $item->productive_unit_warehouse->warehouse->name }}</td>
                            <td>{{ $item->element->name }}</td>
                            <td>{{ $item->element->description }}</td>
                            <td>{{ $item->element->category->name }}</td>
                            <td>{{ $item->price }}</td>
                            <td>
                                <div class="button-group">
                                    <button class="btn btn-primary btn-sm btn-edit-specie" data-bs-toggle="modal"
                                        data-bs-target="#editarEspecieModal_" data-specie-id=""><i
                                            class='bx bx-edit icon'></i></button>
                                    <button id="delete" class="btn btn-danger btn-sm btn-delete-activity"
                                        data-bs-toggle="modal" data-bs-target="#eliminarspecie_"><i
                                            class='bx bx-trash icon'></i></button>
                                </div>
                            </td>
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
