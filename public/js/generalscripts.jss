var base = 'http://sicefa.test';

if (window.history.replaceState) { // verificamos disponibilidad
    window.history.replaceState(null, null, window.location.href);
}

function ajaxReplace(element, route, data){
	//alert(data);
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

