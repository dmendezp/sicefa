<div class="row justify-content-center">
    <!-- card -->
    <div class="content mt-3">
        <div class="container-fluid">
            <div class="card card-success card-outline shadow mt-3">
                <div class="card-header">
                    <h3 class="card-title">Registros de CO2 de {{ $persona->full_name }}</h3>
                </div>
                <div class="card-body">
                    <a href="{{ route('Carbonfootprint.form.calculates', $persona->id) }}" class="btn btn-success mb-2"><i
                            class="fa-solid fa-plus"></i></a>
                    <div class="mtop16">
                        @if ($environmeaspect->isNotEmpty())
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Aspecto Ambiental</th>
                                        <th>Cantidad</th>
                                        <th>CO2 (%)</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($environmeaspect as $index => $aspect)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <ul>
                                                    @foreach ($aspect->personenvironmentalaspects as $innerPersonAspect)
                                                        <li>{{ $innerPersonAspect->environmental_aspect->name }}</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>
                                                <ul>
                                                    @foreach ($aspect->personenvironmentalaspects as $innerPersonAspect)
                                                        <li>{{ $innerPersonAspect->consumption_value }}</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td></td>
                                            <td>
                                                @if ($aspect->personenvironmentalaspects->isNotEmpty())
                                                    <a href="{{ route('carbonfootprint.edit_consumption', $aspect->personenvironmentalaspects->first()->id) }}"
                                                        class="btn btn-primary">Editar</a>
                                                    <form
                                                        action="{{ route('carbonfootprint.eliminar', ['id' => $aspect->personenvironmentalaspects->first()->id]) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('¿Estás seguro de que quieres eliminar este registro?')"><i class="fas fa-trash-alt"></i></button>
                                                    </form>
                                                @endif
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
