$(document).ready(function(){


    $(document).on("click", "#btnBuscarApprentices", function () {
      var miObjeto = new Object();
      miObjeto.course_id = $('#course_id').val();
      var myString = JSON.stringify(miObjeto);
      ajaxReplace('divApprentices','/sica/admin/people/apprentices/search',myString);     
    });


});