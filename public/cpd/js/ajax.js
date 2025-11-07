function ajaxAction(route){ /* Ajax to show content modal to add event */
    $('#loader-message').text('Cargando contenido...'); /* Add content to loader */
    $('#modal-content').append($('#modal-loader').clone()); /* Add the loader to the modal */
    $.ajaxSetup({
        headers:     {
            'X-CSRF-TOKE': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        method: "get",
        url: route,
        data: {}
    })
    .done(function(html){
        $("#modal-content").html(html);
    });
}

$("#generalModal").on("hidden.bs.modal", function () { /* Modal content is removed when the modal is closed */
    $("#modal-content").empty();
});
