@extends('sica::layouts.master')

@section('stylesheet')
    @livewireStyles()
    <style>
        td, th {
            border-color: black !important;
        }
    </style>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md">
                                <h4>Relación de roles y unidades productivas</h4>
                            </div>
                            <div class="col-md-auto px-0">
                                <a href="{{ route('sica.admin.security.roles.index') }}" class="btn btn-info float-right ml-1">
                                    <i class="fa-solid fa-angles-left fa-beat-fade mr-1"></i> Roles
                                </a>
                            </div>
                            <div class="col-md-auto px-0">
                                <a href="{{ route('sica.admin.security.roles.permision_role.index') }}" class="btn btn-info float-right ml-1">
                                  <i class="fa-solid fa-angles-left fa-beat-fade mr-1"></i> Roles y permisos
                                </a>
                            </div>
                            <div class="col-md-auto px-0">
                                <a href="{{ route('sica.admin.security.roles.responsibilities.index') }}" class="btn btn-info float-right ml-1">
                                  <i class="fa-solid fa-angles-right fa-beat-fade mr-1"></i> Responsabilidades
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        {{-- Se incluye el componente que muestra todas las asociaciones de unidad productiva y rol registradas --}}
                        @livewire('sica::admin.security.pu-roles.show-list')

                    </div>
                    <!-- /.card-body -->
                </div>

            </div>
        </div>
    </div>

    <!-- Modal para registro de asociación de unidad productiva y rol -->
    <div class="modal fade" id="pu_role-registration-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                {{-- Se incluye el componente que contiene el formulario de registro de responsabilidad --}}
                @livewire('sica::admin.security.pu-roles.registration-form')

            </div>
        </div>
    </div>
@endsection

@section('script')
    @livewireScripts()
    <script>
        $(document).ready(function() {
            // Capturar el evento de cierre del modal de registro de responsabilidad
            $('#pu_role-registration-modal').on('hidden.bs.modal', function (e) {
                // Limpiar valores internos del formulario
                Livewire.emit('resetForm');
            });

            // Capturar evento para cerrar el modal cuando se realize un registro de responsabilidad
            Livewire.on('close-registration-modal', function() {
                $('#pu_role-registration-modal').modal('hide');
            });

            // Mostrar mensaje de registro exitoso
            Livewire.on('message-livewire', function(icon, message) {
                Toast.fire({
                    icon: icon,
                    title: ' '+message
                })
            });
        });

        function confirmDelete(role_id, productive_unit_id, role, productive_unit) {
            Swal.fire({
                title: '¿Estás seguro de que deseas eliminar la asociación del rol '+role+' con la unidad productiva '+productive_unit+'?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('confirmDestroyPuRole', role_id, productive_unit_id); // Emitir evento para eliminar asociación de rol y unidad productiva
                }
            });
        }
    </script>

    @section('sripts-register-pu_role') @show <!-- Scripts necesarios para registrar una asociación de rol y unidad productiva -->

@endsection

