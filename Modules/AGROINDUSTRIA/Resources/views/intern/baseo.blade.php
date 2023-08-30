@extends('agroindustria::layouts.master')
@include('agroindustria::layouts.partials.head')

@section('content')

<div class="card">
            <center>
                <div class="card-header">
                    INVENTARIO DE ASEO
                </div>
            </center>
    <div class="card-body">
        <!-- Botón para abrir el formulario de creación de producto-->
     

            <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" id="create" data-bs-toggle="modal" data-bs-target="#exampleModal">
    AGREGAR
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">AGREGAR ELEMETO DE ASEO</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ...
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
                <th>Precio</th>
               
                <th>Acciones</th>
            </tr>
        </thead>
            <tbody>
                <td></td>
                <td></td>
                <td></td>
              

                <td>
                  <!-- Botones de acciones -->
                  
                      <button class="btn btn-primary btn-sm" id="edit" data-toggle="modal">
                        <i class="fa-regular fa-pen-to-square fa-2xl"></i>                      </button>
                   <br>
                   <br>
                      <button class="btn btn-danger btn-sm" id="delete" data-toggle="modal">
                        <i class="fa-solid fa-trash fa-2xl"></i>
                      </button>
                  
                </td>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal para crear -->

@endsection
