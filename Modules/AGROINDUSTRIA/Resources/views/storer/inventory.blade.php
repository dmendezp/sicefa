@extends('agroindustria::layouts.master')
@include('agroindustria::layouts.partials.head')

@section('content')
<center>
  R
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
                          <button class="btn btn-info btn-sm" id="edit">Editar</button>
                          |
                          <!-- Button delete -->
                          <button class="btn btn-danger btn-sm" id="delete">Eliminar</button>

                        </td>
                          </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

          {{-- Formulario para agregar elementos al invantario --}}
  
  <div class="tab-pane fade" id="agregar" role="tabpanel" aria-labelledby="agregar-tab">Vista de agregar Insumos</div>
    </div>
</div>


</center>

@endsection
