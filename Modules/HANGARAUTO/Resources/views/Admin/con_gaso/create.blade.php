<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDriver">
    <i class="fas fa-plus"></i>
</button><br><br>

<!-- Modal -->
<div class="modal fade" id="addDriver" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Añadir Nuevo Consumo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => route('hangarauto.'. getRoleRouteName(Route::currentRouteName()) .'.consumo.add'), 'files' => true]) !!}
                {{ csrf_field() }}

                <div class="mb-3">
                    <label for="vehicle_id" class="form-label">{{trans('hangarauto::Vehiculos.Vehicle') }}:</label>
                    {!! Form::select('vehicle_id', $vehicles, null, ['class' => 'form-control', 'placeholder' => '-- Seleccione --']) !!}
                </div>
                <div class="mb-3">
                    <label for="person_id" class="form-label">{{trans('hangarauto::Vehiculos.Responsability') }}:</label>
                    {!! Form::select('person_id', $drivers, null, ['class' => 'form-control', 'placeholder' => '-- Seleccione --']) !!}
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">{{trans('hangarauto::Vehiculos.Date') }}:</label>
                    {!! Form::date('date', null, ['class' => 'form-control']) !!}
                </div>
                <div class="mb-3">
                    <label for="fuel_type" class="form-label">Tipo de Combustible:</label>
                    {!! Form::select('fuel_type', $fuel_type, null, ['class' => 'form-control', 'placeholder' => 'Seleccione el tipo de combustible']) !!}
                </div>
                <div class="mb-3">
                    <label for="measurement_unit_id" class="form-label">{{trans('hangarauto::Vehiculos.Measurement Unit') }}:</label>
                    {!! Form::select('measurement_unit_id', $measurement_units, null, ['class' => 'form-control', 'placeholder' => '-- Seleccione --']) !!}
                </div>
                <div class="mb-3">
                    <label for="amount" class="form-label">{{trans('hangarauto::Vehiculos.Amount') }}:</label>
                    {!! Form::number('amount', null, ['class' => 'form-control']) !!}
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">{{trans('hangarauto::Vehiculos.Price') }}:</label>
                    {!! Form::number('price', null, ['class' => 'form-control']) !!}
                </div>
                <div class="mb-3">
                    <label for="mileage" class="form-label">{{trans('hangarauto::Vehiculos.Mileage') }}:</label>
                    {!! Form::number('mileage', null, ['class' => 'form-control']) !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{trans('hangarauto::Drivers.Cancel') }}</button>
                    {!! Form::submit(trans('hangarauto::Drivers.Save'), ['class' => 'btn btn-success']) !!}
                </div>
            </div>
        </div>
    </div>
</div>