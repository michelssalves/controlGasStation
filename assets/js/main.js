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
function abriNovaJanela(url) {

	window.open(url, 'visualizar', 'top=100,width=500,height=650');
	
}


