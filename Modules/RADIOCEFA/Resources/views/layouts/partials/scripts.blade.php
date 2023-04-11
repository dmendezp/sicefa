<script>
	let hoy = new Date();

	let dia = hoy.getDate();
	let mes = hoy.getMonth() + 1;
	let agnio = hoy.getFullYear();

	dia = ('0' + dia).slice(-2);
	mes = ('0' + mes).slice(-2);

	

	let formato1 = agnio + '-' + mes +'-'+ dia;
	

	// crear lista de fechas	
	const tr = document.getElementById('fecha');
	const th = document.createElement('th');
	th.textContent = formato1;
	tr.appendChild(th);

</script>



@yield('scripts')