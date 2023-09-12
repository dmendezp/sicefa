<div class="row justify-content-center">
    <!-- card -->
    <div class="content mt-3">
        <div class="container-fluid">
            <div class="card card-success card-outline shadow mt-3">
                <div class="card-header">
                    <h3 class="card-title">Registros de CO2 de {{ $persona->full_name }}</h3>
                </div>
                <div class="card-body">
                    <div class="mtop16">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Vehiculo</th>
                                    <th>Horas de uso</th>
                                    <th>Dias a la semana</th>
                                    <th>Tipo de combustible</th>
                                    <th>Personas en el hogar</th>
                                    <th>consumo de gas (mes)</th>
                                    <th>consumo de electricidad (mes)</th>
                                    <th>CO2 (%)</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                               {{--   @foreach ($calculos as $c)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $c->vehicle->name }}</td>
                                        <td>{{ $c->tiempoVei }}</td>
                                        <td>{{ $c->diasVei }}</td>
                                        <td>{{ $c->fuel->name }}</td>
                                        <td>{{ $c->personas }}</td>
                                        <td>{{ $c->gas }}</td>
                                        <td>{{ $c->electricidad }}</td>
                                        <td>{{ $c->total }}</td>
                                        <td>
                                            <a href="{{ route('carbonfootprint.calculo.editar', $c->id) }}"><i class="fas fa-pencil-alt"></i></a>
                                            <p onclick="confirmarEliminacion('{{ route('carbonfootprint.calculo.eliminar', $c->id) }}')"><i class="fas fa-trash text-danger"></i></p>
                                        </td>
                                    </tr>
                                @endforeach  --}}
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- card  --}}
</div>

<script>
    function confirmarEliminacion(ruta) {
        if (confirm('¿Está seguro de que desea eliminar el elemento?')) {
            window.location.href = ruta;
        }
    }
</script>
