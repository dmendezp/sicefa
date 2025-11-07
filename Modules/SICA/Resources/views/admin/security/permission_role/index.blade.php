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
                                <h4>Relación de roles y permisos</h4>
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
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-center">Aplicación</th>
                                        <th class="text-center">Rol</th>
                                        <th>Permiso</th>
                                        <th>Descripción</th>
                                    </tr>
                                </thead>
                                    @foreach ($apps as $app)
                                        @foreach ($app->roles->sortBy('name') as $role)
                                            @php $permissionsSorted = $role->permissions->sortBy('slug') @endphp
                                            @php $permissionCount = count($permissionsSorted) @endphp
                                            <tr>
                                                @if ($permissionCount > 0)
                                                    <td class="text-center" rowspan="{{ $permissionCount }}">
                                                        <h1 style="color: {{ $app->color }}"><i class="fas {{ $app->icon }}"></i></h1>
                                                        {{ $app->name }}
                                                    </td>
                                                    <td class="text-center" rowspan="{{ $permissionCount }}">
                                                        <strong>{{ $role->name }}</strong>
                                                        <br>
                                                        <a href="{{ route('sica.admin.security.roles.permision_role.create', ['role_id' => $role->id]) }}">
                                                            <b class="text-success" data-toggle="tooltip" data-placement="top" title="Registrar EPS">
                                                                <i class="fas fa-plus-circle"></i>
                                                            </b>
                                                        </a>
                                                    </td>
                                                    <td>{{ $permissionsSorted[0]->name }}</td>
                                                    <td>{{ $permissionsSorted[0]->description }}</td>
                                                @endif
                                            </tr>
                                            @foreach ($permissionsSorted->splice(1) as $permission)
                                                <tr>
                                                    <td>{{ $permission->name }}</td>
                                                    <td>{{ $permission->description }}</td>
                                                </tr>
                                            @endforeach
                                        @endforeach
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
