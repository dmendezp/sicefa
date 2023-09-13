@extends('sica::layouts.master')

@section('stylesheet')
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <h3 class="card-title">Elementos</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="btns">
                            <a href="{{ route('sica.admin.inventory.elements.create') }}" class="btn btn-primary "><i
                                    class="fas fa-user-plus"></i> Agregar Elemento</a>
                            <a href="" class="btn btn-info float-right ml-1"> Categorias</a>
                            <a href="" class="btn btn-info float-right ml-1"> Lineas</a>

                        </div>
                        <div class="mtop16">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Unidad</th>
                                        <th>Descripción</th>
                                        <th>Linea</th>
                                        <th>Categoria</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($elements as $e)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $e->name }}</td>
                                            <td>{{ $e->measurement_unit->name }}</td>
                                            <td>{{ $e->description }}</td>
                                            <td>{{ $e->kind_of_purchase->name }}</td>
                                            <td>{{ $e->category->name }}</td>
                                            <td>
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
                                            </td>
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
            $('html, body').animate({
                /* Move the page to the previously selected configuration */
                scrollTop: $("#{{ Session::get('card') }}").offset().top
            }, 1000);
            /* Show the message */
            @if (Session::get('icon') == 'success')
                toastr.success("{{ Session::get('message_config') }}");
            @elseif (Session::get('icon') == 'error')
                toastr.error("{{ Session::get('message_config') }}");
            @endif
        @endif
        function ajaxAction(route) {
            /* Ajax to show content modal to add event */
            $('#loader-message').text('Cargando contenido...'); /* Add content to loader */
            $('#modal-content').append($('#modal-loader').clone()); /* Add the loader to the modal */
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKE': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                    method: "get",
                    url: route,
                    data: {}
                })
                .done(function(html) {
                    $("#modal-content").html(html);
                });
        }

        // Vaciar el contenido del modal cuando sea cerrado
        $("#generalModal").on("hidden.bs.modal", function() {
            $("#modal-content").empty();
        });
    </script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
            $('#example2').DataTable({
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
