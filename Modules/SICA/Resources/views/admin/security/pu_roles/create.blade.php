@extends('sica::layouts.master')

@section('stylesheet')
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md">
                                <h4>Asociación de permisos al rol {{ $role->name }}</h4>
                            </div>
                            <div class="col-md-auto px-0">
                                <a href="{{ route('sica.admin.security.roles.index') }}" class="btn btn-info float-right ml-1">
                                    <i class="fa-solid fa-angles-left fa-beat-fade mr-1"></i> Roles
                                </a>
                            </div>
                            <div class="col-md-auto px-0">
                                <a href="{{ route('sica.admin.security.roles.pu_roles.index') }}" class="btn btn-info float-right ml-1">
                                    <i class="fa-solid fa-angles-right fa-beat-fade mr-1"></i> Roles y unidades productivas
                                </a>
                            </div>
                            <div class="col-md-auto px-0">
                                <a href="{{ route('sica.admin.security.roles.responsibilities.index') }}" class="btn btn-info float-right ml-1">
                                    <i class="fa-solid fa-angles-right fa-beat-fade mr-1"></i> Responsabilidades
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="mtop16">
                            <h2>{{ $role->name }}</h2>
                            <br>
                            @foreach ($permissions as $permission)
                            <label for="Aspecto{{ $permission->id }}">
                                <input class="association-checkbox" type="checkbox" name="perissions[]"
                                    data-permission-id="{{ $permission->id }}" id="Aspecto{{ $permission->id }}" value="{{ $permission->id }}"
                                    {{ in_array($permission->id, $permisisonsasociate) ? 'checked' : '' }}>
                                {{ $permission->name }} - {{ $permission->slug }}
                            </label>
                            <input type="hidden" id="role_id" value="{{ $role->id }}">
                            <br>
                            @endforeach
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.association-checkbox').change(function() {
            var role_id = $('#role_id').val();
            var permissionId = $(this).data('permission-id');
            var isChecked = $(this).prop('checked');

            $.ajax({
                url: '{{ route('sica.admin.security.roles.permision_role.store') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    role_id: role_id,
                    permissionId: permissionId,
                    checked: isChecked
                },
                success: function(data) {
                    // Muestra una alerta al usuario
                    Swal.fire({
                        icon: 'success',
                        title: '{{ trans('senaempresa::menu.Success') }}',
                        text: data.success,
                    });
                },
                error: function(error) {
                    // Muestra una alerta de error al usuario
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: '{{ trans('senaempresa::menu.An error occurred while processing the request.') }}',
                    });
                    $(this).prop('checked', !isChecked);
                }
            });
        });
    });
</script>