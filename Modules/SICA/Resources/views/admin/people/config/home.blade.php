@extends('sica::layouts.master')

@section('stylesheet')
@endsection

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12"> {{-- Start of event table section --}}
            <div class="card card-orange card-outline shadow">
                <div class="card-header">
                    <h3 class="card-title">Eventos</h3>
                </div>
                <div class="card-body">
                    <div>
                        <table id="example2" class="display table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Fecha de inicio</th>
                                    <th>Fecha de cierre</th>
                                    <th>Estado</th>
                                    <th>
                                        <a data-toggle="modal" data-target="#generalModal">
                                            <b class="text-success" data-toggle="tooltip" data-placement="top" title="Agregar">
                                                <i class="fas fa-plus-circle"></i>
                                            </b>
                                        </a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($events as $event)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $event->name }}</td>
                                        <td>{{ $event->description }}</td>
                                        <td>{{ $event->start_date }}</td>
                                        <td>{{ $event->end_date }}</td>
                                        <td>
                                            {{ $event->state == 'available' ? 'Disponible' : 'Deshabilidado' }} 
                                        </td>
                                        <td>
                                            <div class="opts">
                                                <a href="" class="text-info" data-toggle='tooltip' data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
                                                <a class="text-danger btn-delete" href="#" data-action="delete" data-toggle='tooltip' data-placement="top" data-object="" data-path="sica/admin/people/apprentice" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
          <div class="card card-orange card-outline shadow">
            <div class="card-header">
              <h3 class="card-title">EPS</h3>
            </div>
            <div class="card-body">
              <div>
                <table id="example2" class="display table table-bordered table-striped table-sm">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Nombre</th>
                      <th>Descripción</th>
                      <th><a href="" class="text-success" class="text-success" data-toggle='tooltip' data-placement="top" title="Agregar"><i class="fas fa-plus-circle"></i></a></th>
                    </tr>
                  </thead>
                  <tbody>

                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>
                        <div class="opts">
                          <a href="" class="text-info"  data-toggle='tooltip' data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
                          <a class="text-danger btn-delete" href="#" data-action="delete" data-toggle='tooltip' data-placement="top" data-object="" data-path="sica/admin/people/apprentice" title="Eliminar"><i class="far fa-trash-alt"></i></a>
                        </div>
                      </td>
                    </tr>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card card-orange card-outline shadow">
            <div class="card-header">
              <h3 class="card-title">Fondo pensiones</h3>
            </div>
            <div class="card-body">
              <div>
                <table id="example2" class="display table table-bordered table-striped table-sm">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Nombre</th>
                      <th>Descripción</th>
                      <th><a href="" class="text-success" data-toggle='tooltip' data-placement="top" title="Agregar"><i class="fas fa-plus-circle"></i></a></th>
                    </tr>
                  </thead>
                  <tbody>

                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>
                        <div class="opts">
                          <a href="" class="text-info" data-toggle='tooltip' data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
                          <a class="text-danger btn-delete" href="#" data-action="delete" data-toggle='tooltip' data-placement="top" data-object="" data-path="sica/admin/people/apprentice" title="Eliminar"><i class="far fa-trash-alt"></i></a>
                        </div>
                      </td>
                    </tr>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card card-orange card-outline shadow">
            <div class="card-header">
              <h3 class="card-title">Aseguradoras</h3>
            </div>
            <div class="card-body">
              <div>
                <table id="example2" class="display table table-bordered table-striped table-sm">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Nombre</th>
                      <th>Descripción</th>
                      <th><a href="" class="text-success" data-toggle='tooltip' data-placement="top" title="Agregar"><i class="fas fa-plus-circle"></i></a></th>
                    </tr>
                  </thead>
                  <tbody>

                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>
                        <div class="opts">
                          <a href="" class="text-info" data-toggle='tooltip' data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
                          <a class="text-danger btn-delete" href="#" data-action="delete" data-toggle='tooltip' data-placement="top" data-object="" data-path="sica/admin/people/apprentice" title="Eliminar"><i class="far fa-trash-alt"></i></a>
                        </div>
                      </td>
                    </tr>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card card-orange card-outline shadow">
            <div class="card-header">
              <h3 class="card-title">Población</h3>
            </div>
            <div class="card-body">
              <div>
                <table id="example2" class="display table table-bordered table-striped table-sm">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Nombre</th>
                      <th>Descripción</th>
                      <th><a href="" class="text-success" data-toggle='tooltip' data-placement="top" title="Agregar"><i class="fas fa-plus-circle"></i></a></th>
                    </tr>
                  </thead>
                  <tbody>

                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>
                        <div class="opts">
                          <a href="" class="text-info" data-toggle='tooltip' data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
                          <a class="text-danger btn-delete" href="#" data-action="delete" data-toggle='tooltip' data-placement="top" data-object="" data-path="sica/admin/people/apprentice" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                        </div>
                      </td>
                    </tr>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card card-orange card-outline shadow">
            <div class="card-header">
              <h3 class="card-title">Tipo trabajador</h3>
            </div>
            <div class="card-body">
              <div>
                <table id="example2" class="display table table-bordered table-striped table-sm">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Nombre</th>
                      <th>Descripción</th>
                      <th><a href="" class="text-success" data-toggle='tooltip' data-placement="top" title="Agregar"><i class="fas fa-plus-circle"></i></a></th>
                    </tr>
                  </thead>
                  <tbody>

                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>
                        <div class="opts">
                          <a href="" class="text-info" data-toggle='tooltip' data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
                          <a class="text-danger btn-delete" href="#" data-action="delete" data-toggle='tooltip' data-placement="top" data-object="" data-path="sica/admin/people/apprentice" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                        </div>
                      </td>
                    </tr>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card card-orange card-outline shadow">
            <div class="card-header">
              <h3 class="card-title">Dependencias</h3>
            </div>
            <div class="card-body">
              <div>
                <table id="example2" class="display table table-bordered table-striped table-sm">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Nombre</th>
                      <th>Descripción</th>
                      <th><a href="" class="text-success" data-toggle='tooltip' data-placement="top" title="Agregar"><i class="fas fa-plus-circle"></i></a></th>
                    </tr>
                  </thead>
                  <tbody>

                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>
                        <div class="opts">
                          <a href="" class="text-info" data-toggle='tooltip' data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
                          <a class="text-danger btn-delete" href="#" data-action="delete" data-toggle='tooltip' data-placement="top" data-object="" data-path="sica/admin/people/apprentice" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                        </div>
                      </td>
                    </tr>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card card-orange card-outline shadow">
            <div class="card-header">
              <h3 class="card-title">Cargos</h3>
            </div>
            <div class="card-body">
              <div>
                <table id="example2" class="display table table-bordered table-striped table-sm">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Nombre</th>
                      <th>Descripción</th>
                      <th><a href="" class="text-success" data-toggle='tooltip' data-placement="top" title="Agregar"><i class="fas fa-plus-circle"></i></a></th>
                    </tr>
                  </thead>
                  <tbody>

                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>
                        <div class="opts">
                          <a href="" class="text-info" data-toggle='tooltip' data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
                          <a class="text-danger btn-delete" href="#" data-action="delete" data-toggle='tooltip' data-placement="top" data-object="" data-path="sica/admin/people/apprentice" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                        </div>
                      </td>
                    </tr>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="generalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header py-2">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-6">

                    <div class="form-group">
                        <label>Primer nombre</label>
                        {!! Form::text('first_name', null,
                        ['class' => 'form-control', 'placeholder' => 'Ingrese su primer nombre','required']) !!}
                    </div>
                </div>
                <div class="col-sm-3">

                    <div class="form-group">
                        <label>Primer Apellido</label>
                        {!! Form::text('first_last_name', null,
                        ['class' => 'form-control', 'placeholder' => 'Ingrese su primer apellido','required']) !!}
                    </div>
                </div>
                <div class="col-sm-3">

                    <div class="form-group">
                        <label>Segundo Apellido</label>
                        {!! Form::text('second_last_name', null,
                        ['class' => 'form-control', 'placeholder' => 'Ingrese su segundo apellido','required']) !!}
                    </div>
                </div>

            </div>
        </div>
        <div class="modal-footer py-1">
          <button type="button" class="btn btn-secondary btn-md py-0" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary btn-md py-0">Guardar</button>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('script')
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
            $('table.display').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
