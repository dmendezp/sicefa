@extends('bienestar::layouts.master')

@section('content')
    <div class="container">
        <h1>{{ trans('bienestar::menu.Application Management') }} <i class="far fa-smile" style="color: #000000;"></i></h1>
        <div class="container">
            <div class="quota-box">
                <div class="quota-info">
                    <h1>
                        @foreach ($convocations as $convocation)
                            <td>{{ $convocation->name }} - {{ $convocation->description }}</td>
                            <p>
                                {{ trans('bienestar::menu.Food Quotas') }}:
                                <span
                                    class="quota-number @if ($convocation->food_quotas > 20) green @elseif($convocation->food_quotas > 0) orange @else red @endif">{{ $convocation->food_quotas }}</span>

                                {{ trans('bienestar::menu.Transportation Quotas') }}:
                                <span
                                    class="quota-number @if ($convocation->transport_quotas > 20) green @elseif($convocation->transport_quotas > 0) orange @else red @endif">{{ $convocation->transport_quotas }}</span>
                            </p>
                        @endforeach
                    </h1>
                </div>
            </div>

            <div class="row justify-content-md-center pt-4">
                <div class="card shadow col-md-12">
                    <div class="card-body">
                        <table id="benefitsTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>{{ trans('bienestar::menu.Apprentice Name') }}</th>
                                    <th>{{ trans('bienestar::menu.Benefit to which you are applying') }}</th>
                                    <th>{{ trans('bienestar::menu.Select') }}</th>
                                    <th>{{ trans('bienestar::menu.Application Score') }}</th>
                                    <th>{{ trans('bienestar::menu.Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($postulation as $postulation)
                                    <tr>
                                        <td>{{ $postulation->first_name }} {{ $postulation->first_last_name }}
                                            {{ $postulation->second_last_name }} </td>
                                        <td>
                                            @if ($postulation->transportation_benefit == 1)
                                                Transporte
                                            @endif <br>
                                            @if ($postulation->feed_benefit == 1)
                                                Alimentación
                                            @endif
                                        </td>
                                        <td>
                                            @if ($postulation->transportation_benefit == 1)
                                                <select class="form-control" name="benefit_id">
                                                    <option value="">Seleccione el beneficio</option>
                                                    @foreach ($benefits as $benefit)
                                                        @if ($benefit->name == 'Transporte')
                                                            <option value="{{ $benefit->id }}">{{ $benefit->name }}
                                                                {{ $benefit->porcentege }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            @endif
                                            <br>
                                            @if ($postulation->feed_benefit == 1)
                                                <select class="form-control" name="benefit_id">
                                                    <option value="">Seleccione el beneficio</option>
                                                    @foreach ($benefits as $benefit)
                                                        @if ($benefit->name == 'Alimentacion')
                                                            <option value="{{ $benefit->id }}">{{ $benefit->name }}
                                                                {{ $benefit->porcentege }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            @endif
                                        </td>
                                        <td>{{ empty($postulation->total_score) ? 'La variable está vacía' : $postulation->total_score }}
                                        </td>
                                        <!-- Agrega esto donde estás mostrando tus filas de datos -->
                                        <td style="align-items: center">
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#myModal{{ $postulation->id }}">
                                                Detalles
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="myModal{{ $postulation->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel">Detalles de la
                                                                Postulación</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- Muestra detalles de la postulación -->
                                                            <h3>Detalles de la Postulación</h3>
                                                            <p>Nombre: {{ $postulation->first_name }}
                                                                {{ $postulation->first_last_name }}
                                                                {{ $postulation->second_last_name }}</p>

                                                            <!-- Preguntas y respuestas relacionadas -->
                                                            <h3>Preguntas de la Postulación</h3>
                                                            @foreach ($answers as $answer)
                                                                @if ($answer->postulation_id == $postulation->id)
                                                                    <div class="form-group">
                                                                        <label
                                                                            for="question">{{ $answer->question }}</label>
                                                                        <input type="text" class="form-control col-md-4"
                                                                            name="answers[{{ $answer->question }}]"
                                                                            value="{{ $answer->answer }}" readonly>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                            <div class="form-group">
                                                                <label for="message">Mensaje</label>
                                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="message">Puntaje</label>
                                                                <input type="number" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

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

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const filas = document.querySelectorAll('tr');

            filas.forEach(function(fila) {
                const estados = fila.querySelectorAll(
                    '.estado-columna'); // Ajusta el selector según tu estructura HTML
                let ocultar = true;

                estados.forEach(function(estado) {
                    if (estado.textContent !== 'Beneficiario') {
                        ocultar = false;
                    }
                });

                if (ocultar) {
                    fila.classList.add('ocultar');
                }
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $('.form-control').on('change', function() {
                var form = $(this).closest('form');
                var url = form.attr('action');

                // Obtén el nombre del select cambiado
                var selectName = $(this).attr('name');

                // Define el estado y mensaje según el nombre del select
                var state, message;
                if (selectName === 'transport_benefit' || selectName === 'food_benefit') {
                    state = 'Beneficiario';
                    message = 'Felicidades, has sido aceptado para recibir el beneficio solicitado';
                }

                // Obtén los datos del formulario y agrega estado y mensaje
                var formData = form.serialize() + '&state=' + state + '&message=' + message;
                console.log(formData)
                // Envía la solicitud AJAX como POST
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    success: function(data) {
                        console.log('Beneficio actualizado con éxito');
                        // Puedes agregar más lógica aquí según tus necesidades
                    },
                    error: function(error) {
                        console.error('Error al actualizar el beneficio:', error.responseText);
                        // Puedes agregar más lógica aquí según tus necesidades
                    }
                });
            });
        });
    </script>
@endsection
