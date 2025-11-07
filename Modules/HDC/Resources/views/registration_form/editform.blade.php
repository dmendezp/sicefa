@extends('hdc::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active"><a
            href="{{ route('hdc.admin.table') }}">{{ trans('hdc::ConsumptionRegistry.Title_Card_Records_Saver') }} </a>
        /{{ trans('hdc::ConsumptionRegistry.indicator_form_results_update') }}</li>
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-success card-outline shadow mt-2">
                        <div class="card-body">
                            <label>{{ trans('hdc::ConsumptionRegistry.Title_Card_Productive_Unit') }}</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend w-100">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fas fa-user-alt fs-10"></i>
                                    </span>
                                    <select class="form-select" name="productive_unit_id" id="productive_unit_id" disabled>
                                        <option value="" selected disabled>
                                            --{{ trans('hdc::ConsumptionRegistry.Select_Productive_Unit') }}--</option>
                                        <option value="{{ $labor->activity->productive_unit->id }}" selected>
                                            {{ $labor->activity->productive_unit->name }}</option>
                                    </select>

                                </div>
                            </div>
                            <label>{{ trans('hdc::ConsumptionRegistry.Title_Card_Activities') }} </label>
                            <div class="input-group">
                                <div class="input-group-prepend w-100">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fas fa-user-alt fs-10"></i>
                                    </span>
                                    <select class="form-select" name="activity_id" id="activity_id" disabled>
                                        <option value="{{ $labor->activity->id }}" selected disabled>
                                            {{ $labor->activity->name }}</option>
                                    </select>
                                </div>
                            </div>


                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-8">
                    <div class="card card-success card-outline shadow mt-2">
                        <div class="card-body">
                            <h5>{{ trans('hdc::ConsumptionRegistry.Title_Card_results') }}:</h5>
                            <div class="col-md-12">
                                <form method="POST"
                                    action="{{ route('hdc.'.getRoleRouteName(Route::currentRouteName()).'.update', ['labor' => $labor]) }} "id="tuFormularioID">
                                    @csrf
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>{{ trans('hdc::ConsumptionRegistry.Title_Heading_Table_Column1') }}
                                                    </th>
                                                    <th>{{ trans('hdc::ConsumptionRegistry.Title_Heading_Table_Column2') }}
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($labor->environmental_aspect_labors as $envasp)
                                                    <tr>
                                                        <td>{{ $envasp->environmental_aspect->name }}</td>

                                                        <td>
                                                            <input type="number" name="amounts[]" class="amount-input form-control"
                                                                value="{{ $envasp->amount }}" required>
                                                        </td>


                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-around">
                                            <!-- Botón de guardar -->
                                            <button type="submit" id="submitBtn"
                                                class="btn btn-success">{{ trans('hdc::ConsumptionRegistry.Btn_Update') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).on("click", "#submitBtn", function(event) {
                var valid = true;

                // Iterar sobre los campos de amounts
                $('[name="amounts[]"]').each(function() {
                    var amount = $(this).val();

                    // Validar que el valor sea numérico y positivo
                    if (!$.isNumeric(amount) || parseFloat(amount) < 0) {
                        valid = false;
                        // Utiliza SweetAlert para mostrar el mensaje de error
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Ingrese un valor numérico y positivo para este aspecto.'
                        });
                        event.preventDefault(); // Detener el envío del formulario
                        return false; // Detener la iteración
                    }

                    // Verificar que todos los campos estén completos
                    if ($(this).val() === '') {
                        valid = false;
                    }
                });

                // Utiliza SweetAlert para mostrar el mensaje de error si no todos los campos están completos
                if (!valid) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Complete todos los campos de valor de consumo antes de enviar el formulario.'
                    });
                    event.preventDefault(); // Detener el envío del formulario
                } else {
                    // Aquí puedes agregar la lógica para enviar el formulario si la validación es exitosa
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: 'Formulario enviado exitosamente.'
                    });
                }
            });

            // Agregar validación específica para campo numérico
            $('[name="amounts[]"]').on('input', function() {
                var amount = $(this).val();

                // Validar que el valor sea numérico y positivo
                if (!$.isNumeric(amount) || parseFloat(amount) < 0) {
                    // Utiliza SweetAlert para mostrar el mensaje de error
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Ingrese un valor numérico y positivo para este aspecto.'
                    });
                }
            });
        </script>
    @endpush
@endsection
