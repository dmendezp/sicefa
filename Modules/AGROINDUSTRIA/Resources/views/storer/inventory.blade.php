@extends('agroindustria::layouts.master')
@include('agroindustria::layouts.partials.head')

@section('content')
<center>
  
  <div class="card-datatable">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="insumos-tab" data-bs-toggle="tab" data-bs-target="#insumos" type="button" role="tab" aria-controls="insumos" aria-selected="true">Insumos</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="agregar-tab" data-bs-toggle="tab" data-bs-target="#agregar" type="button" role="tab" aria-controls="agregar" aria-selected="false">Agregar</button>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
      {{-- DataTable --}}
        <div class="tab-pane fade show active" id="insumos" role="tabpanel" aria-labelledby="insumos-tab">
            <table id="tabla-insumos" class="table table-hover text-center">
              <br>
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Id</th>
                        <th>|</th>
                        <th>Nombre</th>
                         <th>|</th>
                        <th>Descripcion</th>
                         <th>|</th>
                        <th>Categoria</th>
                         <th>|</th>
                        <th>Disponible</th>
                        <th>|</th>
                        <th>Precio</th>
                        <th>|</th>
                        <th>Acciones</th>
                        
                </thead>
                <tbody>
                  @foreach ($inventories as $inventorie)
                  <tr>
                    <td></td>
                    <td></td>

                      <td>{{ $inventorie->element->name }}</td>
                      <td>|</td>
                      <td>{{ $inventorie->element->category_id }}</td>
                      <td>|</td>
                      <td>--</td>
                      <td>|</td>
                      <td>--</td>
                      <td>|</td>
                      --
                      <td>|</td>
                      <td>--</td>
                      <td>|</td>
                      <td>
                         <!-- Button edit -->
                         <button type="button" class="btn btn-primary" id="edit" data-bs-toggle="modal" data-bs-target="#editmodal">
                          <i class="fa-solid fa-pen-to-square fa-lg"></i>
                        </button>
                        |
                        {{-- Moldal editar inventario. --}}
                        <!-- Modal -->
                            <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Editar inventario</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    ...
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-danger btn-ms" id="close" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="button" id="savechanges" class="btn btn-primary btn-ms">Guardar</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                        <!-- Button delete -->
                        <button class="btn btn-danger btn-sm" id="delete">
                          <i class="fa-solid fa-trash fa-lg"></i>
                        </button>

                      </td>
                        </tr> <!-- ... Código de los botones de editar y eliminar ... -->
                      </td>
                  </tr>
              @endforeach
                          
                    
                </tbody>
            </table>
        </div>

          {{-- Formulario para agregar elementos al invantario --}}
  
  <div class="tab-pane fade" id="agregar" role="tabpanel" aria-labelledby="agregar-tab">
    <form action="" method="POST">
        <div class="mb-3"><br>
          <center><h1>AGREGAR INSUMO</h1>
            <br>
            <div class="container text-center">
              <div class="row">
                <div class="col">
                  <label for="disabledTextInput"  class="form-label">Nombre de insumo.</label>
                  <input type="text" style="width: 400px; height: 50px;" id="disabledTextInput" class="form-control" placeholder="Ingrese nombre de insumos.">
                  <br>
                  <label for="disabledTextInput" class="form-label">Descripcion.</label>
                  <input type="text" style="width: 400px; height: 50px;" id="disabledTextInput" class="form-control" placeholder="Ingrese descripcion de insumo.">
                  <br>
                  <label for="disabledTextInput" placeholder="Selecciona tipo de compra." class="form-label">Tipo de compra.</label>
                  <select class="form-select" aria-label="Default select example">
                    <option selected>Open this select menu</option>
                   
                  </select>
                  <br>
                </div>
                <div class="col">
                  <label for="disabledTextInput" class="form-label">Categoria.</label>
                  <select class="form-select" aria-label="Default select example">
                    
                  </select> 
                  
                                   <br>
                  <label for="disabledTextInput" class="form-label">precio.</label>
                  <input type="text" style="width: 400px; height: 50px;" id="disabledTextInput" class="form-control" placeholder="Ingrese Precio de insumo.">    
                  <br>
                  <label for="disabledTextInput" class="form-label">imagen.</label>
                  <input type="text" style="width: 400px; height: 50px;" id="disabledTextInput" class="form-control" placeholder="Ingrese Imagen de insumo.">  
                </div>
              </div>
            </div>
            <label for="disabledTextInput" class="form-label">slug.</label>
            <input type="text" style="width: 400px; height: 50px;" id="disabledTextInput" class="form-control" placeholder="Ingrese slug.">  
          


          
       
        </center>
        <br>
       
        <button type="button" id="saveformadd"  class="btn btn-success">Guardar</button>

        </div>  
      
      
    </form>
    <br><br>
  </div>
    </div>
</div>{{-- Fin tarjeta DataTable --}}



</center>

@endsection
