<div class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="card card-success card-outline shadow col-md-5 mt-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <label for="user_id">Labor</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fas fa-user-alt fs-10"></i> <!-- Ajusta el tamaño aquí -->
                                    </span>
                                </div>
                                @csrf {{-- Este token es necesario para enviar información de manera segura --}}
                                <select class="form-select" aria-label="Default select example">
                                            <option selected>Seleccione la Labor </option>
                                            <option value="1"></option>
                                </select>

                                <div class="d-flex justify-content-center mt-6"> <!-- Agregamos el contenedor aquí -->
                                    <button class="btn btn-success" onclick="calculosUsuario()">Aceptar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>

