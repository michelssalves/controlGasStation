const tabela = document.querySelector(".listar-filtro")

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




async function consultar(dados){

    console.log(dados)
    const response = await dados.text()
    console.log(response)
    tabela.innerHTML = response
}