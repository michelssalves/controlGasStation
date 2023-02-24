function fecharModal(idCheque){

	visualizarCheque(idCheque)
}
async function visualizarCheque(id){
	
	const tabelaClasses = document.querySelector(".tabelaCheques")
	const visualizarChequeModal = new bootstrap.Modal(document.getElementById("visualizarChequeModal"))

	const formData = new FormData(); 
	formData.append("id", id); 

	const dados = await fetch('https://www.rdppetroleo.com.br/medwebnovo/controller/chequesDevolvidos.php?action=visualizarCheque', {
		method: "POST", 
		body: formData
	});
	const response = await dados.text()
	tabelaClasses.innerHTML = response
	visualizarChequeModal.show()

}
function incluirObservacao() {

	idChequeObs = document.getElementById("idCheque").value
	const incluirObs = new bootstrap.Modal(document.getElementById("incluirObservacaoModal"))
	incluirObs.show()
	document.getElementById("idChequeObs").value = idChequeObs
}
async function gravarObservacao() {

	const idCheque = document.getElementById("idChequeObs").value
	const observacao = document.getElementById("observacao").value
	const enviarEmail = document.getElementById("enviarEmail").checked
	const action = document.getElementById("actionObs").value

	const formData = new FormData(); 
	formData.append("id", idCheque); 
	formData.append("obs", observacao)
	formData.append("email", enviarEmail)

	await fetch('https://www.rdppetroleo.com.br/medwebnovo/controller/chequesDevolvidos.php?action='+action, {
		method: "POST", 
		body: formData
	});
	
	visualizarCheque(idCheque)

}
function cancelarCheque(){

	const idCheque = document.getElementById("idCheque").value
	const cancelarCheque = new bootstrap.Modal(document.getElementById("cancelarChequeModal"))
	cancelarCheque.show()
	document.getElementById("idChequeCancelar").value = idCheque

}
async function salvarCancelamento(){

	const idCheque = document.getElementById("idChequeCancelar").value
	const motivo = document.getElementById("motivoCancelamento").value
	const action = document.getElementById("actionCancelar").value
	const formData = new FormData(); 
	formData.append("id", idCheque); 
	formData.append("motivo", motivo)

	await fetch('https://www.rdppetroleo.com.br/medwebnovo/controller/chequesDevolvidos.php?action='+action, {
		method: "POST", 
		body: formData
	});

	visualizarCheque(idCheque)

}
function anexarArquivo() {

	const idChequeAnexo = document.getElementById("idCheque").value
	const incluirAnexoModal = new bootstrap.Modal(document.getElementById("incluirAnexoModal"))
	incluirAnexoModal.show()
	document.getElementById("idChequeAnexo").value = idChequeAnexo

}
async function salvarAnexo(){

	const idCheque = document.getElementById("idChequeAnexo").value
	const action = document.getElementById("actionAnexo").value
	const descricao = document.getElementById("descricao").value
	const arquivoAnexo = document.getElementById("arquivoAnexo").files[0]
	const formData = new FormData(); 
	formData.append("file", arquivoAnexo); 
	formData.append("id", idCheque)
	formData.append("descricao", descricao) 

	await fetch('https://www.rdppetroleo.com.br/medwebnovo/controller/chequesDevolvidos.php?action='+action, {
		method: "POST", 
		body: formData
	});

	visualizarCheque(idCheque)	

}
function confirmarQuitacao() {

	const idChequeQuitacao = document.getElementById("idCheque").value
	const confirmQuitacao = new bootstrap.Modal(document.getElementById("comfirmarQuitacaoModal"))
	confirmQuitacao.show()
	document.getElementById("idChequeQuitacao").value = idChequeQuitacao

}
async function salvarConfirmarQuitacao() {

	const idCheque = document.getElementById("idChequeQuitacao").value
	const action = document.getElementById("actionQuitar").value
	const arquivoQuitacao = document.getElementById("arquivoQuitacao").files[0]
	const formData = new FormData(); 

	formData.append("file", arquivoQuitacao)
	formData.append("id", idCheque) 

	await fetch('https://www.rdppetroleo.com.br/medwebnovo/controller/chequesDevolvidos.php?action='+action, {
		method: "POST", 
		body: formData
	});

	visualizarCheque(idCheque)
}
function confirmarPfin() {

	idChequePfin = document.getElementById("idCheque").value
	const pendenciaFinanceira = new bootstrap.Modal(document.getElementById("pendenciaFinanceira"))
	pendenciaFinanceira.show()
	document.getElementById("idChequePfin").value = idChequePfin

}
async function salvarConfirmarPfin(){

	const idCheque = document.getElementById("idChequePfin").value
	const action = document.getElementById("actionPfin").value
	const motivo = document.getElementById("motivo").value

	const formData = new FormData();
	formData.append("id", idCheque)
	formData.append("motivo", motivo)
	await fetch('https://www.rdppetroleo.com.br/medwebnovo/controller/chequesDevolvidos.php?action='+action, {
	  method: "POST", 
	  body: formData
	}); 
	
	visualizarCheque(idCheque)	

}

