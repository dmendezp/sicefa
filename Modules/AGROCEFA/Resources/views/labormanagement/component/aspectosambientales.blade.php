<div class="form-group row" id="quantityFieldsContainer">
    <div class="col-sm-12" id="aspectoAmbientalContainer">
        {{-- Aquí se mostrarán los campos de cantidad en forma de formulario --}}
        <form action="{{ route('agrocefa.trainer.labormanagement.registerlabor') }}" method="post" id="cantidadForm">
            @csrf
            {{-- Tabla para mostrar aspectos ambientales y campos de cantidad --}}
            <table class="table">
                <thead>
                    <tr>
                        <th>Aspecto Ambiental</th>
                        <th>Ingrese cantidad</th>
                    </tr>
                </thead>
                <tbody id="tablaAspectosAmbientales">
                    {{-- Las filas se agregarán dinámicamente aquí --}}
                </tbody>
            </table>
            
        </form>
    </div>
</div>
{{-- Fin aspectos ambientales --}}