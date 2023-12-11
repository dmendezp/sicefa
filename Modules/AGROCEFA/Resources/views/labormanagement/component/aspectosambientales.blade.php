<div class="form-group row" id="environmentalAspectsContainer">
    <div class="col-sm-12">
        {{-- Aquí se mostrarán los campos de cantidad en forma de formulario --}}
            <table class="table">
                <thead>
                    <tr>
                        <th>{{ trans('agrocefa::labor.EnvironmentalAspect')}}</th>
                        <th>{{ trans('agrocefa::labor.EnterQuantity')}}</th>
                    </tr>
                </thead>
                <tbody id="tablaAspectosAmbientales">
                    {{-- Las filas se agregarán dinámicamente aquí --}}
                </tbody>
            </table>
    </div>
</div>
{{-- Fin aspectos ambientales --}}