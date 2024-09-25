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
                        <h3 class="card-title">{{ trans('sica::menu.Courses') }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="btns">
                            @if (Auth::user()->havePermission('sica.'.$role_name.'.academy.courses.create'))
                                <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.'.$role_name.'.academy.courses.create') }}')" class="btn btn-success">
                                    <i class="fa-solid fa-file-circle-plus"></i>
                                    {{ trans('sica::menu.Add Course') }}
                                </a>
                            @endif
                        </div>
                        <div class="mtop16">
                            <table id="tableCourses" class="display table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>{{ trans('sica::menu.Fiche') }}</th>
                                        <th>{{ trans('sica::menu.Name') }}</th>
                                        <th>{{ trans('sica::menu.Leading Instructor') }}</th>
                                        <th>{{ trans('sica::menu.Start Date') }}</th>
                                        <th>{{ trans('sica::menu.End Of School Year') }}</th>
                                        <th>{{ trans('sica::menu.Start Productive') }}</th>
                                        <th>{{ trans('sica::menu.End Date') }}</th>
                                        <th>{{ trans('sica::menu.Status') }}</th>
                                        <th>{{ trans('sica::menu.Modality') }}</th>
                                        <th class="text-center">{{ trans('sica::menu.Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($courses as $c)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $c->code }}</td>
                                            <td>{{ $c->program->name }}</td>
                                            <td>{{ $c->person->full_name }}</td>
                                            <td>{{ $c->star_date }}</td>
                                            <td>{{ $c->school_end_date }}</td>
                                            <td>{{ $c->star_production_date }}</td>
                                            <td>{{ $c->end_date }}</td>
                                            <td>{{ $c->status }}</td>
                                            <td>{{ $c->deschooling }}</td>
                                            <td class="text-center">
                                                <div class="opts">
                                                    @if (Auth::user()->havePermission('sica.'.$role_name.'.academy.courses.edit'))
                                                        <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.'.$role_name.'.academy.courses.edit', $c->id) }}')">
                                                            <b class="text-primary" data-toggle="tooltip" data-placement="top" title="Actualizar titulada">
                                                                <i class="fas fa-edit"></i>
                                                            </b>
                                                        </a>
                                                    @endif
                                                    @if (Auth::user()->havePermission('sica.'.$role_name.'.academy.courses.delete'))
                                                        <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.'.$role_name.'.academy.courses.delete', $c->id) }}')">
                                                            <b class="text-danger" data-toggle="tooltip" data-placement="top" title="Eliminar titulada">
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
        @if (Session::get('message_course'))
            /* Show the message */
            @if (Session::get('icon') == 'success')
                toastr.success("{{ Session::get('message_course') }}");
            @elseif (Session::get('icon') == 'error')
                toastr.error("{{ Session::get('message_course') }}");
            @endif
        @endif

        function ajaxAction(route) {
            /* Ajax to show content modal to add line */
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
        $(document).ready(function() {
            /* Initialización of Datatables Lines */
            $('#tableCourses').DataTable({
                columnDefs: [{
                    orderable: false,
                    targets: 7
                }]
            });
        });
    </script>
@endsection
