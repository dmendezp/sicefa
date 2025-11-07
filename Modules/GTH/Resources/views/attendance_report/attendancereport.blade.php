@extends('gth::layouts.master')

@section('css')
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title">Reporte de Asistencia</h1>
                        </div>
                        <div class="card-body">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Número de Documento</th>
                                        <th scope="col">Tipo de Empleado</th>
                                        <th scope="col">Hora de Entrada</th>
                                        <th scope="col">Hora de Salida</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($attendances as $attendance)
                                        <tr>
                                            <td>{{ $attendance->date }}</td>
                                            <td>{{ $attendance->person->full_name }}</td>
                                            <td>{{ $attendance->person->document_number }}</td>
                                            <td>
                                                {{-- Accede al nombre del tipo de empleado a través de las relaciones --}}
                                                {{ optional(optional($attendance->person)->employees->first())->employee_type->name ?? 'Aprendiz' }}
                                            </td>
                                            <td>{{ $attendance->entry_time ?? 'No' }}</td>
                                            <td>{{ $attendance->exit_time ?? 'No' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#datatable').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": true,
                "buttons": [
                    {
                        extend: 'pdfHtml5',
                        text: 'PDF',
                        customize: function (doc) {
                            doc.styles.tableHeader = {
                                fillColor: '#000000',
                                color: '#FAFAFA',
                                fontSize: 12
                            };
                            doc.content[1].alignment = 'center';
                        }
                    },
                    "copy", "csv", "excel", "print", "colvis"
                ]
            });
        });
    </script>
@endsection
