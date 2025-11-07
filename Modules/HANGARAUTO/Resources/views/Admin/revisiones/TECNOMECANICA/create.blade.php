<!--- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDriver">
    <i class="fas fa-plus"></i>
</button><br><br>

<!-- Modal -->
<div class="modal fade" id="addDriver" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">{{trans('hangarauto::Vehiculos.Add New Tecnomecanica_Report') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => route('hangarauto.'. getRoleRouteName(Route::currentRouteName()) .'.tecnomecanica.add'), 'files' => true]) !!}
                {{ csrf_field() }}

                <div class="mb-3">
                    <label for="vehicle_id" class="form-label">{{trans('hangarauto::Vehiculos.Vehicle') }}:</label>
                    {!! Form::select('vehicle_id',$vehicles, null, ['class' => 'form-control', 'placeholder' => '-- Seleccione --']) !!}
                </div>
                <div class="mb-3">
                    <label for="person_id" class="form-label">{{trans('hangarauto::Vehiculos.Responsability') }}:</label>
                    {!! Form::select('person_id',$drivers, null, ['class' => 'form-control', 'placeholder' => '-- Seleccione --']) !!}
                </div>
                <div class="mb-3">
                    <label for="review_date" class="form-label">{{trans('hangarauto::Vehiculos.Review Date') }}:</label>
                    {!! Form::date('review_date', null, ['class' => 'form-control']) !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{trans('hangarauto::Drivers.Cancel') }}</button>
                    {!! Form::submit(trans('hangarauto::Drivers.Save'), ['class' => 'btn btn-success']) !!}
                </div>
            </div>
        </div>
    </div>
</div>