
    // Obtener la URL para obtener los aprendices según el programa seleccionado
    const getApprenticesUrl = "{{ route('getApprenticesByProgram') }}";

    // Manejar el evento de cambio en el programa seleccionado
    $('#program').change(function() {
        const programId = $(this).val();

        // Hacer una solicitud AJAX para obtener la lista de aprendices según el programa
        $.ajax({
            url: getApprenticesUrl,
            type: 'GET',
            data: { program_id: programId },
            success: function(data) {
                // Limpiar la lista actual de aprendices
                $('#apprentice').empty();

                // Agregar las opciones de aprendices según el programa seleccionado
                $.each(data, function(key, value) {
                    $('#apprentice').append('<option value="' + key + '">' + value + '</option>');
                });
            },
            error: function(error) {
                console.error('Error al obtener los aprendices: ' + error.responseText);
            }
        });
    });

