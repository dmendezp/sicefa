@extends('hdc::layouts.master')

@section('content')
    <div class="col-md-12">
        <div class="card card-success card-outline shadow mt-2">
            <div class="card-body">
                <button type="button" class="btn btn-success"><i class="fa-solid fa-plus"></i></button>
                <div class="table-responsive">
                    <table  class="table table-bordered table-hover" id="myTable">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Información</th>
                                <th>Cantidad</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($formattedData as $data)
                                <tr>
                                    <td>{{ $data['id'] }}</td>
                                    <td>
                                        <strong>Unidad Productiva:</strong> {{ $data['unit_name'] }}<br>
                                        <strong>Actividad:</strong> {{ $data['activity_name'] }}<br>
                                        <strong>Aspecto Ambiental:</strong> {{ $data['aspect_name'] }}
                                    </td>
                                    <td>{{ $data['amount'] }}</td>
                                    <td>
                                        {{-- Boton de editar --}}
                                        <button type="button" class="btn btn-primary"><i
                                                class="fa-solid fa-pen-to-square"></i></button>
                                        {{-- Boton Eliminar --}}
                                        <button type="button" class="btn btn-danger ml-2"><i
                                                class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable();
            });
        </script>
    @endpush
@endsection
