$(document).ready(function(){


	$(document).on('click', '.btn-delete', function () {
		var id = $(this).data('object');
		var action = $(this).data('action');
		var url = base + '/' + $(this).data('path') + '/' + action + '/' + id;
		var title, text, icon;
		if(action=='delete'){
			title = 'Estas seguro de eliminar este elemento?';
			text ='Recuerda que esta acción enviará este elemento a la papelera o lo eliminará de forma definitiva!';
			icon = 'warning';
		}
		if(action=='restore'){
			title = 'Quieres restaurar este elemento?';
			text ='Esta acción restaurará el elemento y estará activo en la base de datos !';
			icon = 'info';
		}
		Swal.fire({
		  title: title,
		  text: text,
		  icon: icon,
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Si, Hazlo!',
		  cancelButtonText: 'No, Cancelar!'
		}).then((result) => {
		  if (result.value) {
		   window.location.href=url;
		  }
		})

	});


	$(document).on("click", "#btnSearchV", function () {
		var doc = $('#document_v').val();
		if(doc.length>0){
			ajaxReplace('votante','/evs/juries/search',$('#formSearchDocument').serialize());			
		}

	});

	$(document).on("click", "#btnAutorized", function () {
		var miObjeto = new Object();
		miObjeto.election = $('#election').val();
		miObjeto.document_v = $('#document_v').val();
		miObjeto.code = $('#code').val();
		miObjeto.jury = $('#jury').val();
		 
		var myString = JSON.stringify(miObjeto);

		//var array = {"document_v":$('#document_v').val(),"code":$('#code').val(),"jury":$('#jury').val() };
		
		ajaxReplace('votante','/evs/juries/authorized',myString);			
	});

});