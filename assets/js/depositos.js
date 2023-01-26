function fecharModal(id){

	
	visualizarDeposito(id)

}
async function visualizarDeposito(id){

	const tabelaObsDepositos = document.querySelector(".tabelaObsDepositos")
	const alterarDeposito = new bootstrap.Modal(document.getElementById("alterarDeposito"))
	const formData = new FormData();
	formData.append("id", id)
	const dados = await fetch('https://www.rdppetroleo.com.br/medwebnovo/controller/depositos.php?action=visualizarDeposito', {
	  method: "POST", 
	  body: formData
	}); 

	const response = await dados.json()

	const tabelaobs = response['tabela'].toString()
	alterarDeposito.show()
	tabelaObsDepositos.innerHTML = tabelaobs
	document.getElementById("idDeposito").value = response['dados'].id_reg
	document.getElementById("loginNameDepositoAlterar").value = response['dados'].loginName
	document.getElementById("debitoDepositoAlterar").value = response['dados'].debito
	document.getElementById("dinheiroDepositoAlterar").value = response['dados'].dinheiro
	document.getElementById("contaDepositoAlterar").value = response['dados'].conta
	document.getElementById("chequeDepositoAlterar").value = response['dados'].cheque
	document.getElementById("contaChDepositoAlterar").value = response['dados'].contaCh
	document.getElementById("dataMovimentoDepositoAlterar").value = response['dados'].DATA


}
async function alterarDeposito(idForm){

	const action = document.getElementById("actionaAlterar").value
	const id = document.getElementById("idDeposito").value
	const formData = new FormData(idForm);
	await fetch(`https://www.rdppetroleo.com.br/medwebnovo/controller/depositos.php?action=${action}`, {
	  method: "POST", 
	  body: formData
	}); 

	visualizarDeposito(id)

}
function incluirObservacao(){

	const idDepositoObs = document.getElementById("idDeposito").value
	const incluirObservacaoModal = new bootstrap.Modal(document.getElementById("incluirObservacaoModal"))
	incluirObservacaoModal.show()
	document.getElementById("idDepositoObs").value = idDepositoObs 

}
async function salvarObservacao(idForm){

	const action = document.getElementById("actionaObs").value
	const id = document.getElementById("idDepositoObs").value
	const formData = new FormData(idForm);
	await fetch(`https://www.rdppetroleo.com.br/medwebnovo/controller/depositos.php?action=${action}`, {
	  method: "POST", 
	  body: formData
	}); 

	visualizarDeposito(id)

}