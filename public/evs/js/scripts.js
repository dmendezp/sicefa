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
			title = 'Quires restaurar este elemento?';
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

});