$('#program_id').change(function() {
    const programId = $(this).val();
    filterApprentices(programId);
  });
  function filterApprentices(technologistId) {
    // Define la URL para obtener los aprendices según el tecnólogo
    const url = "{{ route('getApprenticesByProgram') }}";

    // Realiza una solicitud AJAX para obtener la lista de aprendices
    $.ajax({
      url: url,
      type: 'GET',
      data: { technologist_id: technologistId },
      success: function(data) {
        // Limpia la lista actual de aprendices
        $('#apprentice_id').empty();

        // Agrega las opciones de aprendices según el tecnólogo seleccionado
        $.each(data, function(key, value) {
          $('#apprentice_id').append('<option value="' + key + '">' + value + '</option>');
        });
      },
      error: function(error) {
        console.error('Error al obtener los aprendices: ' + error.responseText);
      }
    });
  }

