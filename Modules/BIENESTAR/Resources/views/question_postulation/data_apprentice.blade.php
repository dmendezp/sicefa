<div class="row justify-content-center mt-4">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-body">
                @foreach ($resultados as $resultado)
                <ul class="list-unstyled">
                    <div class="form-container">
                        <h3>Información Personal</h3>
                        <div class="form-group">
                            <label for="document_number">Documento:</label>
                            <input type="text" id="document_number" value="{{ $resultado->document_number }}" class="form-control" readonly>
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
                        <div class="form-group">
                            <label for="population_group_id">Nivel del Sisben:</label>
                            <input type="text" id="population_group_id" value="{{ $resultado->sisben_level }}" class="form-control" readonly>
                        </div>
                    </div>
                </ul>
                @endforeach
                <div>

                </div>
            </div>
        </div>
    </div>
</div>