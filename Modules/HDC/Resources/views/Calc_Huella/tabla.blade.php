<div class="row justify-content-center">
    <!-- card -->
    <div class="content mt-3">
        <div class="container-fluid">
            <div class="card card-success card-outline shadow mt-3">
                <div class="card-header">
                    <h3 class="card-title">Registros de CO2 de {{ $persona->full_name }}</h3>
                </div>
                <div class="card-body">
                    <a href="{{ route('Carbonfootprint.form.calculates') }}" class="btn btn-success mb-2"><i class="fa-solid fa-plus"></i></a>
                    <div class="mtop16">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Tipo de combustible</th>
                                    <th>Personas en el hogar</th>
                                    <th>consumo de gas (mes)</th>
                                    <th>consumo de electricidad (mes)</th>
                                    <th>CO2 (%)</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                               <tr>
                                <td>1</td>
                                <td>2</td>
                                <td>3</td>
                                <td>4</td>
                                <td>5</td>
                                <td>6</td>
                                <td>
                                    <a href="#" class="btn btn-warning"><i class="fa-solid fa-pencil"></i></a>
                                    <a href="" class= "btn btn-danger"><i class="fas fa-trash"></i></a>
                                </td>

                               </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- card  --}}
</div>

