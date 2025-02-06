@extends('sica::layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <h4>Usuarios</h4>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="btns">
                            <a href="{{ route('sica.admin.security.users.create') }}" class="btn btn-success ">
                                <i class="fas fa-user-plus"></i> Registrar Usuario
                            </a>
                        </div>
                        <div class="mtop16">
                            <table id="users_table" class="table table-bordered table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Nickname</th>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Roles</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $u)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $u->nickname }}</td>
                                            <td>{{ $u->person->full_name }}</td>
                                            <td>{{ $u->email }}</td>
                                            <td>
                                                @foreach ($u->roles as $rol)
                                                    <p class="mb-1" data-toggle='tooltip' data-placement="top" title="Aplicación: {{ $rol->app->name }}">
                                                        <i class="fas {{ $rol->app->icon }} mr-1" style="color: {{ $rol->app->color }}"></i>
                                                        {{ $rol->name }}
                                                    </p>
                                                @endforeach
                                            </td>
                                            <td class="text-center">
                                                <div class="opts">
                                                    <a href="{{ route('sica.admin.security.users.edit', $u) }}" class="mr-1" data-toggle='tooltip' data-placement="top" title="Actualizar usuario">
                                                        <i class="fas fa-edit text-primary"></i>
                                                    </a>
                                                    <a href="#" onclick="event.preventDefault(); if(confirm('¿Estás seguro de que deseas eliminar el usuario {{ $u->nickname }} de {{ $u->person->full_name }}?')) { document.getElementById('delete-form-user{{ $u->id }}').submit(); }" data-toggle='tooltip' data-placement="top" title="Eliminar usuario">
                                                        <i class="fas fa-trash-alt text-danger"></i>
                                                    </a>
                                                    <form id="delete-form-user{{ $u->id }}" action="{{ route('sica.admin.security.users.destroy', $u) }}" method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
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
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#users_table').DataTable({});
        });
    </script>
@endsection
