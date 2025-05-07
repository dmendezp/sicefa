@extends('sipork::layouts.master')

@section('content')
<br><br><br>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-primary"><i class="fas fa-piggy-bank"></i> Detalles del Cerdo #{{ $pig->id_pig }}</h1>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb float-sm-right bg-white shadow-sm p-3 rounded">
                        <li class="breadcrumb-item">
                            <a href="" class="text-primary font-weight-bold">
                                <i class="fas fa-home"></i> Home
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('sipork.admin.sipork.admin.index') }}" class="text-primary font-weight-bold">
                                <i class="fas fa-piggy-bank"></i> Pigs
                            </a>
                        </li>
                        <li class="breadcrumb-item active font-weight-bold text-secondary" aria-current="page">
                            <i class="fas fa-info-circle"></i> Pig Details
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <h3 class="card-title text-center w-100"><i class="fas fa-info-circle"></i> Información del Cerdo</h3>
                            <div class="card-tools ml-auto d-flex">
                                <a href="{{ route('sipork.admin.sipork.admin.edit', $pig->id_pig) }}" class="btn btn-warning btn-sm mr-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('sipork.admin.sipork.admin.destroy', $pig->id_pig) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete();">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-4 font-weight-bold text-secondary">ID</dt>
                            <dd class="col-sm-8">{{ $pig->id_pig }}</dd>
                            <dt class="col-sm-4 font-weight-bold text-secondary">Fecha de Nacimiento</dt>
                            <dd class="col-sm-8">{{ $pig->birth_date }}</dd>
                            <dt class="col-sm-4 font-weight-bold text-secondary">Peso Inicial</dt>
                            <dd class="col-sm-8">{{ $pig->initial_weight }} kg</dd>
                            <dt class="col-sm-4 font-weight-bold text-secondary">Género</dt>
                            <dd class="col-sm-8">{{ $pig->gender == 'M' ? 'Macho' : 'Hembra' }}</dd>
                            <dt class="col-sm-4 font-weight-bold text-secondary">Raza</dt>
                            <dd class="col-sm-8">{{ $pig->breed }}</dd>
                            <dt class="col-sm-4 font-weight-bold text-secondary">Estado</dt>
                            <dd class="col-sm-8">{{ $pig->status }}</dd>
                            <dt class="col-sm-4 font-weight-bold text-secondary">Fecha de Destete</dt>
                            <dd class="col-sm-8">{{ $pig->weaning_date ?? 'N/A' }}</dd>
                            <dt class="col-sm-4 font-weight-bold text-secondary">Fecha de Venta</dt>
                            <dd class="col-sm-8">{{ $pig->sale_date ?? 'N/A' }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function confirmDelete(event) {
        event.preventDefault();
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡Esta acción no se puede deshacer!",
            imageUrl: "{{ asset('images/image.jpg') }}",
            imageWidth: 160,
            imageHeight: 150,
            customClass: {
                image: 'swal-image-custom'
            },
            imageAlt: 'Pig Warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                event.target.submit();
            }
        });
    }

    document.querySelectorAll('form[onsubmit="return confirmDelete();"]').forEach(form => {
        form.onsubmit = function(event) {
            confirmDelete(event);
        };
    });
</script>

<style>
    .swal-image-custom {
        border-radius: 10px;
    }
    .card {
        border-radius: 15px;
    }
    .breadcrumb {
        background-color: #f8f9fa;
    }
    .breadcrumb-item a {
        text-decoration: none;
    }
</style>
@endsection