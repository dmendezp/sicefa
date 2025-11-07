@extends('sica::layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <h3 class="card-title">{{ trans('sica::menu.Warehouses') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="mtop16">
                            <table id="warehouses_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans('sica::menu.Name') }}</th>
                                        <th>{{ trans('sica::menu.Description') }}</th>
                                        <th>{{ trans('sica::menu.Application') }} </th>
                                        <th class="col-2">{{ trans('sica::menu.Actions') }}
                                            <a class="mx-3" data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.admin.inventory.warehouse.create') }}')">
                                                <b class="text-success" data-toggle="tooltip" data-placement="top" title="Registrar Bodega">
                                                    <i class="fas fa-plus-circle"></i>
                                                </b>
                                            </a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($warehouses as $w)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $w->name }}</td>
                                            <td>{{ $w->description }}</td>
                                            <td>{{ $w->app->name }}</td>
                                            <td class="text-center">
                                                <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.admin.inventory.warehouse.edit', $w->id) }}')">
                                                    <b class="text-info" data-toggle="tooltip" data-placement="top" title="Actualizar Bodega">
                                                        <i class="fas fa-edit"></i>
                                                    </b>
                                                  </a>
                                                <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.admin.inventory.warehouse.delete', $w->id) }}')">
                                                    <b class="text-danger" data-toggle="tooltip" data-placement="top" title="Eliminar Bodega">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </b>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- General modal -->
    <div class="modal fade" id="generalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
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
        $(function () {
            $("#warehouses_table").DataTable({
                "responsive": true
            });
        });
    </script>
    <script>
        @if (Session::get('message_warehouse'))
            /* Show the message */
            @if (Session::get('icon') == 'success')
                toastr.success("{{ Session::get('message_warehouse') }}");
            @elseif (Session::get('icon') == 'error')
                toastr.error("{{ Session::get('message_warehouse') }}");
            @endif
        @endif
      
        function ajaxAction(route) {
            /* Ajax to show content modal to add line */
            $('#loader-message').text("{{ trans('sica::menu.Loading Content') }}"); /* Add content to loader */
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
@endsection
