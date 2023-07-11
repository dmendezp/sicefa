@extends('sica::layouts.master')

@section('stylesheet')
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <h3 class="card-title">{{trans('sica::menu.Courses')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="btns">
                            <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.admin.academy.course.create') }}')" class="btn btn-primary">
                              <b data-toggle="tooltip" data-placement="top" title="Agregar">
                                <i class="fa-solid fa-file-circle-plus"></i>
                                {{trans('sica::menu.Add Course')}}
                              </b>
                            </a>
                        </div>
                        <div class="mtop16">
                            <table id="tableCourses" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>{{trans('sica::menu.Fiche')}}</th>
                                        <th>{{trans('sica::menu.Name')}}</th>
                                        <th>{{trans('sica::menu.Start Date')}}</th>
                                        <th>{{trans('sica::menu.End Date')}}</th>
                                        <th>{{trans('sica::menu.Status')}}</th>
                                        <th>{{trans('sica::menu.Deschooling')}}</th>
                                        <th>{{trans('sica::menu.Actions')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($courses as $c)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $c->code }}</td>
                                            <td>{{ $c->program->name }}</td>
                                            <td>{{ $c->star_date }}</td>
                                            <td>{{ $c->end_date }}</td>
                                            <td>{{ $c->status }}</td>
                                            <td>{{ $c->deschooling }}</td>
                                            <td>
                                                <div class="opts">
                                                  <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.admin.academy.course.edit', $c->id) }}')">
                                                    <b class="text-info" data-toggle="tooltip" data-placement="top" title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </b>
                                                  </a>
                                                  <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.admin.academy.course.destroy') }}/{{ $c->id }}')">
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
                "responsive": true,
                "autoWidth": false,
            });
        });
    </script>
@endsection
