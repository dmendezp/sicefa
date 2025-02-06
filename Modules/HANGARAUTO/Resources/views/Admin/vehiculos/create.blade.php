<!--- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDriver">
    <i class="fas fa-plus"></i>
</button><br><br>

<!-- Modal -->
<div class="modal fade" id="addDriver" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Añadir Nuevo Vehiculo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => route('hangarauto.'. getRoleRouteName(Route::currentRouteName()) .'.vehicles.store'), 'files' => true]) !!}
                {{ csrf_field() }}
                <div class="mb-3">
                    <label for="name" class="form-label">{{ trans('hangarauto::Drivers.Name') }}:</label>
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
                <div class="mb-3">
                    <label for="vehicletype" class="form-label">Tipo de vehiculo :</label>
                    {!! Form::select('vehicletype', $vehicletype, null, ['class' => 'form-control', 'placeholder' => 'Seleccione el tipo de vehiculo']) !!}
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">{{ trans('hangarauto::Vehiculos.Statu') }}:</label>
                    {!! Form::select('status', 
                        [
                            'Disponible' => 'Disponible',
                            'No Disponible' => 'No Disponible',
                        ], 
                        null, 
                        ['class' => 'form-control', 'placeholder' => '-- Seleccione --']) 
                    !!}
                </div>
                <div class="mb-3">
                    <label for="license" class="form-label">{{ trans('hangarauto::Vehiculos.Plate') }}:</label>
                    {!! Form::text('license', null, ['class' => 'form-control']) !!}
                </div>
                <div class="mb-3">
                    <label for="fuel_level" class="form-label">{{ trans('hangarauto::Vehiculos.Fuel Level') }}:</label>
                    {!! Form::select('fuel_level', 
                        [
                            'Bajo' => 'Bajo',
                            'Medio' => 'Medio',
                            'Alto' => 'Alto',
                            
                        ], 
                        null, 
                        ['class' => 'form-control', 'placeholder' => '-- Seleccione --']) 
                    !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ trans('hangarauto::Drivers.Cancel') }}</button>
                    {!! Form::submit(trans('hangarauto::Drivers.Save'), ['class' => 'btn btn-success']) !!}
                </div>
            </div>
        </div>
    </div>
</div>