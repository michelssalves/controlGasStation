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

(function () {

	$('[data-toggle="sem-solucao"]').click(function(event) {

		const cadModal = new bootstrap.Modal(document.getElementById("registerUserModal"))

		//event.preventDefault();

		/*let html = '<form method="post">'
			html += '<input type="" value="" name="$id">'
			html += '<input type="" value="semsolucao" name="acao">'
			html += '<table><tr><th colspan="2"><center><input type="text" name="obs" placeholder="Coloque aqui a justificativa">'
		let	teste = '<input type="button" value="Confirma" onClick="this.form.submit()" ></th> </tr></table></form></div>'
			//document.querySelector('#alteracoes').innerHTML = teste*/

		    $('#alteracoes').html('<form method="post"> <input type="" value="" name="$id"> <input type="" value="semsolucao" name="acao"> <table><tr><th colspan="2"><center><input type="text" name="obs" placeholder="Coloque aqui a justificativa"><input type="button" value="Confirma" onClick="this.form.submit()"></th> </tr></table></form></div>')
		alert('aasda')
   	
	});

})();

function abriNovaJanela(url) {

	window.open(url, 'visualizar', 'top=100,width=500,height=650');
	
}




