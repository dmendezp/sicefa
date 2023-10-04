@extends('bienestar::layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-md-center pt-4">
        <div class="card card-green card-outline shadow col-md-8">
            <div class="card-header">
                <h3 class="card-title">{{ trans('bienestar::menu.Configure Benefits') }}</h3>
            </div>
            <div class="card-body">
                <div class="mtop16">
                    <table id="benefitsTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Beneficiarios</th>
                                <th>Beneficios</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($typeOfBenefits as $typeOfBenefit)
                                <tr>
                                    <td>{{ $typeOfBenefit->name }}</td>
                                    <td>
                                        <ul>
                                            @foreach($benefits as $benefit)
                                                <li>
                                                    @php
                                                        // Verificar si existe un registro sin deleted_at para este beneficio y beneficiario
                                                        $record = $benefitstypeofbenefits->where('benefit_id', $benefit->id)
                                                            ->where('type_of_benefit_id', $typeOfBenefit->id)
                                                            ->whereNull('deleted_at')
                                                            ->first();
                                                        $isChecked = $record ? true : false;
                                                    @endphp
                                                    <input type="checkbox" name="benefit_{{ $benefit->id }}_{{ $typeOfBenefit->id }}" value="1" data-record-id="{{ $record ? $record->id : '' }}" {{ $isChecked ? 'checked' : '' }}>
                                                    {{ $benefit->name }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



@section('script')
<script>
    $(document).ready(function() {
        // Obtener el token CSRF desde la etiqueta meta en tu vista Blade
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Realizar una solicitud AJAX para obtener el estado actual de los registros
        $.ajax({
            url: '{{ route('cefa.bienestar.benefitstypeofbenefits.getCurrentState') }}',
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {
                // Recorrer la respuesta y marcar o desmarcar los checkboxes según el estado
                $.each(response, function(index, item) {
                    const checkboxName = `benefit_${item.benefit_id}_${item.type_of_benefit_id}`;
                    const $checkbox = $(`input[name="${checkboxName}"]`);

                    if (item.deleted_at) {
                        $checkbox.prop('checked', false);
                    } else {
                        $checkbox.prop('checked', true);
                    }
                });
            },
            error: function(error) {
                console.error(error);
            }
        });

        $('input[type="checkbox"]').on('change', function() {
            const checkboxName = $(this).attr('name');
            const [_, benefitId, typeId] = checkboxName.split('_');
            const isChecked = $(this).is(':checked');
            const recordId = $(this).data('record-id'); // Obtener el ID del registro

            $.ajax({
                url: '{{ route('cefa.bienestar.benefitstypeofbenefits.updateInline') }}',
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: {
                    benefit_id: benefitId,
                    type_of_benefit_id: typeId,
                    checked: isChecked,
                    record_id: recordId // Pasar el ID del registro
                },
                success: function(response) {
                    console.log(response);

                    // Verificar si se recibió un ID y el checkbox está desmarcado
                    if (recordId && !isChecked) {
                        // Actualizar deleted_at usando una solicitud AJAX
                        $.ajax({
                            url: '{{ route('cefa.bienestar.benefitstypeofbenefits.updateInline') }}', // Cambia a la ruta correcta si es diferente
                            method: 'PUT',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            data: {
                                benefit_id: benefitId,
                                type_of_benefit_id: typeId,
                                checked: false,
                                record_id: recordId // Pasar el ID del registro
                            },
                            success: function(updateResponse) {
                                console.log(updateResponse);
                            },
                            error: function(updateError) {
                                console.error(updateError);
                            }
                        });
                    }
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });
    });
</script>




@endsection
