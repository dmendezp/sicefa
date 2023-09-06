@extends('agroindustria::layouts.master')
@include('agroindustria::layouts.partials.head')

@section('content')
<center>
  
  <div class="card">
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
                        <th>Descripción</th>
                         <th>|</th>
                        <th>Precio</th>
                         <th>|</th>
                        <th>Slug</th>
                        <th>|</th>

                        <th>Acciones</th>
                        
                </thead>
                <tbody>
                    @foreach ($elements as $element)
                        <tr>
                          <td></td>
                          <td></td>

                            <td>{{ $element->id }}</td>
                            <td>|</td>
                            <td>{{ $element->name }}</td>
                            <td>|</td>   
                            <td>{{ $element->description }}</td>
                            <td>|</td>
                            <td>{{ $element->price }}</td>
                            <td>|</td>
                            <td>{{ $element->slug }}</td>
                            <td>|</td>

                                         <td>
                          <!-- Button edit -->
                          <button type="button" class="btn btn-primary" id="edit" data-bs-toggle="modal" data-bs-target="#editmodal">Editar</button>
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
                          <button class="btn btn-danger btn-sm" id="delete">Eliminar</button>

                        </td>
                          </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

          {{-- Formulario para agregar elementos al invantario --}}
  
  <div class="tab-pane fade" id="agregar" role="tabpanel" aria-labelledby="agregar-tab">
    <form action="" method="POST">
      <div class="card" style=" height: 600px; " id="cardformagg">
        <div class="mb-3"><br>
          <center><h1>AGREGAR INSUMO</h1>
            <br>
          <label for="disabledTextInput"  class="form-label">Nombre</label>
          <input type="text" style="width: 600px; height: 50px;" id="disabledTextInput" class="form-control" placeholder="Ingrese Nombre">
          <br>
          <label for="disabledTextInput" class="form-label">Categoria</label>
          <input type="text" style="width: 600px; height: 50px;" id="disabledTextInput" class="form-control" placeholder="Ingrese Categoria">
          <br>
          <label for="disabledTextInput" class="form-label">Cantidad</label>
          <input type="text" style="width: 600px; height: 50px;" id="disabledTextInput" class="form-control" placeholder="Ingrese Cantidad">
          <br>
          <label for="disabledTextInput" class="form-label">Precio</label>
          <input type="text" style="width: 600px; height: 50px;" id="disabledTextInput" class="form-control" placeholder="Ingrese Precio">  
        </center>
        <br>
        <button type="button" id="saveformadd" class="btn btn-primary btn-ms">Guardar</button>

        </div>  
      </div>
      
    </form>
    <br><br>
  </div>
    </div>
</div>{{-- Fin tarjeta DataTable --}}



</center>

@endsection
