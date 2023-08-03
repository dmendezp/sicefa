$(document).ready(function(){

    $(document).on('click', '#btnSearch', function () {
        ajaxSearchPersonUser();
    });

    $('.alert').slideDown();
    setTimeout(function(){ $('.alert').slideUp(); }, 10000);

});    
    
    function ajaxSearchPersonUser(){
        var doc = $('#document_number').val();
        if(doc.length>0){
            var miObjeto = new Object();
            miObjeto.document_number = $('#document_number').val();
            miObjeto.id = $('#id').val();
            miObjeto.nickname = $('#nickname').val();
            miObjeto.personal_email = $('#personal_email').val();
            $('.old').remove();
            var myString = JSON.stringify(miObjeto);
                ajaxReplace('divperson','/sica/admin/security/user/search',myString);
        } 
    }