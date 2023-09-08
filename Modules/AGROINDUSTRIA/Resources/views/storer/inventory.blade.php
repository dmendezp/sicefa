@extends('agroindustria::layouts.master')
@include('agroindustria::layouts.partials.head')

@section('content')
<div class="content">
  <div class="container-fluid">
      <div class="d-flex justify-content-center">
        <div class="card">
              <div class="card-header">
                  <h3 class="card-title">Elementos</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" id="cardtbl">
                  <div class="btns">
                      <a href="{{ route('sica.admin.inventory.elements.create') }}" class="btn btn-primary "><i
                              class="fas fa-user-plus"></i> Agregar Elemento</a>
                  </div>
                  <br>
                  <div class="mtop16">
                      <table id="example1" class="table table-bordered table-striped">
                          <thead>
                              <tr>
                                  <th>Id</th>
                                  <th>Nombre</th>
                                  <th>Descripción</th>
                                  <th>Categoria</th>
                                  <th>Unidad</th>
                                  <th>Precio</th>
                                  <th>Acciones</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach ($inventories as $inventorie)
                              <tr>
                                <td>{{ $inventorie->id }}</td>
                                <td>{{ $inventorie->element->name}}</td>
                                <td>{{ $inventorie->element->description}}</td>
                                <td>{{ $inventorie->element->category->name}}</td>
                                <td>{{ $inventorie->stock}}</td>
                                <td>{{ $inventorie->price}}</td>
                                <td><a href="" class="btn btn-info float-right ml-1"> Editar</a><a>|  </a><a href="" class="btn btn-danger float-right ml-1"> Eliminar</a>
                                </td>

                                {{--  <td>
                                          <div class="opts">
                                            <a data-path="admin/role" data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.admin.inventory.elements.show', $e) }}')">
                                              <b class="text-primary" data-toggle="tooltip" data-placement="top" title="Ver">
                                                  <i class="fas fa-eye"></i>
                                              </b>
                                            </a>                                                    
                                            <a href="{{ route('sica.admin.inventory.elements.edit', $e) }}" data-path="admin/role"  data-toggle='tooltip' data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
                                            <a data-path="admin/role" data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.admin.inventory.elements.delete', $e->id) }}')">
                                              <b class="text-primary" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                                  <i class="fas fa-trash-alt"></i>
                                              </b>
                                            </a>
                                          </div>
                                      </td> --}}
                                     
                                  </tr>
                              @endforeach
                          </tbody>

                      </table>
                  </div>
              </div>
              <!-- /.card-body -->
          </div>

      </div>
  </div>
</div>

@endsection
