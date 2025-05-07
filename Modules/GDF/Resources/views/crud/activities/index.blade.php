@extends('gdf::layouts.master')

<link rel="stylesheet" href="{{ asset('modules/gdf/css/certificate/index.css') }}">

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
    <h1 class="titulo">📑 Lista de Actividades</h1>
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
                    <th>📝 Estado</th>
                    <th>⚙️ Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ( as )
                <tr>
                    <td>{{  -> }}</td>
                    <td>{{  -> }}</td>
                    <td>{{  -> }}</td>
                    <td>{{  -> }}</td>
                    <td>{{  -> }}</td>
                    <td>
                        @if (-> == 'aprobado')
                            <span class="text-green-600 font-bold">✅ Aprobado</span>
                        @elseif (-> == 'rechazado')
                            <span class="text-red-600 font-bold">❌ Rechazado</span>
                        @else
                            <span class="text-yellow-500">⏳ Pendiente</span>
                        @endif
                    </td>
                    <td>
                        @if (-> === 'pendiente')
                            <form action="{{ route('cefa.gdf.aprobar_certificate', ->) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn-action edit">✅ Aprobado</button>
                            </form>
                    
                            <form action="{{ route('cefa.gdf.rechazar_certificate', ->) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn-action delete">❌ Rechazado</button>
                            </form>
                        @else
                            @if (-> === 'aprobado')
                                <span class="text-green-600 font-bold">✅ Certificado Aprobado</span>
                            @elseif (-> === 'rechazado')
                                <span class="text-red-600 font-bold">❌ Certificado Rechazado</span>
                            @endif
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

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
