<!DOCTYPE html>
<html lang="es">

<head>
    @include('hangarauto::layouts.partials.head')
    @stack('head')
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed sidebar-collapse">


    <div class="wrapper">
        <!-- Navbar -->
        @include('hangarauto::layouts.partials.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('hangarauto::layouts.partials.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="background-color:#a9c3ba;">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('cefa.hangarauto.index') }}"
                                        class="text-decoration-none">HANGARAUTO</a></li>
                                @stack('breadcrumbs')
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <!-- Container-fluid -->
                <div class="container-fluid">
                    @section('content') @show
                </div>
                <!--/. container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- ./wrapper -->

    <!-- Main Footer -->
    @include('hangarauto::layouts.partials.footer')

    @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 1500,
                    customClass: {
                        popup: 'my-custom-popup-class',
                    },
                });
            </script>
        @endif

        @if (session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: '{{ session('error') }}',
                    showConfirmButton: false,
                    timer: 15000,
                    customClass: {
                        popup: 'my-custom-popup-class',
                    },
                });
            </script>
        @endif

        
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const deleteButtons = document.querySelectorAll('.btnEliminar');
    
                deleteButtons.forEach((deleteButton) => {
                    deleteButton.addEventListener('click', () => {
                        const formId = deleteButton.dataset.formId;
                        const form = document.getElementById(formId);
    
                        Swal.fire({
                            title: "¿Estás seguro?",
                            text: "Una vez eliminado, ¡no podrás recuperar este registro!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#d33",
                            cancelButtonColor: "#3085d6",
                            confirmButtonText: "Sí, eliminar",
                            cancelButtonText: "Cancelar"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Envía el formulario de manera convencional
                                form.submit();
                            } else {
                                Swal.fire('Cancelado', 'La acción ha sido cancelada', 'info');
                            }
                        });
                    });
                });
            });
        </script>


        <script>
            $(document).ready(function() {
                // Manejar clics en el enlace de eliminar
                $('.btn-delete').click(function(e) {
                    e.preventDefault();
                    var url = $(this).attr('href');
                    
                    // Mostrar alerta de confirmación de SweetAlert
                    Swal.fire({
                        title: "¿Estás seguro?",
                        text: "Una vez eliminado, ¡no podrás recuperar este registro!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Sí, eliminar",
                        cancelButtonText: "Cancelar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Si el usuario confirma, redirigir al enlace de eliminación
                            window.location.href = url;
                        }  else {
                            Swal.fire('Cancelado', 'La acción ha sido cancelada', 'info');
                        }
                    });
                });
            });
        </script>

    <!-- REQUIRED SCRIPTS -->
    @include('hangarauto::layouts.partials.scripts')
    @stack('scripts')
</body>

</html>
