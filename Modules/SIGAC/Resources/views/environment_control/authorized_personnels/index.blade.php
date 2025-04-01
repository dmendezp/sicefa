@extends('sigac::layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-blue card-outline shadow col-md-12">
                    <div class="card-header">
                        <h3 class="card-title"></h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 pr-3 pb-3">
                                <form action="{{ route('sigac.academic_coordination.environment_control.authorized_personnels.authorized_store') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        {!! Form::label('person_id', trans('sigac::environment.Person')) !!}
                                        {!! Form::select('person_id', [], old('person'), ['class' => 'form-control person']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('role_id', trans('sigac::environment.Role')) !!}
                                        {!! Form::select('role_id', $roles, old('role'), ['class' => 'form-control role', 'placeholder' => trans('sigac::environment.Select_Role')]) !!}
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success">{{trans('sigac::environment.Add')}}</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-8">
                                <div class="table-responsive">
                                    <table id="authorizedPersonnels"
                                        class="display table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th class="text-center">{{trans('sigac::environment.Person')}}</th>
                                                <th class="text-center">{{trans('sigac::environment.Role')}}</th>
                                                <th class="text-center">{{trans('sigac::environment.Actions')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($authorizedPersonnels as $ap)
                                                @php
                                                    $person = DB::table('people')
                                                        ->where('id', $ap->person_id)
                                                        ->first();
                                                    $role = DB::table('roles')
                                                        ->where('id', $ap->role_id)
                                                        ->first();
                                                @endphp
                                                <tr>
                                                    <td class="text-center">
                                                        {{ $person->first_name . ' ' . $person->first_last_name . ' ' . $person->second_last_name }}
                                                    </td>
                                                    <td class="text-center">{{ $role->name }}</td>
                                                    <td class="text-center">
                                                        <a class="delete-authorized_personnel"
                                                            data-authorized_personnel-id="{{ $ap->id }}">
                                                            <b class="text-danger" data-toggle="tooltip"
                                                                data-placement="top" title="Eliminar">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </b>
                                                        </a>
                                                    </td>
                                                    <form id="delete-authorized_personnel-form-{{ $ap->id }}"
                                                        action="{{ route('sigac.academic_coordination.environment_control.authorized_personnels.authorized_destroy', ['id' => $ap->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
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
@endsection

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#authorizedPersonnels').DataTable({
            columnDefs: [{
                orderable: false,
                targets: 2
            }]
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.person').select2();
        $('.role').select2();
        $('.delete-authorized_personnel').on('click', function(event) {
            var authorized_personnel_id = $(this).data('authorized_personnel-id');

            // Mostrar SweetAlert para confirmar la eliminación
            Swal.fire({
                title: '{{trans('sigac::environment.Are_You_Sure?')}}',
                text: '{{trans('sigac::environment.Action_Delete_Message')}}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                cancelButtonText: '{{trans('sigac::environment.Cancel')}}',
                confirmButtonText: '{{trans('sigac::environment.Yes_Delete')}}'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si el usuario confirma, enviar el formulario de eliminación
                    document.getElementById('delete-authorized_personnel-form-' +
                        authorized_personnel_id).submit();
                }
            });
        });
    });
</script>

<script>
    // Inicializar Select2 en campos de selección de personas
    $(document).ready(function() {
        $('select[name="person_id"]:last').select2({
            placeholder: '{{trans('sigac::environment.Select_Person')}}',
            minimumInputLength: 3,
            ajax: {
                url: '{{ route('sigac.academic_coordination.environment_control.authorized_personnels.searchperson') }}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term,
                    };
                },
                processResults: function(data) {
                    var results = data.map(function(item) {
                        return {
                            id: item.id,
                            text: item.text
                        };
                    });

                    return {
                        results: results
                    };
                },
                cache: true
            }
        });
    });
</script>
