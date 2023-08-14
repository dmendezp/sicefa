@extends('sica::layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <h4>Roles</h4>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="mtop16">
                            <table id="roles_table" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Aplicación</th>
                                        <th>Rol</th>
                                        <th>Slug</th>
                                        <th class="text-center">Acceso total</th>
                                        <th>Descripción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $r)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $r->app->name }}</td>
                                            <td>{{ $r->name }}</td>
                                            <td>{{ $r->slug }}</td>
                                            <td class="text-center">
                                                @if ($r->full_access == 'Si')
                                                    <i class="fa-solid fa-check text-success"></i>
                                                @else
                                                    <i class="fas fa-times text-danger"></i>
                                                @endif
                                            </td>
                                            <td>{{ $r->description }}</td>
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
            $('#roles_table').DataTable({});
        });
    </script>
@endsection
