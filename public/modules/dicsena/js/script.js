$(document).ready(function() {

    $('#btn-translate').click(function() {

        $.ajax({
            url: '/translate',
            cache: false,
            type: 'GET',
            data: {
                source_lang: $('#source_lang').val(),
                target_lang: $('#target_lang').val(),
                text: $('#text').val(),
            },
            success: function(response) {

                $('#translation').html(response);
            }
        });
    });
});