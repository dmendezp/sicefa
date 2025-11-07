@extends('sigac::layouts.master')

{{-- === Select2 & jQuery === --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@section('content')
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Reporte por ficha</h5>
    </div>

    <div class="card-body">
        <form id="reportForm" method="POST" action="{{ route('sigac.academic_coordination.reports.fichas.export') }}">
            @csrf
            <div class="row g-3">
                {{-- FICHA --}}
                <div class="mb-3">
                    <label for="ficha" class="form-label">Seleccione una ficha</label>
                    <select id="ficha" name="ficha" class="form-select" style="width: 100%;" required></select>
                </div>

                {{-- INSTRUCTOR --}}
                <div class="mb-3">
                    <label for="instructors" class="form-label">Seleccione instructor(es)</label>
                    <select id="instructors" name="instructors[]" class="form-select" multiple required>
                        <option value="">Seleccione una ficha primero...</option>
                    </select>
                    <small id="instHelp" class="form-text text-muted"></small>
                </div>

                {{-- BOTONES --}}
                <div class="col-md-2 d-flex align-items-end gap-2">
                    <button type="button" id="btnPreview" class="btn btn-outline-secondary w-100" disabled>
                        <i class="bi bi-eye"></i> Ver
                    </button>
                    <button type="submit" id="btnExport" class="btn btn-primary w-100" disabled>
                        <i class="bi bi-file-earmark-excel"></i> Descargar
                    </button>
                </div>
            </div>
        </form>

        {{-- VISTA PREVIA --}}
        <div id="previewWrapper" class="mt-4 d-none">
            <h6>Vista previa del detalle</h6>
            <div class="table-responsive">
                <table class="table table-sm table-bordered" id="previewTable">
                    <thead>
                        <tr>
                            <th>Instructor</th>
                            <th>Competencia</th>
                            <th>RA</th>
                            <th>Ficha</th>
                            <th>Programa</th>
                            <th>Trimestre</th>
                            <th>Horas (clase)</th>
                            <th>Fecha (clase)</th>
                            <th>Hora inicio</th>
                            <th>Hora fin</th>
                            <th>Primera clase</th>
                            <th>Última clase</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    const fichaSel = $('#ficha');
    const instSel = $('#instructors');
    const btnExport = $('#btnExport');
    const btnPreview = $('#btnPreview');
    const previewWrap = $('#previewWrapper');
    const previewBody = $('#previewTable tbody');
    const csrf = '{{ csrf_token() }}';

    // ====== FUNCIONES ======
    function setBtnState() {
        const enabled = fichaSel.val() && instSel.val().length > 0;
        btnExport.prop('disabled', !enabled);
        btnPreview.prop('disabled', !enabled);
    }

    function limpiarInstructores(mensaje = 'Seleccione una ficha primero...') {
        instSel.empty().append(`<option value="">${mensaje}</option>`).trigger('change');
        instSel.prop('disabled', true);
        setBtnState();
    }

    // ====== SELECT2 FICHAS ======
    fichaSel.select2({
        placeholder: 'Buscar ficha…',
        ajax: {
            url: '{{ route("sigac.fichas.buscar") }}',
            dataType: 'json',
            delay: 300,
            data: params => ({ q: params.term }),
            processResults: data => data, // { results: [...] }
            cache: true
        },
        minimumInputLength: 1
    });

    // ====== SELECT2 INSTRUCTORES ======
    instSel.select2({
        placeholder: 'Seleccione instructor(es)',
        allowClear: true
    });

    // ====== CARGAR INSTRUCTORES CUANDO CAMBIA LA FICHA ======
    fichaSel.on('change', function() {
        const ficha = $(this).val();
        limpiarInstructores();

        if (!ficha) return;

        $('#instHelp').text('Buscando instructores para la ficha seleccionada…');

        $.ajax({
            url: '{{ route("sigac.academic_coordination.reports.ficha.instructors", ["ficha" => "___"]) }}'
                .replace('___', encodeURIComponent(ficha)),
            type: 'GET',
            success: function(data) {
                instSel.prop('disabled', false).empty();
                if (!Array.isArray(data) || data.length === 0) {
                    limpiarInstructores('No hay instructores para esta ficha.');
                    $('#instHelp').text('No hay instructores para esta ficha.');
                    return;
                }

                data.forEach(instr => {
                    instSel.append(new Option(instr.name, instr.id, false, false));
                });

                instSel.trigger('change');
                $('#instHelp').text('Instructores cargados correctamente.');
                setBtnState();
            },
            error: function() {
                limpiarInstructores('Error cargando instructores.');
                $('#instHelp').text('Error cargando instructores.');
            }
        });
    });

    // ====== CAMBIO DE INSTRUCTOR ======
    instSel.on('change', function() {
        setBtnState();
        previewWrap.addClass('d-none');
    });

    // ====== VISTA PREVIA ======
    btnPreview.on('click', function() {
        if (!(fichaSel.val() && instSel.val().length)) return;

        previewBody.empty();
        previewWrap.removeClass('d-none');

        const url = '{{ route("sigac.academic_coordination.reports.fichas.preview") }}';
        const formData = new FormData();
        formData.append('_token', csrf);
        formData.append('ficha', fichaSel.val());
        instSel.val().forEach(id => formData.append('instructors[]', id));

        btnPreview.prop('disabled', true).text('Cargando…');

        fetch(url, {
            method: 'POST',
            body: formData
        })
        .then(async r => {
            btnPreview.text('Ver');
            setBtnState();
            if (!r.ok) throw new Error('Error HTTP ' + r.status);
            return r.json();
        })
        .then(rows => {
            previewBody.empty();

            if (!Array.isArray(rows) || !rows.length) {
                previewBody.html('<tr><td colspan="12">No hay registros para los filtros seleccionados.</td></tr>');
                return;
            }

            rows.forEach(r => {
                const tr = $('<tr></tr>');
                [
                    r.instructor,
                    r.competencia,
                    r.ra,
                    r.ficha,
                    r.programa,
                    r.trimestre,
                    r.horas_clase,
                    r.fecha_clase,
                    r.hora_inicio,
                    r.hora_fin,
                    r.fecha_inicio,
                    r.fecha_final
                ].forEach(val => tr.append(`<td>${val ?? ''}</td>`));
                previewBody.append(tr);
            });
        })
        .catch(err => {
            console.error(err);
            previewBody.html('<tr><td colspan="12">Error cargando vista previa.</td></tr>');
        });
    });

    // ====== VALIDAR SUBMIT ======
    $('#reportForm').on('submit', function(e) {
        if (!(fichaSel.val() && instSel.val().length)) {
            e.preventDefault();
            setBtnState();
        }
    });
});
</script>
@endpush
