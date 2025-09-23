{{-- Modal Crear Presupuesto --}}
<div class="modal fade" id="crearpresupuesto{{ $t->id }}" tabindex="-1"
    aria-labelledby="crearpresupuestoLabel{{ $t->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearpresupuestoLabel{{ $t->id }}">
                    Registrar Presupuesto para {{ $t->name }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                {!! Form::open([
                    'route' => 'gdmf.academic_coordination.curriculum_planning.training_project.budget.store',
                    'method' => 'POST',
                ]) !!}
                @csrf

                {!! Form::hidden('training_project_id', $t->id) !!}

                <div class="form-group">
                    {!! Form::label('year', 'Año') !!}
                    {!! Form::number('year', now()->year, ['class' => 'form-control', 'readonly']) !!}
                </div>

                <div class="form-group mt-2">
                    {!! Form::label('annual', 'Presupuesto anual disponible') !!}
                    <input type="text" class="form-control" value="{{ number_format($annual, 0, ',', '.') }}"
                        readonly>

                    {!! Form::hidden('annual', $annual) !!}
                </div>

                <div class="form-group mt-2">
                    {!! Form::label('budget_total', 'Presupuesto total del proyecto') !!}
                    {!! Form::number('budget_total', $budgetData->budget_total ?? null, ['class' => 'form-control', 'required']) !!}
                </div>

                <div class="form-group mt-2">
                    {!! Form::label('budget_current', 'Presupuesto actual disponible') !!}
                    {!! Form::number('budget_current', $budgetData->budget_current ?? null, ['class' => 'form-control', 'required']) !!}
                </div>

                <div class="mt-4 text-end">
                    {!! Form::submit($budgetData ? 'Actualizar' : 'Guardar', ['class' => 'btn btn-primary']) !!}
                </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
