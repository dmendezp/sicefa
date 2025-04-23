@extends('gdf::layouts.master')

<link rel="stylesheet" href="{{ asset('modules/gdf/css/certificate/create.css') }}">

@section('content')
<div class="glass-container">
    <h2>✏️ Editar Certificado</h2>

    <form action="{{ route('cefa.gdf.update_certificate', $certificate->id) }}" method="POST" id="cert-form">
        @csrf
        @method('PUT')
    
        <div class="form-group">
            <label for="codigo_certificado">Código del Certificado</label>
            <input type="text" id="codigo_certificado" name="certified_code" maxlength="10" value="{{ old('certified_code', $certificate->certified_code) }}" required>
        </div>
    
        <div class="form-group">
            <label for="fecha_emision">Fecha de Emisión</label>
            <input type="date" id="fecha_emision" name="issue_date" value="{{ old('issue_date', $certificate->issue_date) }}" required>
        </div>
    
        <div class="form-group">
            <label for="cedula_funcionario">Cédula del Funcionario</label>
            <input type="text" id="cedula_funcionario" name="official_id" maxlength="10" value="{{ old('official_id', $certificate->official_id) }}" required>
        </div>
    
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="description" rows="4" required>{{ old('description', $certificate->description) }}</textarea>
        </div>
    
        <button type="submit" class="btn-submit">
            <i class="fas fa-save"></i> Actualizar Certificado
        </button>
    
        <a href="{{ route('cefa.gdf.index_certificate') }}" class="btn-cancelar">
            <i class="fas fa-times-circle"></i> Cancelar
        </a>        
    </form>
    
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('cert-form').addEventListener('submit', function (e) {
        const code = document.getElementById('codigo_certificado').value.trim();
        const date = document.getElementById('fecha_emision').value.trim();
        const id = document.getElementById('cedula_funcionario').value.trim();
        const desc = document.getElementById('descripcion').value.trim();

        let errors = [];

        if (!/^\d{1,10}$/.test(code)) {
            errors.push("🔢 Código inválido: solo números, máx. 10 dígitos.");
        }
        if (!/^\d{1,10}$/.test(id)) {
            errors.push("🆔 Cédula inválida: solo números, máx. 10 dígitos.");
        }
        if (!date) {
            errors.push("📅 La fecha de emisión es obligatoria.");
        }
        if (!desc) {
            errors.push("📝 La descripción no puede estar vacía.");
        }

        if (errors.length > 0) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Corrige los siguientes errores:',
                html: errors.map(e => `<p>${e}</p>`).join(''),
                confirmButtonText: 'Entendido'
            });
        }
    });
</script>
@endsection
