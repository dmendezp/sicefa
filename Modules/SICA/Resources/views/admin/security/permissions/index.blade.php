@extends('sica::layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <h4>Permisos</h4>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="mtop16">
                            <table id="permissions_table" class="table table-bordered table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Aplicación</th>
                                        <th>Permiso</th>
                                        <th>Slug</th>
                                        <th>Descripción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $p)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $p->app->name }}</td>
                                            <td>{{ $p->name }}</td>
                                            <td>{{ $p->slug }}</td>
                                            <td>{{ $p->description }}</td>
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
            $('#permissions_table').DataTable({});
        });
    </script>
@endsection
