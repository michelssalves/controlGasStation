async function buscaCep(cep) {

	if (cep.length >= 8) {

		const dados = await fetch(`https://viacep.com.br/ws/const {cep}/json/`)
		//console.log(dados)
		const response = await dados.json()
		console.log(response)
		console.log(response['erro'])
		if (response['erro'] != true) {

			document.getElementById('endereco').value = response['logradouro']
			document.getElementById('bairro').value = response['bairro']
			document.getElementById('uf').value = response['uf']
			document.getElementById('cidade').value = response['localidade']
		}
	} else {
		document.getElementById('endereco').value = 'ERROR'
		document.getElementById('bairro').value = 'ERROR'
		document.getElementById('uf').value = 'ERROR'
		document.getElementById('cidade').value = 'ERROR'
	}

}
function esconderSideBar() {

	const nomeClasseBody = document.getElementById('idBody').className;
	const el = document.getElementById('idBody');

	if (nomeClasseBody == 'app sidebar-mini') {

		el.classList.remove('app', 'sidebar-mini');
		el.classList.add('app', 'sidebar-mini', 'sidenav-toggled');

	} else {
		el.classList.remove('app', 'sidebar-mini', 'sidenav-toggled');
		el.classList.add('app', 'sidebar-mini');

	}

}
function abriNovaJanela(url) {

	window.open(url, 'visualizar', 'top=100,width=500,height=650');

}
function confirmarQuitacao(id_cheque) {

	const confirmQuitacao = new bootstrap.Modal(document.getElementById("comfirmarQuitacaoModal"))
	document.getElementById("id_cheque_quitacao").value = id_cheque
	confirmQuitacao.show()

}
function semSolucao(id_cheque) {

	const semSolucao = new bootstrap.Modal(document.getElementById("semSolucaoModal"))
	document.getElementById("id_cheque_solucao").value = id_cheque
	semSolucao.show()

}
function incluirObservacao(id) {

	console.log(id)

	const incluirObs = new bootstrap.Modal(document.getElementById("incluirObservacaoModal"))
	document.getElementById("id_observacao").value = id
	incluirObs.show()

}
function acoesRequisicao(id, statusCliente, tipo, cliente, valor) {

	const acoesRequisicao = new bootstrap.Modal(document.getElementById("acoesRequisicaoModal"))
	document.getElementById("id_requisicaoAcoes").value = id
	document.getElementById("statusClienteAcoes").value = statusCliente
	document.getElementById("tipoAcoes").value = tipo
	document.getElementById("clienteAcoes").value = cliente
	document.getElementById("valorAcoes").value = valor
	acoesRequisicao.show()

}
function baixarRequisicao(id, statusCliente, tipo, cliente, valor) {

	const baixarRequisicao = new bootstrap.Modal(document.getElementById("baixarRequisicaoModal"))
	document.getElementById("id_requisicaoBaixar").value = id
	document.getElementById("statusClienteBaixar").value = statusCliente
	document.getElementById("tipoBaixar").value = tipo
	document.getElementById("clienteBaixar").value = cliente
	document.getElementById("valorBaixar").value = valor
	baixarRequisicao.show()

}
function cancelarRequisicao(id, statusCliente, tipo, cliente, valor) {

	const cancelarRequisicao = new bootstrap.Modal(document.getElementById("cancelarRequisicaoModal"))
	document.getElementById("id_requisicaoCancelar").value = id
	document.getElementById("statusClienteCancelar").value = statusCliente
	document.getElementById("tipoCancelar").value = tipo
	document.getElementById("clienteCancelar").value = cliente
	document.getElementById("valorCancelar").value = valor
	cancelarRequisicao.show()

}
function pfinRequisicao(id, statusCliente, tipo, cliente, valor) {

	const pfinRequisicao = new bootstrap.Modal(document.getElementById("pfinRequisicaoModal"))
	document.getElementById("id_requisicaoPfin").value = id
	document.getElementById("statusClientePfin").value = statusCliente
	document.getElementById("tipoPfin").value = tipo
	document.getElementById("clientePfin").value = cliente
	document.getElementById("valorPfin").value = valor
	pfinRequisicao.show()

}
function pagarRequisicao(id, statusCliente, tipo, cliente, valor) {

	const pagouRequisicao = new bootstrap.Modal(document.getElementById("pagouRequisicaoModal"))
	document.getElementById("id_requisicaoPagar").value = id
	document.getElementById("statusClientePagar").value = statusCliente
	document.getElementById("tipoPagar").value = tipo
	document.getElementById("clientePagar").value = cliente
	document.getElementById("valorPagar").value = valor
	pagouRequisicao.show()

}
function incluirAnexo(id) {

	const incluirAnexo = new bootstrap.Modal(document.getElementById("incluirAnexoModal"))
	document.getElementById("id_anexo").value = id
	incluirAnexo.show()

}
function cancelarCheque(id_cheque) {

	console.log(id_cheque)

	const cancelarCheque = new bootstrap.Modal(document.getElementById("cancelarChequeModal"))
	document.getElementById("id_cheque_cancelar").value = id_cheque
	cancelarCheque.show()

}
function incluirCheque(id_cheque) {

	console.log(id_cheque)
	const incluirCheque = new bootstrap.Modal(document.getElementById("incluirChequeModal"))
	incluirCheque.show()

}
async function editarCaixa(id) {

	const dados = await fetch(`controller/caixaDiario.php?action=editarModal&id=const {id}`)
	const response = await dados.json()
	const editForm = new bootstrap.Modal(document.getElementById("editarInformacoesModal"))
	editForm.show()
	/*EXEMPLO DE COMO CONVERTER DATA EM DIA DA SEMANA
	const data = new Date(response['dados'].data_caixa)
	const diaDaSemana = data.getDay()
	var semana = ["Domingo", "Segunda-Feira", "Ter�a-Feira", "Quarta-Feira", "Quinta-Feira", "Sexta-Feira", "S�bado"];*
	document.getElementById("data_caixa_dia_semana").value = semana[diaDaSemana+1]*/

	document.getElementById("edit_form").value = response['dados'].id_requisicao
	document.getElementById("dep_dinheiro").value = response['dados'].dep_dinheiro
	document.getElementById("dep_cheque").value = response['dados'].dep_cheque
	document.getElementById("dep_brinks").value = response['dados'].dep_brinks

	document.getElementById("data_caixa").value = response['dados'].data_caixa
	document.getElementById("turnos_definitivo").value = response['dados'].turnos_definitivo
	document.getElementById("obs").value = response['dados'].obs
	document.getElementById("conc").value = response['dados'].conc
	document.getElementById("caixa").value = response['dados'].caixa

}
function soNumeros(evento) {
	var theEvent = evento || window.event;
	var key = theEvent.keyCode || theEvent.which;
	key = String.fromCharCode(key);
	//var regex = /^[0-9.,]+const /;
	var regex = /^[0-9,]+const /;
	if (!regex.test(key)) {
		theEvent.returnValue = false;
		if (theEvent.preventDefault) theEvent.preventDefault();
	}
}


