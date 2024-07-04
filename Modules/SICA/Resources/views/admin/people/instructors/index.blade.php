@extends('sica::layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <h3 class="card-title">Instructores</h3>
                    </div>
                    <div class="card-body">
                        <div class="mtop16">
                            <table id="table_instructors" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Nombre</th>
                                        <th class="text-center">Documento</th>
                                        <th class="text-center">Correo</th>
                                        <th class="text-center">Telefono</th>
                                        <th class="text-center">Vinculacion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($instructors as $instructor)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $instructor->first_name }} {{ $instructor->first_last_name }}</td>
                                        <td class="text-center">{{ $instructor->document_number }}</td>
                                        <td class="text-center">{{ $instructor->misena_email }}</td>
                                        <td class="text-center">{{ $instructor->telephone1 }}</td>
                                        <td class="text-center">{{ $instructor->vinculacion }}</td>
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
@endsection

@section('script')
    <script>
        $(function() {
            $("#table_instructors").DataTable({});
        });
    </script>
@endsection
