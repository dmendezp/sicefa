<!DOCTYPE html>
<html lang="en">
@include('senaempresa::layouts.structure.head')

<body>
    @csrf
    <div class="wrapper">

        <!-- Navbar -->
        @include('senaempresa::layouts.structure.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('senaempresa::layouts.structure.aside')
        @include('senaempresa::layouts.structure.breadcrumb')

        <div class="container">
            <div class="col-md-12">
                <div class="vacantes">
                    <div class="card-header">{{ $title }}</div>
                    <div class="card-body">
                        <table id="datatable" class="table table-sm table-striped">
                            <thead class="vacant bg-primary text-white">
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Agregar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Estrategia 34</td>
                                    <td>Analisis</td>
                                    <td>
                                        <a href="#" class="btn btn-success">Agregar</a>
                                        <a href="" class="btn btn-success">Editar</a>
                                        <a href="#" class="btn btn-success">Eliminar</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <h1>Eliminar Nota</h1>

  <p>¿Estás seguro de que deseas eliminar esta nota?</p>

  <button onclick="eliminarNota()">Eliminar</button>

  <script>
    function eliminarNota() {
      var urlParams = new URLSearchParams(window.location.search);
      var notaId = urlParams.get("id");

      if (notaId !== null) {
        var notas = JSON.parse(localStorage.getItem("notas")) || [];

        if (notaId >= 0 && notaId < notas.length) {
          notas.splice(notaId, 1);
          localStorage.setItem("notas", JSON.stringify(notas));
        }
      }

      window.location.href = "calificaciones.html";
    }
  </script>


        @section('content')
        @show

        <!-- Control Sidebar -->

        <!-- /.control-sidebar -->


    </div>

    <!-- Main Footer -->
    @include('senaempresa::layouts.structure.footer')

    @include('senaempresa::layouts.structure.scripts')

    <!--scripts utilizados para procesos-->
    @section('scripts')
    @show

    @section('dataTables')
    @show


</body>

</html>

