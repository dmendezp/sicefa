@php
    $role_name = getRoleRouteName(Route::currentRouteName()); // Obtener el rol a partir del nombre de la ruta en la cual ha sido invocada esta vista
@endphp

@extends('sica::layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <h3 class="card-title">{{trans('sica::menu.Knowledge Networks')}}</h3>
                        <div class="btns">
                            @if (Auth::user()->havePermission('sica.'.$role_name.'.academy.lines.index'))
                                <a href="{{ route('sica.'.$role_name.'.academy.lines.index') }}" class="btn btn-info float-right ml-1">
                                    <i class="fa-solid fa-angles-right fa-beat-fade"></i>
                                    {{trans('sica::menu.Technological lines')}}
                                </a>
                            @endif
                            @if (Auth::user()->havePermission('sica.'.$role_name.'.academy.programs.index'))
                                <a href="{{ route('sica.'.$role_name.'.academy.programs.index') }}" class="btn btn-info float-right ml-1">
                                    <i class="fa-solid fa-angles-left fa-beat-fade"></i>
                                    {{trans('sica::menu.Formation Programs')}}
                                </a>
                            @endif
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div>
                            <table id="tableNetworks" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>{{trans('sica::menu.Knowledge Networks')}}</th>
                                        <th>{{trans('sica::menu.Networks')}}</th>
                                        <th class="text-center">{{trans('sica::menu.Actions')}}
                                            @if (Auth::user()->havePermission('sica.'.$role_name.'.academy.networks.create'))
                                                <a class="mx-3" data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.'.$role_name.'.academy.knowledge.networks.create') }}')">
                                                    <b class="text-success" data-toggle="tooltip" data-placement="top" title="Registrar red de conocimiento">
                                                        <i class="fas fa-plus-circle"></i>
                                                    </b>
                                                </a>
                                            @endif
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($knowledgenetworks as $knowledgenetwork)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $knowledgenetwork->name }}</td>
                                            <td>{{ $knowledgenetwork->network->name }}</td>
                                            <td class="text-center">
                                                <div class="opts">
                                                    @if (Auth::user()->havePermission('sica.'.$role_name.'.academy.networks.edit'))
                                                        <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.'.$role_name.'.academy.knowledge.networks.edit', $knowledgenetwork->id) }}')">
                                                            <b class="text-info" data-toggle="tooltip" data-placement="top" title="Actualizar red de conocimiento">
                                                                <i class="fas fa-edit"></i>
                                                            </b>
                                                        </a>
                                                    @endif
                                                    @if (Auth::user()->havePermission('sica.'.$role_name.'.academy.networks.delete'))
                                                        <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.'.$role_name.'.academy.knowledge.networks.delete', $knowledgenetwork->id) }}')">
                                                            <b class="text-danger" data-toggle="tooltip" data-placement="top" title="Eliminar red de conocimiento">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </b>
                                                        </a>
                                                    @endif
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
    <div class="modal fade" id="generalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" role="document">
            <div class="modal-content" id="modal-content"></div>
        </div>
    </div>
    <div id="loader" style="display: none;"> {{-- Loader modal --}}
        <div class="modal-body text-center" id="modal-loader">
            <div class="spinner-border" role="status">
                <span class="sr-only">{{trans('sica::menu.Loading Content')}}</span>
            </div><br>
            <b id="loader-message"></b>
        </div>
    </div>
@endsection

@section('script')
    <script>
        @if (Session::get('message_network'))
            /* Show the message */
            @if (Session::get('icon') == 'success')
                toastr.success("{{ Session::get('message_network') }}");
            @elseif (Session::get('icon') == 'error')
                toastr.error("{{ Session::get('message_network') }}");
            @endif
        @endif

        function ajaxAction(route) {
            /* Ajax to show content modal to add line */
            $('#loader-message').text("{{trans('sica::menu.Loading Content')}}"); /* Add content to loader */
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
        $(document).ready(function() {
            /* Initialización of Datatables Lines */
            $('#tableNetworks').DataTable({
                columnDefs: [{
                    orderable: false,
                    targets: 3
                }]
            });
        });
    </script>
@endsection
