(function () {

	$('[data-toggle="sidebar"]').click(function(event) {
		event.preventDefault();
		$('.app').toggleClass('sidenav-toggled');
	});

})();

(function () {

	const formulario = document.getElementById('formulario-cheques')
	$('[data-toggle="limpar-formulario"]').click(function(event) {

		event.preventDefault();
		formulario.reset()
	});

})();



