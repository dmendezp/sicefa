<div>
    <div class="table-responsive">
        <table class="display table table-striped table-sm">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Año</th>
                    <th class="text-center">Presupuesto Total</th>
                    <th class="text-center">Presupuesto Disponible</th>
                    <th class="text-center">
                        <a data-bs-toggle="modal" data-bs-target="#crearPresupuestoModal">
                            <b class="text-success" data-toggle="tooltip" data-placement="top" title="">
                                <i class="fas fa-plus-circle"></i>
                            </b>
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($budgets as $b)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $b->year }}</td>
                        <td class="text-center">${{ number_format($b->budget_total, 0, ',', '.') }}</td>
                        <td class="text-center">${{ number_format($b->budget_current, 0, ',', '.') }}</td>
                        <td class="text-center">
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editarPresupuestoModal{{ $b->id }}">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('gdmf.academic_coordination.annual_budget.destroy', $b->id) }}" method="POST"
                                style="display:inline-block"
                                onsubmit="return confirm('¿Eliminar presupuesto del año {{ $b->year }}?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                    {{-- Modal Editar --}}
                    <div class="modal fade" id="editarPresupuestoModal{{ $b->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                {!! Form::model($b, ['route' => ['gdmf.academic_coordination.annual_budget.update', $b->id], 'method' => 'PUT']) !!}
                                <div class="modal-header">
                                    <h5 class="modal-title">Editar Presupuesto {{ $b->year }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        {!! Form::label('budget_total', 'Presupuesto Total') !!}
                                        {!! Form::number('budget_total', null, ['class' => 'form-control', 'required']) !!}
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    {!! Form::submit('Actualizar', ['class' => 'btn btn-primary']) !!}
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cerrar</button>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
{{-- Modal Crear --}}
<div class="modal fade" id="crearPresupuestoModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(['route' => 'gdmf.academic_coordination.annual_budget.store', 'method' => 'POST']) !!}
            <div class="modal-header">
                <h5 class="modal-title">Crear Presupuesto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    {!! Form::label('year', 'Año') !!}
                    {!! Form::number('year', date('Y'), ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="form-group mt-2">
                    {!! Form::label('budget_total', 'Presupuesto Total') !!}
                    {!! Form::number('budget_total', null, ['class' => 'form-control', 'required', 'min' => 0]) !!}
                </div>
            </div>
            <div class="modal-footer">
                {!! Form::submit('Guardar', ['class'=>'btn btn-success']) !!}
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>