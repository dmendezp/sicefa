@extends('senaempresa::layouts.master')
@section('content')
<div class="col-md-12" id="card-works"> {{-- Start of events table section --}}
            <div class="card card-primary card-outline shadow">
                <div class="card-header">
                    <h3 class="card-title">Works</h3>
                </div>
                <div class="card-body">
                    <div>
                        <table id="example2" class="display table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Unidad Productiva</th>
                                    <th>
                                        <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('work.create') }}')">
                                            <b class="text-success" data-toggle="tooltip" data-placement="top" title="Agregar">
                                                <i class="fas fa-plus-circle"></i>
                                            </b>
                                        </a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($works as $work)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $work->name }}</td>
                                        <td>{{ $work->description }}</td>
                                        <td>{{ $work->productive_unit->name }}</td>
                                        <td>
                                        <div class="opts">
                                                <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('works.edit') }}/{{ $work->id }}')">
                                                    <b class="text-info" data-toggle="tooltip" data-placement="top" title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </b>
                                                </a>
                                                <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('works.destroy') }}/{{ $work->id }}')">
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
        {{-- End of events table section --}}




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

@section('scripts')
<script>
        @if (Session::get('message'))
            $('html, body').animate({ /* Move the page to the previously selected configuration */
                scrollTop: $("#{{ Session::get('card') }}").offset().top
            }, 1000);
            /* Show the message */
            @if (Session::get('icon') == 'success')
                toastr.success("{{ Session::get('message') }}");
            @elseif (Session::get('icon')=='error')
                toastr.error("{{ Session::get('message') }}");
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
                "searching": true,
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
            e.value = e.value();
        }
    </script>
    @endsection