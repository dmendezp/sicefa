@extends('agroindustria::layouts.master')
@include('agroindustria::layouts.partials.head')

@section('content')

<div class="card">
    <center>
        <div class="card-header">
            INVENTARIO DE INSUMOS
        </div>
    </center>
    <div class="card-body">
        <!-- Botón para abrir el formulario de creación de producto-->
        <button type="button" class="btn btn-primary" id="create" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fa-solid fa-plus fa-2xl"></i>
        </button>

        <!-- Modal de Creación -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">AGREGAR ELEMENTO DE INSUMOS</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{-- formulario de agregar insumo --}}
                        <form>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="name">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Descripción</label>
                                <input type="text" class="form-control" id="description">
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Precio</label>
                                <input type="text" class="form-control" id="price">
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Imagen</label>
                                <input type="text" class="form-control" id="image">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="close" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" id="keep" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($elements as $element)
                <tr>
                    <td>{{$element->id}}</td>
                    <td>{{$element->name}}</td>
                    <td>{{$element->description}}</td>
                    <td>{{$element->price}}</td>
                    <td>{{$element->image}}</td>
                    <td>
                      <tr>
                        <!-- Botón de edición -->
                        <button type="button" class="btn btn-primary edit-btn" data-bs-toggle="modal"
                            data-bs-target="#editModal" data-id="{{$element->id}}" data-name="{{$element->name}}"
                            data-description="{{$element->description}}" data-price="{{$element->price}}"
                            data-image="{{$element->image}}">
                            <i class="fa-regular fa-pen-to-square fa-2xl"></i>
                        </button>
                      </tr>
                      <tr>
                         <!-- Botón de eliminación -->
                         <button class="btn btn-danger deleteButton" data-id="{{ $element->id }}" data-bs-toggle="modal" data-bs-target="#deleteModal">
                          <i class="fas fa-trash-alt"></i>
                      </button>
                      </tr>
               
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal de Edición -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <!-- El contenido del modal de edición se carga dinámicamente cuando se hace clic en el botón de edición -->
</div>

<!-- Modal de Eliminación -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <!-- El contenido del modal de eliminación se carga dinámicamente cuando se hace clic en el botón de eliminación -->
</div>

<!-- Script para llenar campos de edición con los datos -->
<script>
    $(document).ready(function () {
        $('.edit-btn').on('click', function () {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var description = $(this).data('description');
            var price = $(this).data('price');
            $('#editModalLabel').text('EDITAR INSUMO - ' + name);
        });

        $('.deleteButton').on('click', function () {
            var id = $(this).data('id');
            $('#deleteModal').load('{{ route('agroindustria.storer.delete') }}/' + id);
        });
    });
</script>
@endsection
