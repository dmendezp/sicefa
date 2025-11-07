<form action="{{ route('cefa.bienestar.savepostulation')}}" method="post" class="formGuardar" enctype="multipart/form-data">
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card shadow">
                @csrf
                <!-- Otros campos del formulario -->
                <input type="hidden" name="convocation_id" id="convocation_id_form" value="">
                <!-- Contenido del formulario aquí -->
                <div class="card-body">
                    @foreach ($resultados as $resultado)
                    <ul class="list-unstyled">
                        <div class="form-container">
                            <h3>Información del Aprendiz</h3>
                            <div class="form-group">
                                <label for="document_number">Documento:</label>
                                <input type="text" id="document_number" value="{{ $resultado->document_number }}" class="form-control" readonly>
                                <input type="hidden" id="apprentice_id" name="apprentice_id" value="{{ $resultado->id }}">
                            </div>
                            <div class="form-group">
                                <label for="first_name">Nombre:</label>
                                <input type="text" id="first_name" value="{{ $resultado->first_name }}" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Primer Apellido:</label>
                                <input type="text" value="{{ $resultado->first_last_name }}" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Segundo Apellido:</label>
                                <input type="text" value="{{ $resultado->second_last_name }}" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="code">Código del curso:</label>
                                <input type="text" id="code" value="{{ $resultado->code }}" class="form-control" readonly>
                            </div>

                            <div class="form-group">
                                <label for="name">Nombre del programa:</label>
                                <input type="text" id="name" value="{{ $resultado->name }}" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="personal_email">Email personal:</label>
                                <input type="text" id="personal_email" value="{{ $resultado->personal_email }}" class="form-control" readonly>
                            </div>
                        </div>
                    </ul>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body">
                    <h4>Beneficios Disponibles</h4>
                    <p>Elija el beneficio al que desea postularse. Puede elejir los 2*</p>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input benefit-checkbox" name="food" id="food" value="0">
                        <label class="form-check-label" for="alimentacion">Alimentación</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input benefit-checkbox" name="transport" id="transport" value="0">
                        <label class="form-check-label" for="transporte">Transporte</label>
                    </div>
                    <!-- Agrega más beneficios aquí con el mismo formato -->
                </div>
            </div>
        </div>
    </div>
    <div id="divQuestions">

    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Enviar <i class="fas fa-paper-plane"></i></button>
            </div>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        // Obtener todos los elementos de tipo checkbox con name "benefits[]"
        var selectedConvocationId = $('#convocation_id').val(); //Tomar el id de la convocatoria
        // Asigna el valor de convocation_id al campo oculto
        $('#convocation_id_form').val(selectedConvocationId);

        const checkboxesbenefits = document.querySelectorAll('.benefit-checkbox');

        // Iterar a través de los checkboxes y agregar un listener de cambio
        checkboxesbenefits.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    this.value = '1'; // Cambiar el valor a "1" cuando esté marcado
                    console.log("El checkbox se ha marcado. Valor: 1");
                } else {
                    this.value = '0'; // Cambiar el valor a vacío cuando esté desmarcado
                    console.log("El checkbox se ha desmarcado. Valor: vacío");
                }
            });
        });

        $('.benefit-checkbox').change(function() {
            var alimentacionChecked = $('#food').is(':checked');
            var transporteChecked = $('#transport').is(':checked');

            if (alimentacionChecked && transporteChecked) {
                // Ambos checkboxes están marcados
                consultallquestions();
            } else if (alimentacionChecked) {
                // Solo el checkbox de Alimentación está marcado                
                consultquestionsFeed('Alimentacion');
            } else if (transporteChecked) {
                // Solo el checkbox de Transporte está marcado
                consultquestionstransport('Transporte');
            } else {
                // Ningún checkbox está marcado, puedes manejarlo de acuerdo a tus necesidades
                // Por ejemplo, borrar resultados anteriores
                $('#divQuestions').html('');
            }
        });

        function consultquestionsFeed(type) {
            var miObjeto = new Object();
            miObjeto = (type);
            var data = JSON.stringify(miObjeto);
            console.log(data);
            ajaxReplace('divQuestions', '/bienestar/postulations/search/getquestions', data);
        }

        function consultquestionstransport(type) {
            var miObjeto = new Object();
            miObjeto = (type);
            var data = JSON.stringify(miObjeto);
            console.log(data);
            ajaxReplace('divQuestions', '/bienestar/postulations/search/getquestions', data);
        }

        function consultallquestions() {
            ajaxReplace('divQuestions', '/bienestar/postulations/search/getallquestions');
        }
    
    });
     //Script para la alerta de la accion de guardar un formulario
    // Define una función reutilizable para mostrar los SweetAlerts
    function showSweetAlert(icon, title, text, timer) {
        Swal.fire({
            icon: icon,
            title: title,
            text: text,
            showConfirmButton: false,
            timer: timer
        }).then(function() {
            // Recargar la página después del SweetAlert
            location.reload();
        });
    }
    // Configura el evento para el formulario de guardar
    document.querySelectorAll('.formGuardar').forEach(function(form) {
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Evitar que el formulario se envíe de inmediato
            var createForm = this;

            // Realizar una solicitud AJAX para enviar el formulario de creación
            axios.post(createForm.action, new FormData(createForm))
                .then(function(response) {
                    if (response.status === 200) {
                        if (response.data.success) {
                            showSweetAlert('success', "{{ trans('bienestar::menu.Success!') }}", response.data.success, 1500);
                        } else {
                            showSweetAlert('error', 'Error',response.data.error,3000);
                        }
                    }
                })
        });
    });
</script>