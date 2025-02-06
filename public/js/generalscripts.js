var base = $(location).attr("origin");

function ajaxReplace(element, route, data){
    if(element.length>0){
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $.ajax({
            method: "POST",
            url: base+route,
            data: { data }
        })
        .done(function(html) {
            $("#"+element).html(html);
        });
    }else{
        $("#"+element).empty()
    }

}

