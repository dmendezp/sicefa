<div id="nueva_vacante" class="modal fade" role="dialog">
    <div class="modal-dialog" style="max-width: 400px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nueva Vacante</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center align-items-center">
                    <form action="{{ route('nueva_vacante') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Presentación</label><br>
                            <input type="file" id="image" name="image">
                        </div>
                        <div class="mb-3">
                            <label for="description_general" class="form-label">Descripción General</label>
                            <textarea class="form-control" id="description_general" name="description_general" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="requirement" class="form-label">Requisitos</label><br>
                            <input type="text" class="form-control" id="requirement" name="requirement"
                                placeholder="Requisitos">
                        </div>
                        <div class="mb-3">
                            <label for="position_company_id" class="form-label">Id Cargo</label>
                            <select class="form-control" name="position_company_id" aria-label="Selecciona un Cargo">
                                <option value="" selected>Selecciona un Cargo</option>
                                @foreach ($PositionCompany as $positionCompany)
                                    <option value="{{ $positionCompany->id }}">
                                        {{ $positionCompany->description }} (ID: {{ $positionCompany->id }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="start_datetime" class="form-label">Fecha y Hora de Inicio</label>
                            <input type="datetime-local" class="form-control" id="start_datetime" name="start_datetime"
                                placeholder="Fecha Inicio">
                        </div>
                        <div class="mb-3">
                            <label for="end_datetime" class="form-label">Fecha y Hora de Fin</label>
                            <input type="datetime-local" class="form-control" id="end_datetime" name="end_datetime"
                                placeholder="Fecha Inicio">
                        </div><br>
                        <button type="submit" class="btn btn-success">Agregar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal agregar nueva vacante -->
