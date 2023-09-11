$(document).ready(function(){

    $(document).on('click', '#btnSearch', function () {
        ajaxSearchPersonUser();
    });

    $('.alert').slideDown();
    setTimeout(function(){ $('.alert').slideUp(); }, 10000);

});

function ajaxSearchPersonUser(){
    document_number = $('#document_number').val();
    if(document_number == ''){
        alert('Es necesario ingresar un número de documento para consultar la persona');
    }else{
        var object = new Object();
        object.document_number = document_number;
        var data = JSON.stringify(object);
        ajaxReplace('divperson','/sica/admin/security/users/search/person',data);
    }
}
