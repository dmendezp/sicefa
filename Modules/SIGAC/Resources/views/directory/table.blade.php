<div class="card">
    <div class="card-header">
        {{ trans('sigac::directory.List_Emails') }}
    </div>
    <div class="card-body">
        <div>
            <div class="table-responsive">
                <table id="table" class="table">
                    <div class="text-center">
                        <button class="btn btn-success" type="button" onclick="copyEmails('sena_')" title="Copiar correo">
                            <i class="far fa-copy fa-fw"></i>
                            Correo sena
                        </button>
                        <button class="btn btn-info text-white" type="button" onclick="copyEmails('personal_')" title="Copiar correo">
                            <i class="far fa-copy fa-fw"></i>
                            Correo personal
                        </button>
                    </div>
                    <thead>
                        <tr>
                            <th class="text-center">
                                <input type="checkbox" name="chkAll" id="chkAll">
                            </th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Vinculación</th>
                            <th class="text-center">Rol</th>
                            <!-- <th class="text-center">profesión</th> -->
                            <th class="text-center">Correo sena</th>
                            <th class="text-center">Correo personal</th>
                            <th class="text-center">Telefono</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($directoryData as $key => $value)
                        <tr>
                            <td>
                                <input type="checkbox" name="chk_{{$key}}" id="chk_{{$key}}" class="itemCheckbox" value="{{$key}}">
                            </td>
                            <td>
                                {{$value->first_name}} {{$value->first_last_name}} {{$value->second_last_name}}
                            </td>
                            <td>
                                {{ $value->vinculacion == 1 ? 'Funcionario' : ($value->vinculacion == 2 ? 'Contratista' : '') }}
                            </td>
                            <td>
                                {{$value->rol}}
                            </td>
                            <!-- <td>
                                {{$value->profession}}
                            </td> -->
                            <td class="sena_emails{{$key}}">
                                {{$value->misena_email}}
                            </td>
                            <td class="personal_emails{{$key}}">
                                {{$value->personal_email}}
                            </td>
                            <td>
                                {{$value->telephone1}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#chkAll').change(function() {
            if ($(this).is(':checked')) {
                $(".itemCheckbox").prop("checked", true);
            } else {
                $(".itemCheckbox").prop("checked", false);
            }
        });
    });

    function copyEmails(type) {
        if ($(".itemCheckbox:checked").length === 0) {
            Swal.fire({
                title: 'Atención',
                text: 'Debe seleccionar los correos a copiar',
                icon: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#FF9966',
                confirmButtonText: 'Cerrar'
            });
            return;
        } else {

            // Inicializa una lista para almacenar todos los correos
            var emails = [];

            $(".itemCheckbox:checked").each(function() {
                var key = $(this).val();

                // Obtiene todos los contenedores de correos electrónicos
                var emailContainers = document.querySelectorAll('.' + type + 'emails' + key);

                // Itera sobre cada contenedor y recopila los correos
                emailContainers.forEach(function(container) {
                    var text = container.innerText.trim();
                    if (text != "") {
                        var containerEmails = container.innerText.trim().split('\n').map(email => email.trim());
                        emails = emails.concat(containerEmails);
                    }
                });
            });

            // Elimina duplicados si es necesario
            emails = [...new Set(emails)];

            // Crea una cadena con todos los correos separados por punto y coma
            var emailString = emails.join('; ');

            // Crea un elemento temporal para copiar los correos al portapapeles
            var tempElement = document.createElement('textarea');
            tempElement.value = emailString;
            document.body.appendChild(tempElement);
            tempElement.select();
            document.execCommand('copy');
            document.body.removeChild(tempElement);

            // Notificación de éxito (opcional)
            Swal.fire({
                title: 'Exito',
                text: 'Correos copiados al portapapeles',
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok'
            });
        }
    }
</script>