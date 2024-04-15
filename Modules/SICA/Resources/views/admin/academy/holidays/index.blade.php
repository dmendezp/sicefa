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
                        <h3 class="card-title">{{ trans('sica::menu.Holidays') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 pr-3 pb-3">
                                @isset($holiday)
                                    <form action="{{ route('sica.'.$role_name.'.academy.holidays.update', $holiday) }}" method="post">
                                @else
                                    <form action="{{ route('sica.'.$role_name.'.academy.holidays.store') }}" method="post">
                                @endisset
                                    @csrf
                                    <div class="form-group">
                                        <label>{{ trans('sica::menu.Date') }}:</label>
                                        {!! Form::date('date', old('date') ? old('date') : (isset($holiday) ? $holiday->date : ''), ['class'=>'form-control', 'required']) !!}
                                    </div>
                                    <div class="form-group">
                                        <label>{{ trans('sica::menu.Issue') }}:</label>
                                        {!! Form::text('issue', old('issue') ? old('issue') : (isset($holiday) ? $holiday->issue : ''), ['class'=>'form-control', 'required']) !!}
                                    </div>
                                    <div class="text-center">
                                        @isset ($holiday)
                                            @if(Auth::user()->havePermission('sica.'.$role_name.'.academy.holidays.index'))
                                                <a href="{{ route('sica.'.$role_name.'.academy.holidays.index') }}" class="btn btn-secondary">Cancelar</a>
                                            @endif
                                            @if(Auth::user()->havePermission('sica.'.$role_name.'.academy.holidays.update'))
                                                <button type="submit" class="btn btn-success">{{ trans('sica::menu.Update') }}</button>
                                            @endif
                                        @else
                                            <button type="reset" class="btn btn-secondary">{{ trans('sica::menu.Cancel') }}</button>
                                            @if(Auth::user()->havePermission('sica.'.$role_name.'.academy.holidays.store'))
                                                <button type="submit" class="btn btn-success">{{ trans('sica::menu.Register') }}</button>
                                            @endif
                                        @endisset
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-8">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th class="text-center">{{ trans('sica::menu.Date') }}</th>
                                                <th>{{ trans('sica::menu.Issue') }}</th>
                                                <th class="text-center">{{ trans('sica::menu.Actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($holidays as $h)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td class="text-center">{{ $h->date }}</td>
                                                    <td>{{ $h->issue }}</td>
                                                    <td class="text-center">
                                                        @if(Auth::user()->havePermission('sica.'.$role_name.'.academy.holidays.edit'))
                                                            <a href="{{ route('sica.'.$role_name.'.academy.holidays.edit', $h) }}" class="mr-1" data-toggle='tooltip' data-placement="top" title="Actualizar día festivo">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        @endif
                                                        @if(Auth::user()->havePermission('sica.'.$role_name.'.academy.holidays.destroy'))
                                                            <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.academic_coordinator.academy.holidays.delete', $h->id) }}')">
                                                                <b class="text-danger" data-toggle="tooltip" data-placement="top" title="Eliminar dia festivo">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </b>
                                                            </a>
                                                        @endif
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
    <script>
        @if (Session::get('message_holiday'))
            /* Show the message */
            @if (Session::get('icon') == 'success')
                toastr.success("{{ Session::get('message_holiday') }}");
            @elseif (Session::get('icon') == 'error')
                toastr.error("{{ Session::get('message_holiday') }}");
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
