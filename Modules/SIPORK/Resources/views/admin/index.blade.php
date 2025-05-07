@extends('sipork::layouts.master')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-center">Pigs List</h1> <!-- Centrado del título -->
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active">Pigs</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center"> <!-- Centrado del contenido -->
            <div class="col-md-11 offset-md-0" style="margin-left: 5%;"> <!-- Ajuste del margen izquierdo -->
                <div class="card shadow-sm"> <!-- Añadido sombra para mejor diseño -->
                    <div class="card-header bg-primary text-white d-flex justify-content-center align-items-center">
                        <h3 class="card-title mb-0 text-center flex-grow-1">Todos los Cerdos</h3>
                        <a href="{{ route('sipork.admin.sipork.admin.create') }}" class="btn btn-success btn-sm ml-auto" style="transition: all 0.3s ease; color: white;">Agregar Nuevo Cerdo</a>
                    </div>
                    <div class="card-body"> <!-- Añadido scroll horizontal -->
                        @if(session('success'))
                            <script>
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: "{{ session('success') }}",
                                    timer: 3000,
                                    showConfirmButton: false
                                });
                            </script>
                        @endif
                        @if($pigs->isEmpty())
                            <div class="alert alert-danger text-center">No hay cerdos registrados aún.</div>
                        @else
                            <div class="table-responsive" style="margin-left: 10px;"> <!-- Ajuste adicional del margen izquierdo -->
                                <table class="table table-bordered table-hover"> <!-- Aumentar el tamaño horizontal -->
                                    <thead class="thead-dark"> <!-- Encabezado oscuro -->
                                        <tr>
                                            <th>ID</th>
                                            <th>Fecha de Nacimiento</th>
                                            <th>Peso Inicial (kg)</th>
                                            <th>Sexo</th>
                                            <th>Raza</th>
                                            <th>Estado</th>
                                            <th>Fecha de Destete</th>
                                            <th>Fecha de Venta</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pigs as $pig)
                                            <tr>
                                                <td>{{ $pig->id_pig }}</td>
                                                <td>{{ $pig->birth_date }}</td>
                                                <td>{{ number_format($pig->initial_weight) }} kg</td>
                                                <td>{{ $pig->gender }}</td>
                                                <td>{{ $pig->breed }}</td>
                                                <td>{{ $pig->status }}</td>
                                                <td>{{ $pig->weaning_date ?? 'N/A' }}</td>
                                                <td>{{ $pig->sale_date ?? 'N/A' }}</td>
                                                <td>
                                                    <a href="{{ route('sipork.admin.sipork.admin.show', $pig->id_pig) }}" class="text-info" 
                                                        style="font-size: 1.5rem; transition: transform 0.3s ease, color 0.3s ease; color: #17a2b8;" 
                                                        onmouseover="this.style.transform='scale(1.2)'; this.style.color='darkcyan';" 
                                                        onmouseout="this.style.transform='scale(1)'; this.style.color='#17a2b8';">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('sipork.admin.sipork.admin.edit', $pig->id_pig) }}" class="text-warning" 
                                                        style="font-size: 1.5rem; transition: transform 0.3s ease, color 0.3s ease; color: #ffc107;" 
                                                        onmouseover="this.style.transform='scale(1.2)'; this.style.color='orange';" 
                                                        onmouseout="this.style.transform='scale(1)'; this.style.color='#ffc107';">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('sipork.admin.sipork.admin.destroy', $pig->id_pig) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete(this);">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" style="border: none; background: none; font-size: 1.5rem; transition: transform 0.3s ease, color 0.3s ease; color: red;" 
                                                            onmouseover="this.style.transform='scale(1.2)'; this.style.color='darkred';" 
                                                            onmouseout="this.style.transform='scale(1)'; this.style.color='red';" 
                                                            onclick="confirmDelete(this.form)">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>

                                                    <script>
                                                        function confirmDelete(form) {
                                                            Swal.fire({
                                                                title: '¿Estás seguro?',
                                                                text: "Esta acción no se puede deshacer.",
                                                                imageUrl: "{{ asset('images/advertencia.jpg') }}",
                                                                imageWidth: 160, // Increased width
                                                                imageHeight: 150, // Increased height
                                                                customClass: {
                                                                image: 'swal-image-custom' // Add a custom class for styling
                                                                },
                                                                showCancelButton: true,
                                                                confirmButtonColor: '#d33',
                                                                cancelButtonColor: '#3085d6',
                                                                confirmButtonText: 'Sí, eliminar',
                                                                cancelButtonText: 'Cancelar'
                                                            }).then((result) => {
                                                                if (result.isConfirmed) {
                                                                    form.submit();
                                                                }
                                                            });
                                                            return false;
                                                        }
                                                    </script>
                                                    <style>
                                                       .swal-image-custom {
                                                        border-radius: 10px; /* Add border radius to the image */
                                                        }
                                                     </style>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
