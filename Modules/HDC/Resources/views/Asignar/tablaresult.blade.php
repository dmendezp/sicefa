<div class="row justify-content-center">
    <!-- card -->
    <div class="content mt-3">
        <div class="container-fluid">
            <div class="card card-success card-outline shadow mt-3">
                <div class="card-header">
                </div>
                <div class="card-body">
                    <div class="mtop16">
                        @if ($resultados->isNotEmpty())
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Actividad</th>
                                    <th>Aspectos Ambientales</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($resultados as $resultado)
                                <tr>
                                    <td>{{ $resultado->name }}</td>
                                    <td>
                                        <ul>
                                            @foreach ($resultado->environmental_aspects as $aspect)
                                            <li>{{ $aspect->name }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <a href="{{ route('cefa.hdc.assign_environmental_aspects') }}" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                            <p>No hay datos disponibles.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
