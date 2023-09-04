@extends('agroindustria::layouts.master')
@include('agroindustria::layouts.partials.head')

@section('content')

<div class="card">
            <center>
                <div class="card-header">
                    INVENTARIO DE ENVASES
                </div>
            </center>
    <div class="card-body">
        <!-- Botón para abrir el formulario de creación de producto-->
     

            <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" id="create" data-bs-toggle="modal" data-bs-target="#exampleModal">
  <i class="fa-solid fa-plus fa-2xl"></i>
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">AGREGAR ELEMETO DE ENVASES</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
           {{-- formulario de agrefar insumo --}}
          <form>
            <div class="mb-3">
              <label for="name" class="form-label">Nombre</label>
              <input type="tetx" class="form-control" id="name">
            </div>
            <div class="mb-3">
              <label for="account" class="form-label">Cantidad</label>
              <input type="tetx" class="form-control" id="account">
            </div>
            <div class="mb-3">
              <label for="lot" class="form-label">Lote</label>
              <input type="tetx" class="form-control" id="lot">
            </div>
            <div class="mb-3">
              <label for="category" class="form-label">Categoria</label>
              <input type="tetx" class="form-control" id="category">
            </div>
          </form>

        </div>
        <div class="modal-footer">
            <button type="button" id="close" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" id="keep"class="btn btn-primary">Guardar</button>
        </div>
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
                <td></td>
                <td></td>
                <td></td>
                <td></td>

                <td>
                  <th>
                    <!-- Botones de acciones -->
                  
                    {{-- boton de edicion de elementos de inventario --}}
                  
                    <button type="button" class="btn btn-primary" id="edit" data-bs-toggle="modal" data-bs-target="#editModal">
                    <i class="fa-regular fa-pen-to-square fa-2xl"></i> 
                  </button>

                    {{-- boton de eliminacion de elementos de inventario --}}

                  <button class="btn btn-danger btn-sm" id="delete" data-toggle="modal">
                    <i class="fa-sharp fa-solid fa-trash fa-2xl"></i>
                  </button>
              </th>
                  
                                    <!-- Modal -->
                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editModalLabel">EDITAR INSUMO </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                         {{-- formulario de edicion de En --}}
          <form>
            <div class="mb-3">
              <label for="name" class="form-label">Nombre</label>
              <input type="tetx" class="form-control" id="name">
            </div>
            <div class="mb-3">
              <label for="account" class="form-label">Cantidad</label>
              <input type="tetx" class="form-control" id="account">
            </div>
            <div class="mb-3">
              <label for="lot" class="form-label">Lote</label>
              <input type="tetx" class="form-control" id="lot">
            </div>
            <div class="mb-3">
              <label for="category" class="form-label">Categoria</label>
              <input type="tetx" class="form-control" id="category">
            </div>
          </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" id="close" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" id="keep"class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                    </div>
                </div>

                            </div>
                  
                     
                   <br>
                   <br>
                      
                  
                </td>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal para crear -->

@endsection
