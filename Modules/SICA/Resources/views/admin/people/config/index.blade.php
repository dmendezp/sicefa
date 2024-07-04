@php
    $role_name = getRoleRouteName(Route::currentRouteName()); // Obtener el rol a partir del nombre de la ruta en la cual ha sido invocada esta vista
@endphp

@extends('sica::layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-6" id="eps-card"> {{-- Inicio de la sección de la tabla eps --}}
                    <div class="card card-orange card-outline shadow">
                        <div class="card-header">
                            <h3 class="card-title">EPS</h3>
                        </div>
                        <div class="card-body">
                            <div>
                                <table id="eps_table" class="display table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Nombre</th>
                                            <th class="text-center">
                                                @if (Auth::user()->havePermission('sica.'.$role_name.'.people.config.eps.create'))
                                                    <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.'.$role_name.'.people.config.eps.create') }}')">
                                                        <b class="text-success" data-toggle="tooltip" data-placement="top" title="Registrar EPS">
                                                            <i class="fas fa-plus-circle"></i>
                                                        </b>
                                                    </a>
                                                @endif
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($epss as $eps)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $eps->name }}</td>
                                                <td class="text-center">
                                                    <div class="opts">
                                                        @if (Auth::user()->havePermission('sica.'.$role_name.'.people.config.eps.edit'))
                                                            <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.'.$role_name.'.people.config.eps.edit', $eps->id) }}')">
                                                                <b class="text-info" data-toggle="tooltip" data-placement="top" title="Actualizar EPS">
                                                                    <i class="fas fa-edit"></i>
                                                                </b>
                                                            </a>
                                                        @endif
                                                        @if (Auth::user()->havePermission('sica.'.$role_name.'.people.config.eps.delete'))
                                                            <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.'.$role_name.'.people.config.eps.delete', $eps->id) }}')">
                                                                <b class="text-danger" data-toggle="tooltip" data-placement="top" title="Eliminar EPS">
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
                </div> {{-- Fin de la sección de la tabla eps --}}
                <div class="col-md-6"> {{-- Inicio de la tabla de grupos poblacionales --}}
                    <div class="card card-orange card-outline shadow">
                        <div class="card-header">
                            <h3 class="card-title">Grupos poblacionales</h3>
                        </div>
                        <div class="card-body">
                            <div>
                                <table id="population_groups_table" class="display table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Nombre</th>
                                            <th>Descripción</th>
                                            <th class="text-center">
                                                @if (Auth::user()->havePermission('sica.'.$role_name.'.people.config.population.create'))
                                                    <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.'.$role_name.'.people.config.population.create') }}')">
                                                        <b class="text-success" data-toggle="tooltip" data-placement="top" title="Registrar grupo poblacional">
                                                            <i class="fas fa-plus-circle"></i>
                                                        </b>
                                                    </a>
                                                @endif
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($populations as $population)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $population->name }}</td>
                                                <td>{{ $population->description }}</td>
                                                <td class="text-center">
                                                    <div class="opts">
                                                        @if (Auth::user()->havePermission('sica.'.$role_name.'.people.config.population.edit'))
                                                            <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.'.$role_name.'.people.config.population.edit', $population->id) }}')">
                                                                <b class="text-info" data-toggle="tooltip" data-placement="top" title="Actualizar grupo poblacional">
                                                                    <i class="fas fa-edit"></i>
                                                                </b>
                                                            </a>
                                                        @endif
                                                        @if (Auth::user()->havePermission('sica.'.$role_name.'.people.config.population.delete'))
                                                            <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.'.$role_name.'.people.config.population.delete', $population->id) }}')">
                                                                <b class="text-danger" data-toggle="tooltip" data-placement="top" title="Eliminar poblacional">
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
                </div> {{-- Fin de la sección de la tabla de grupos poblacionales --}}
                <div class="col-md-12" id="events-card"> {{-- Inicio de la sección de la tabla eventos --}}
                    <div class="card card-orange card-outline shadow">
                        <div class="card-header">
                            <h3 class="card-title">Eventos</h3>
                        </div>
                        <div class="card-body">
                            <div>
                                <table id="events_table" class="display table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Nombre</th>
                                            <th>Descripción</th>
                                            <th class="text-center">Fecha de inicio</th>
                                            <th class="text-center">Fecha de cierre</th>
                                            <th class="text-center">Estado</th>
                                            <th class="text-center">
                                                @if (Auth::user()->havePermission('sica.'.$role_name.'.people.config.events.create'))
                                                    <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.'.$role_name.'.people.config.events.create') }}')">
                                                        <b class="text-success" data-toggle="tooltip" data-placement="top" title="Registrar evento">
                                                            <i class="fas fa-plus-circle"></i>
                                                        </b>
                                                    </a>
                                                @endif
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($events as $event)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $event->name }}</td>
                                                <td>{{ $event->description }}</td>
                                                <td class="text-center">{{ $event->start_date }}</td>
                                                <td class="text-center">{{ $event->end_date }}</td>
                                                <td class="text-center">{{ $event->state }}</td>
                                                <td class="text-center">
                                                    <div class="opts">
                                                        @if (Auth::user()->havePermission('sica.'.$role_name.'.people.config.events.edit'))
                                                            <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.'.$role_name.'.people.config.events.edit', $event->id) }}')">
                                                                <b class="text-info" data-toggle="tooltip" data-placement="top" title="Actualizar evento">
                                                                    <i class="fas fa-edit"></i>
                                                                </b>
                                                            </a>
                                                        @endif
                                                        @if (Auth::user()->havePermission('sica.'.$role_name.'.people.config.events.delete'))
                                                            <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.'.$role_name.'.people.config.events.delete', $event->id) }}')">
                                                                <b class="text-danger" data-toggle="tooltip" data-placement="top" title="Eliminar evento">
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
                </div> {{-- Fin de la sección de la tabla eventos --}}
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
        $(document).ready(function() {
            $('#eps_table').DataTable({
                columnDefs: [
                    { orderable: false, targets: 2 }
                ]
            });
            $('#population_groups_table').DataTable({
                columnDefs: [
                    { orderable: false, targets: 3 }
                ]
            });
            $('#pensions_table').DataTable({});
            $('#insurancers_table').DataTable({});
            $('#events_table').DataTable({
                columnDefs: [
                    { orderable: false, targets: 6 }
                ]
            });
        });

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

        $("#generalModal").on("hidden.bs.modal", function() {
            /* Modal content is removed when the modal is closed */
            $("#modal-content").empty();
        });

        function mayus(e) {
            /* Convert the content of a field to uppercase */
            e.value = e.value.toUpperCase();
        }
    </script>
@endsection
