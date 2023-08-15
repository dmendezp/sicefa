@extends('sica::layouts.master')

@section('stylesheet')
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <h3 class="card-title">Apps</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="mtop16">
                            <table id="apps_table" class="table table-bordered table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Nombre</th>
                                        <th>URL</th>
                                        <th class="text-center">Icono</th>
                                        <th>Descripción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($apps as $app)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $app->name }}</td>
                                            <td>{{ $app->url }}</td>
                                            <td class="text-center">
                                                <h1 style="color: {{ $app->color }}"><i class="fas {{ $app->icon }}"></i></h1>
                                            </td>
                                            <td>{{ $app->description }}</td>
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
        $(function () {
            $("#apps_table").DataTable({
                "responsive": true
            });
        });
    </script>
@endsection
