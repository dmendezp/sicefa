@extends('sica::layouts.master')

@section('stylesheet')
@endsection

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6" id="card-eps">  {{-- Start of eps table section --}}
          <div class="card card-orange card-outline shadow">
            <div class="card-header">
                <h3 class="card-title">EPS</h3>
            </div>
            <div class="card-body">
                <div>
                    <table id="example2" class="display table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>
                                <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.admin.people.config.eps.add') }}')">
                                    <b class="text-success" data-toggle="tooltip" data-placement="top" title="Agregar">
                                        <i class="fas fa-plus-circle"></i>
                                    </b>
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($epss as $eps)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $eps->name }}</td>
                                <td>
                                    <div class="opts">
                                        <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.admin.people.config.eps.edit') }}/{{ $eps->id }}')">
                                            <b class="text-info" data-toggle="tooltip" data-placement="top" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </b>
                                        </a>
                                        <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.admin.people.config.eps.delete') }}/{{ $eps->id }}')">
                                            <b class="text-danger" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                                <i class="fas fa-trash-alt"></i>
                                            </b>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
          </div>
        </div>  {{-- End of eps table section --}}
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
        <div class="col-md-6" id="card-population"> {{-- Start of population table section --}}
            <div class="card card-orange card-outline shadow">
                <div class="card-header">
                    <h3 class="card-title">Población</h3>
                </div>
                <div class="card-body">
                    <div>
                        <table id="example2" class="display table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>
                                        <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.admin.people.config.population.add') }}')">
                                            <b class="text-success" data-toggle="tooltip" data-placement="top" title="Agregar">
                                                <i class="fas fa-plus-circle"></i>
                                            </b>
                                        </a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($populations as $population)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $population->name }}</td>
                                        <td>{{ $population->description }}</td>
                                        <td>
                                            <div class="opts">
                                                <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.admin.people.config.population.edit') }}/{{ $population->id }}')">
                                                    <b class="text-info" data-toggle="tooltip" data-placement="top" title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </b>
                                                </a>
                                                <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.admin.people.config.population.delete') }}/{{ $population->id }}')">
                                                    <b class="text-danger" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </b>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> {{-- End of population table section --}}
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
        <div class="col-md-12" id="card-events"> {{-- Start of events table section --}}
            <div class="card card-orange card-outline shadow">
                <div class="card-header">
                    <h3 class="card-title">Eventos</h3>
                </div>
                <div class="card-body">
                    <div>
                        <table id="example2" class="display table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Fecha de inicio</th>
                                    <th>Fecha de cierre</th>
                                    <th>Estado</th>
                                    <th>
                                        <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.admin.people.config.event.add') }}')">
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
                                                <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.admin.people.config.event.edit') }}/{{ $event->id }}')">
                                                    <b class="text-info" data-toggle="tooltip" data-placement="top" title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </b>
                                                </a>
                                                <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.admin.people.config.event.delete') }}/{{ $event->id }}')">
                                                    <b class="text-danger" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </b>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> {{-- End of events table section --}}
    </div>
  </div>
</div>

<!-- General modal -->
<div class="modal fade" id="generalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
      <div class="modal-content" id="modal-content"></div>
    </div>
</div>
<div id="loader" style="display: none;"> {{-- Loader modal --}}
    <div class="modal-body text-center" id="modal-loader">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div><br>
        <b id="loader-message"></b>
    </div>
</div>
@endsection
@section('script')
    <script>
        @if (Session::get('message_config'))
            $('html, body').animate({ /* Move the page to the previously selected configuration */
                scrollTop: $("#{{ Session::get('card') }}").offset().top
            }, 1000);
            /* Show the message */
            @if (Session::get('icon') == 'success')
                toastr.success("{{ Session::get('message_config') }}");
            @elseif (Session::get('icon')=='error')
                toastr.error("{{ Session::get('message_config') }}");
            @endif
        @endif

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

        function ajaxAction(route){ /* Ajax to show content modal to add event */
            $('#loader-message').text('Cargando contenido...'); /* Add content to loader */
            $('#modal-content').append($('#modal-loader').clone()); /* Add the loader to the modal */
            $.ajaxSetup({
                headers:     {
                    'X-CSRF-TOKE': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "get",
                url: route,
                data: {}
            })
            .done(function(html){
                $("#modal-content").html(html);
            });
        }

        $("#generalModal").on("hidden.bs.modal", function () { /* Modal content is removed when the modal is closed */
            $("#modal-content").empty();
        });

        function mayus(e) { /* Convert the content of a field to uppercase */
            e.value = e.value.toUpperCase();
        }
    </script>
@endsection