$(window).on('load', function () {
	$('#preloader .inner').fadeOut();
	$('#preloader').delay(10).fadeOut('slow');
	$('body').delay(10).css({ 'overflow': 'visible' });
})
async function verRequisicaoMaterial(id) {

	const tabelaRM = document.querySelector(".tabelaRM")
	const requisicaoMaterial = new bootstrap.Modal(document.getElementById("requisicaoMaterial"))

	const dados = await fetch(`https://www.rdppetroleo.com.br/medwebnovo/controller/enviarMateriais.php?action=visualizarRequisicao&id=${id}`)
	const response = await dados.text()
	console.log(response)
	tabelaRM.innerHTML = response
	requisicaoMaterial.show()


}
async function teste(iditem, qtde) {

	if (!isNaN(qtde) && qtde != '') {
		const id_pedido_alterar = document.getElementById('id_pedido_alterar').value

		const dados = await fetch(`https://www.rdppetroleo.com.br/medwebnovo/controller/enviarMateriais.php?action=atualizarQuantidades&iditem=${iditem}&qtde=${qtde}&id_pedido=${id_pedido_alterar}`)
		/*	const response = await dados.json()
			console.log(response)
			console.log(dados)*/
		verRequisicaoMaterial(id_pedido_alterar)
	} else {
		alert('Insira uma quantidade Valida')
	}
}
