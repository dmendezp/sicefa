<label>Actividades</label>
<div class="input-group">
    <div class="input-group-prepend w-100">
        <span class="input-group-text" id="basic-addon1">
            <i class="fas fa-user-alt fs-10"></i> <!-- Ajusta el tamaño aquí -->
        </span>
        <select class="form-select" name="activity_id" id="activity_id">
            <option value="">-- Seleccione --</option>
            @foreach($activities as $activi)
                <option value="{{ $activi->id }}">{{ $activi->name }}</option>
            @endforeach
        </select>
    </div>
</div>

{{--  @push('scripts')
    <script>
        // Cuando se cambia la unidad productiva seleccionada
        $(document).on("change", "#activity_id", function() {
        // Obtener el valor seleccionado del campo 'activity_id'
             activity_id = $(this).val();
            if (activity_id == '') {
                $("#div-tabla").html('Seleccione la unidad');
            } else {
                var myObjet = new Object();
                myObjet.activity_id = $('#activity_id').val();
                var myString = JSON.stringify(myObjet);
                 console.log('Datos enviados:', myString);

                ajaxReplace("div-tabla", '/hdc/tabla_aspectosambientales', myString);
            }
        });
    </script>
@endpush  --}}
