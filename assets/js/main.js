(function () {

	$('[data-toggle="sidebar"]').click(function(event) {
		event.preventDefault();
		$('.app').toggleClass('sidenav-toggled');
	});

})();
function abriNovaJanela(url) {

	window.open(url, 'visualizar', 'top=100,width=500,height=650');
	
}
function confirmarQuitacao(id_cheque){
	console.log(id_cheque)

    const confirmQuitacao = new bootstrap.Modal(document.getElementById("comfirmarQuitacaoModal"))
	document.getElementById("id_cheque_quitacao").value = id_cheque
    confirmQuitacao.show()
   
}	
function semSolucao(id_cheque){

	console.log(id_cheque)

    const semSolucao = new bootstrap.Modal(document.getElementById("semSolucaoModal"))
	document.getElementById("id_cheque_solucao").value = id_cheque
    semSolucao.show()
   
}	
function incluirObservacao(id_cheque, med){

	console.log(id_cheque)

    const incluirObs = new bootstrap.Modal(document.getElementById("incluirObservacaoModal"))
	document.getElementById("id_cheque_obs").value = id_cheque
	document.getElementById("med").value = med
    incluirObs.show()
   
}	
function incluirAnexo(id_cheque){

	console.log(id_cheque)

    const incluirAnexo = new bootstrap.Modal(document.getElementById("incluirAnexoModal"))
	document.getElementById("id_cheque_anexo").value = id_cheque
    incluirAnexo.show()
   
}		






