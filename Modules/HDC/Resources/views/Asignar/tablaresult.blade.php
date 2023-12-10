<div class="row justify-content-center">
    <!-- card -->
    <div class="content mt-3">
        <div class="container-fluid">
            <div class="card card-success card-outline shadow mt-3">
                <div class="card-header">
                    <div class="card-body">
                        <div class="mtop16">
                            @if ($resultados->isNotEmpty())
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>{{ trans('hdc::ConsumptionRegistry.Title_Header_Table_Column_Activities')}}</th>
                                            <th>{{ trans('hdc::ConsumptionRegistry.Title_Header_Table_Column_Environmental_Aspect') }}
                                            </th>
                                            <th>{{ trans('hdc::ConsumptionRegistry.Title_Header_Table_Column_Action') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($resultados as $resultado)
                                            @if (count($resultado->environmental_aspects) > 0)
                                                <tr>
                                                    <td contenteditable="true">{{ $resultado->name }}</td>
                                                    <td>
                                                        <ul>
                                                            @foreach ($resultado->environmental_aspects as $aspect)
                                                                <li>{{ $aspect->name }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        <form method="post" action="{{ route('hcd.admin.delete_environmental_aspects', $resultado->id ) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btnEliminar">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>

                                                        <form
                                                            action="{{ route('hdc.admin.edit_resultados', ['activity_id' => $resultado->id]) }}"
                                                            method="get">
                                                            @csrf
                                                            <button type="submit" class="btn btn-primary"> <i
                                                                    class="fa-solid fa-pen-to-square"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endif
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
</div>

