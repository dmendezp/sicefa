<!-- Button tigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDriver">
    <i class="fas fa-plus"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="#addDriver" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Añadir Información Del Vehiculo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => route('parking.admin.vehicles.create'), 'files' => true]) !!}
                {{ csrf_field() }}

                <div class="mb-3">
                    <label for="exampleInputEmiail1" class="form-label">Vehículo:</label>
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmiail1" class="form-label">Referencia:</label>
                    {!! Form::select('referece',getEnumValues("vehicles", "referece"), null, ['class' => 'form-control', 'placeholder' => '-- Seleccione --']) !!}
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmiail1" class="form-label">Estado De Vehículo:</label>
                    {!! Form::select('status',getEnumValues("vehicles", "status"), null, ['class' => 'form-control', 'placeholder' => '-- Seleccione --']) !!}
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmiail1" class="form-label">Nivel De Combustible:</label>
                    {!! Form::select('fuel_level',getEnumValues("vehicles", "fuel_level"), null, ['class' => 'form-control', 'placeholder' => '-- Seleccione --']) !!}
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmiail1" class="form-label">Placa:</label>
                    {!! Form::text('license', null, ['class' => 'form-control']) !!}
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmiail1" class="form-label">Imagen Del Vehículo:</label>
                    {!! Form::file('image', null, ['class' => 'custom-file-input', 'id' => 'customFile', 'accept' => 'image/*']) !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    {!! Form::submit('Guardar', ['class' => 'btn btn-succes']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>