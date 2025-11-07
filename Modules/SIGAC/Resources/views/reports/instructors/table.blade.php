<div class="card">
    <div class="card-header">
        Reporte de datos de instructores
    </div>
    <div class="card-body">
        <div>
            <div class="table-responsive">
                <table id="table" class="table">
                    <button class="btn btn-success" type="button" onclick="copyEmails()" title="Copiar correo">
                        <i class="far fa-copy fa-fw"></i>
                    </button>
                    <thead>
                        <tr>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Correo</th>
                            <th class="text-center">Teléfono</th>
                            <th class="text-center">Ambiente</th>
                            <th class="text-center">Hora</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($instructor_program as $full_name => $programs)
                            <tr>
                                <td>
                                    {{$full_name}}
                                </td>
                                <td class="emails">
                                    @foreach ($instructor_emails[$full_name] as $email)
                                        {{ $email }}<br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($instructor_telephones[$full_name] as $telephone)
                                        {!! nl2br(e($telephone)) !!}<br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($programs as $program)
                                        @foreach ($program->environment_instructor_programs as $en)
                                            {{ $en->environment->name }} <br>
                                        @endforeach
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($programs as $program)
                                        {{ $program->start_time }} - {{ $program->end_time }} <br>
                                    @endforeach
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
    function copyEmails() {
        // Obtiene todos los contenedores de correos electrónicos
        var emailContainers = document.querySelectorAll('.emails');
        
        // Inicializa una lista para almacenar todos los correos
        var emails = [];
        
        // Itera sobre cada contenedor y recopila los correos
        emailContainers.forEach(function(container) {
            var containerEmails = container.innerText.trim().split('\n').map(email => email.trim());
            emails = emails.concat(containerEmails);
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
</script>