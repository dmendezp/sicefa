<div class="content-header">
    <div class="container-fluid">
        <div id="divbreadcrumb" class="row mb-2">
            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">GTH</li>
                    <li class="breadcrumb-item active" id="currentDateTime"></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<!-- Agrega el resto de tu contenido aquí -->

@section('js')
    <!-- Agrega tus enlaces de scripts aquí -->

    <script>
        // Función para obtener la fecha y hora actual con formato
        function getCurrentDateTime() {
            const now = new Date();
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: 'numeric',
                minute: 'numeric',
                second: 'numeric',
                timeZoneName: 'short'
            };
            return now.toLocaleString('es-ES', options);
        }

        // Función para actualizar la hora cada segundo
        function updateDateTime() {
            const currentDateTimeElement = document.getElementById('currentDateTime');
            if (currentDateTimeElement) {
                currentDateTimeElement.textContent = getCurrentDateTime();
            }
        }

        // Actualizar la hora inicial
        updateDateTime();

        // Configurar la actualización periódica de la hora
        setInterval(updateDateTime, 1000);
    </script>
