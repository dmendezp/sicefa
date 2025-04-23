@extends('gdf::layouts.master')

@section('content')

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Registro Exitoso',
        text: "{{ session('success') }}",
        confirmButtonText: 'Entendido'
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Acceso Denegado',
        text: "{{ session('error') }}",
        confirmButtonText: 'Entendido'
    });
</script>
@endif

<div class="cert-container mt-5 mb-5">
    <h1 class="titulo">📑 Lista de Certificados</h1>
    <a href="{{ route('cefa.gdf.admin.welcome') }}" class="btn-back">← Regresar</a>

    <div class="table-responsive mt-3" style="animation: fadeInUp 1.5s ease;">
        <table class="table table-hover custom-table">
            <thead>
                <tr>
                    <th>🆔 ID</th>
                    <th>📌 Código</th>
                    <th>📅 Fecha de Emisión</th>
                    <th>🆔 Cédula Funcionario</th>
                    <th>📝 Descripción</th>
                    <th>⚙️ Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($certificates as $certificate)
                <tr>
                    <td>{{ $certificate ->id }}</td>
                    <td>{{ $certificate ->certified_code }}</td>
                    <td>{{ $certificate ->issue_date }}</td>
                    <td>{{ $certificate ->official_id }}</td>
                    <td>{{ $certificate ->description }}</td>
                    <td>
                        <a href="{{ route('cefa.gdf.edit_certificate', $certificate->id) }}" class="btn-action edit">✏️ Editar</a>
                        <a href="#" class="btn-action delete" data-url="{{ route('cefa.gdf.destroy_certificate', $certificate->id) }}">
                            🗑️ Eliminar
                        </a>                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<link rel="stylesheet" href="{{ asset('modules/gdf/css/certificate/index.css') }}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelectorAll('.delete').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const url = this.getAttribute('data-url');

            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡Esta acción no se puede deshacer!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#B00808FF',
                confirmButtonText: 'Sí, eliminarlo',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirigir al enlace de eliminación
                    window.location.href = url;
                }
            });
        });
    });
</script>


@endsection
