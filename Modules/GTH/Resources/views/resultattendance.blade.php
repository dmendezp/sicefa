<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Reporte de Asistencia por Programa</h1>
                    <table id="contractor" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Documento</th>
                                <th scope="col">Hora de Entrada</th>
                                <th scope="col">Hora de Salida</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendances as $attendance)
                                <tr>
                                    <td>{{ optional($attendance['person'])->full_name ?? 'No' }}</td>
                                    <td>{{ optional($attendance['person'])->document_number ?? 'No' }}</td>
                                    <td>{{ optional($attendance['attendance'])->entry_time ?? 'No' }}</td>
                                    <td>{{ optional($attendance['attendance'])->exit_time ?? 'No' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
