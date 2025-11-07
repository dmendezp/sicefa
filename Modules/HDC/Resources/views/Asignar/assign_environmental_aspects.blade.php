@extends('hdc::layouts.master')
@push('breadcrumbs')
<li class="breadcrumb-item active"><a href="{{ route('hdc.admin.resultfromaspects') }}">{{ trans('hdc::assign_environmental_aspects.Consult_environmental_aspects')}}</a> / {{ trans('hdc::assign_environmental_aspects.Indicator_manageresources')}}</li>
@endpush

@section('content')
<h2 class="text-center">{{ trans('hdc::assign_environmental_aspects.ct1') }}</h2>
<br>
<div class="">
    <div class="card card-green card-outline shadow col-12">
        <div class="card-header">
            <h3 class="card-title">{{ trans('hdc::assign_environmental_aspects.ct1') }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('hdc.admin.updateEnvironmentalAspects') }}" id="updateForm" method="post"> {{-- Cambio de ruta a 'updateEnvironmentalAspects' --}}
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>{{ trans('hdc::assign_environmental_aspects.label1') }}</label>
                            <select name="productive_unit_id" id="productUnitSelect" class="form-control" required>
                                <option value="">{{ trans('hdc::assign_environmental_aspects.select1') }}</option>
                                @foreach ($productive_unit as $pro)
                                <option value="{{ $pro->id }}">{{ $pro->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            {!! Form::label('activity', trans('hdc::assign_environmental_aspects.label2')) !!}
                            {!! Form::select('activity_id', [], old('activity_id'), [
                                'class' => 'form-control',
                                'required',
                                'id' => 'activity_id',
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-6">
                        <h2>{{ trans('hdc::assign_environmental_aspects.title_checklist') }}</h2>
                        <div name="Environmetal_Aspect" class="checkbox" required="true">
                            <ul style="list-style-type: none; padding: 0; margin: 0;">
                                @foreach ($environmentalAspect as $key => $ea)
                                <li>
                                    <label for="Aspecto{{ $ea->id }}">
                                        <input type="checkbox" name="Environmental_Aspect[]" id="Aspecto{{ $ea->id }}" value="{{ $ea->id }}" >
                                        {{ $ea->name }}
                                    </label>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-success" background-color="green" id="submitButton">{{
                            trans('hdc::assign_environmental_aspects.btn1') }}</button>
                    </div>
                </div><br>
            </form>
        </div>
    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function() {
        $('#updateForm').on('submit', function() {
            Swal.fire({
                icon: 'success',
                title: 'Guardado exitosamente',
                showConfirmButton: false,
                timer: 1500
            });
        });
    });
        $(document).ready(function() {
            var activitySelect = $('select[name="activity_id"]');
            activitySelect.on('change', function() {
                // Limpiar los checkboxes antes de realizar la acción
                $('input[name="Environmental_Aspect[]"]').prop('checked', false);


                var selectedActivityId = $(this).val();

                if (selectedActivityId) {
                    // Utiliza el nombre de la ruta para obtener la URL
                    var url = "{{ route('hdc.admin.getEnvironmentalAspects', ':id') }}";
                    url = url.replace(':id', selectedActivityId);

                    $.get(url, function(data) {
                        // Marcar los checkboxes según la respuesta de la solicitud AJAX
                        data.forEach(function(aspectId) {
                            $('#Aspecto' + aspectId).prop('checked', true);
                        });
                    });
                }
                // No es necesario el else ya que ya limpiamos los checkboxes antes
            });


            // Agrega un evento 'submit' al formulario para validar antes de enviar
            $('#updateForm').on('submit', function(event) {
                var checkedCheckboxes = $('input[name="Environmental_Aspect[]"]:checked');

                if (checkedCheckboxes.length === 0) {
                    // Si no hay checkboxes marcados, muestra una alerta y evita enviar el formulario
                    event.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Debes seleccionar al menos un aspecto ambiental.',
                    });
                }
            });


            $('#productUnitSelect').on('change', function() {
                var selectedProductId = $(this).val(); // Obtener el ID de la unidad productiva seleccionada

                // Realizar una solicitud AJAX para enviar el ID seleccionado a la ruta o función de Laravel
                $.ajax({
                    url: '{{ route('hdc.admin.getactivities') }}',
                    method: 'GET',
                    data: {
                        unit: selectedProductId
                    },
                    success: function(response) {


                        // Verificar si hay un responsable en la respuesta
                        if (response.activities) {

                            // Actualizar el campo "Bodega Recibe" con las opciones recibidas
                            var receivewarehouseSelect = $('#activity_id');
                            receivewarehouseSelect.empty(); // Vaciar las opciones actuales
                            receivewarehouseSelect.append(new Option('Seleccione la Actividad',
                                ''));

                            // Agregar las nuevas opciones desde el objeto de bodegas en la respuesta JSON
                            $.each(response.activities, function(id, name) {
                                receivewarehouseSelect.append(new Option(name, id));
                            });
                        } else {
                            $('#activity_id').val('');
                        }
                    },
                    error: function() {
                        // Manejar errores si la solicitud AJAX falla
                        console.error('Error en la solicitud AJAX');
                    }
                });
            });
        });
    </script>
@endpush
@endsection
