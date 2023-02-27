$(function(){

	$('.hidden').hide();
	
	$('select[name=produtos]').html($('div.produtos-f1').html());
	  
  
	  $('select[name=fabricante]').change(function(){ 
  
		  var id = $('select[name=fabricante]').val();
  
		  $('select[name=produtos]').empty();
		  
		  $('select[name=produtos]').html($('div.produtos-f' + id).html());
  
	  });
	  
  });
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
	tabelaRM.innerHTML = response
	requisicaoMaterial.show()


}
async function alterarQuantideMateriais(iditem, qtde) {

	if (!isNaN(qtde) && qtde != '') {

		const idPedidoVisualizar = document.getElementById('idPedidoVisualizar').value

		const dados = await fetch(`https://www.rdppetroleo.com.br/medwebnovo/controller/enviarMateriais.php?action=atualizarQuantidades&iditem=${iditem}&qtde=${qtde}&id_pedido=${idPedidoVisualizar}`)
		/*const response = await dados.json()
		  console.log(response)
		  console.log(dados)*/
		verRequisicaoMaterial(idPedidoVisualizar)
	} else {
		alert('Insira uma quantidade Valida')
	}
}
 function incluirItemNoPedido(){

	const idPedidoIncluirItem = document.getElementById("idPedidoVisualizar").value 
	const incluirItem= new bootstrap.Modal(document.getElementById("incluirItem"))
	incluirItem.show()
	document.getElementById("idPedidoIncluirItem").value = idPedidoIncluirItem
}
async function salvarProdutoNoPedido(){

	const idPedidoIncluirItem = document.getElementById("idPedidoIncluirItem").value 
	const qtde = document.getElementById("qtdeIncluirItem").value 
	const produtos = document.getElementById("produtosIncluirItem")
	const produto = produtos.options[produtos.selectedIndex].text;
	const idProduto = produtos.options[produtos.selectedIndex].value;
	fetch(`https://www.rdppetroleo.com.br/medwebnovo/controller/enviarMateriais.php?action=novoProdutoNoPedido&idProduto=${idProduto}&produto=${produto}&qtde=${qtde}&idPedido=${idPedidoIncluirItem}`)

	verRequisicaoMaterial(idPedidoIncluirItem)
}
async function excluirOuAlterar(id){

	const idPedidoVisualizar = document.getElementById('idPedidoVisualizar').value
	const excluirOuAlterarItem= new bootstrap.Modal(document.getElementById("excluirOuAlterarItem"))
	const dados = await fetch(`https://www.rdppetroleo.com.br/medwebnovo/controller/enviarMateriais.php?action=verItemDoPedido&idItem=${id}`)
	const response = await dados.json()
	excluirOuAlterarItem.show()
	console.log(response)
	document.getElementById("idPedidoAltExc").value = idPedidoVisualizar
	document.getElementById("idPedidoItemAltExc").value = id
	document.getElementById("fabricanteAltExcItem").value = response['dados'].classe
	document.getElementById("produtosAltExcItem").value = response['dados'].produto
	document.getElementById("qtdeAltExcItem").value = response['dados'].quant
	document.getElementById("qtdeOriginalAltExcItem").value = response['dados'].quant
	document.getElementById("idProdutoAltExcItem").value = response['dados'].idProduto
	
}
function excluirItemDoPedido(){

	const idPedidoAltExc = document.getElementById('idPedidoAltExc').value
	const idPedidoItemAltExc = document.getElementById('idPedidoItemAltExc').value
	
	fetch(`https://www.rdppetroleo.com.br/medwebnovo/controller/enviarMateriais.php?action=excluirProdutoNoPedido&idItem=${idPedidoItemAltExc}`)

	verRequisicaoMaterial(idPedidoAltExc)

}
function alterarItemDoPedido(){

	const idPedidoAltExc = document.getElementById('idPedidoAltExc').value
	const idPedidoItemAltExc = document.getElementById('idPedidoItemAltExc').value
	
	fetch(`https://www.rdppetroleo.com.br/medwebnovo/controller/enviarMateriais.php?action=excluirProdutoNoPedido&idItem=${idPedidoAltExc}`)

	verRequisicaoMaterial(idPedidoItemAltExc)

}
function confirmarEnvioItemDoPedido(){

	const idPedidoAltExc = document.getElementById('idPedidoAltExc').value
	const idPedidoItemAltExc = document.getElementById('idPedidoItemAltExc').value
	const qtdeOriginalAltExcItem = document.getElementById('qtdeOriginalAltExcItem').value
	const qtdeAltExcItem = document.getElementById('qtdeAltExcItem').value
	const idProdutoAltExcItem = document.getElementById('idProdutoAltExcItem').value
	const produtosAltExcItem = document.getElementById('produtosAltExcItem').value

	fetch(`https://www.rdppetroleo.com.br/medwebnovo/controller/enviarMateriais.php?action=confirmarEnvio&idItem=${idPedidoItemAltExc}
	&idPedido=${idPedidoAltExc}&qtdeOriginal=${qtdeOriginalAltExcItem}&qtde=${qtdeAltExcItem}&idProduto=${idProdutoAltExcItem}&descProduto=${produtosAltExcItem}`)

	verRequisicaoMaterial(idPedidoAltExc)

}
function voltarVisualizarPedido(id){

	verRequisicaoMaterial(id)
}
async function verEstoque(){

	const tabelaEstoque = document.querySelector(".tabelaEstoque")
	const visualizarEstoque = new bootstrap.Modal(document.getElementById("visualizarEstoque"))
	const dados = await fetch(`https://www.rdppetroleo.com.br/medwebnovo/controller/enviarMateriais.php?action=verEstoque`)
	const response = await dados.text()
	tabelaEstoque.innerHTML = response
	
	visualizarEstoque.show()

}
async function verAlterarProduto(id){

	const altVerProdutoEstoque= new bootstrap.Modal(document.getElementById("altVerProdutoEstoque"))
	const dados = await fetch(`https://www.rdppetroleo.com.br/medwebnovo/controller/enviarMateriais.php?action=verProduto&idProduto=${id}`)
	const response = await dados.json()
	altVerProdutoEstoque.show()
	
	document.getElementById("idProdutoAltProd").value = response['dados'].idProduto
	document.getElementById("produtoAltProd").value = response['dados'].produto
	document.getElementById("unidadeAltProd").value = response['dados'].unidade
	document.getElementById("classeAltProd").value = response['dados'].idClasse
	document.getElementById("statusAltProd").value = response['dados'].status
	document.getElementById("qtdeAtualAltProd").value = response['dados'].qtde_atual
	document.getElementById("qtdeMinAltProd").value = response['dados'].qtde_min
}
function cadastrarProduto(){

	const cadastrarProduto= new bootstrap.Modal(document.getElementById("cadastrarProdutoEstoque"))
	cadastrarProduto.show()

}
async function salvarCadastroProduto(){

	const produtoCad = document.getElementById("produtoCad").value
	const idClasseCad = document.getElementById("idClasseCad").value
	const unidadeCad = document.getElementById("unidadeCad").value
	const statusCad = document.getElementById("statusCad").value
	const qtdeAtualCad = document.getElementById("qtdeAtualCad").value
	const qtdeMinCad = document.getElementById("qtdeMinCad").value

	const dados = await fetch(`https://www.rdppetroleo.com.br/medwebnovo/controller/enviarMateriais.php?
	action=cadastrarProduto&produtoCad=${produtoCad}&idClasseCad=${idClasseCad}&unidadeCad=${unidadeCad}
	&statusCad=${statusCad}&qtdeAtualCad=${qtdeAtualCad}&qtdeMinCad=${qtdeMinCad}`)
	const response = await dados.text()
	console.log(response)

	verEstoque()
}
async function salvarAlteracaoProduto(){

	const idProdutoAltProd = document.getElementById("idProdutoAltProd").value
	const produtoAltProd = document.getElementById("produtoAltProd").value
	const unidadeAltProd = document.getElementById("unidadeAltProd").value
	const classeAltProd = document.getElementById("classeAltProd").value
	const statusAltProd = document.getElementById("statusAltProd").value
	const qtdeAtualAltProd = document.getElementById("qtdeAtualAltProd").value
	const qtdeMinAltProd = document.getElementById("qtdeMinAltProd").value

	const dados = await fetch(`https://www.rdppetroleo.com.br/medwebnovo/controller/enviarMateriais.php?action=alterarProduto&idProdutoAltProd=${idProdutoAltProd}
	&produtoAltProd=${produtoAltProd}&unidadeAltProd=${unidadeAltProd}&classeAltProd=${classeAltProd}&statusAltProd=${statusAltProd}
	&qtdeAtualAltProd=${qtdeAtualAltProd}&qtdeMinAltProd=${qtdeMinAltProd}`)
	const response = await dados.text()
	console.log(response)

	verEstoque()

}
async function visualizarClasses(){
	
	const tabelaClasses = document.querySelector(".tabelaClasses")
	const cadastrarClasseEstoque = new bootstrap.Modal(document.getElementById("cadastrarClasseEstoque"))
	const dados = await fetch(`https://www.rdppetroleo.com.br/medwebnovo/controller/enviarMateriais.php?action=verClasses`)
	const response = await dados.text()
	tabelaClasses.innerHTML = response
	cadastrarClasseEstoque.show()

}
async function cadastrarClasse(classe){
	if(classe.length > 5){
	
		await fetch(`https://www.rdppetroleo.com.br/medwebnovo/controller/enviarMateriais.php?action=incluirClasse&classe=${classe}`)
		visualizarClasses()
	
	}else{

		alert('Precisa conter ao menos 5 caracteres')
		visualizarClasses()
	}	
}
async function AltExcClasse(id){
	
    const AltExcClasse = new bootstrap.Modal(document.getElementById("AltExcClasse"))
	const dados = await fetch(`https://www.rdppetroleo.com.br/medwebnovo/controller/enviarMateriais.php?action=buscarClasse&idClasse=${id}`)
	const response = await dados.json()
	AltExcClasse.show()

	document.getElementById("idClasseAltExc").value = id
	document.getElementById("classeAltExc").value = response['dados']

}
async function alterarClasse(){

	const idClasse = document.getElementById("idClasseAltExc").value 
	const classe = document.getElementById("classeAltExc").value 
	await fetch(`https://www.rdppetroleo.com.br/medwebnovo/controller/enviarMateriais.php?action=alterarClasse&idClasse=${idClasse}&classe=${classe}`)
	visualizarClasses()
}
async function excluirClasse(){

	const idClasse = document.getElementById("idClasseAltExc").value 
	await fetch(`https://www.rdppetroleo.com.br/medwebnovo/controller/enviarMateriais.php?action=excluirClasse&idClasse=${idClasse}`)
	visualizarClasses()
}
function fecharModal(idCheque){

	visualizarCheque(idCheque)
}
async function visualizarCheque(id){
	
	const tabelaClasses = document.querySelector(".tabelaCheques")
	const visualizarChequeModal = new bootstrap.Modal(document.getElementById("visualizarChequeModal"))
	const dados = await fetch(`https://www.rdppetroleo.com.br/medwebnovo/controller/chequesDevolvidos.php?action=visualizarCheque&id=${id}`)
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
function gravarObservacao() {

	const idCheque = document.getElementById("idChequeObs").value
	const observacao = document.getElementById("observacao").value
	const enviarEmail = document.getElementById("enviarEmail").checked
	const actionObs = document.getElementById("actionObs").value
	fetch(`https://www.rdppetroleo.com.br/medwebnovo/controller/chequesDevolvidos.php?
	action=${actionObs}&id=${idCheque}&obs=${observacao}&email=${enviarEmail}`)
	
	visualizarCheque(idCheque)

}
function cancelarCheque(){

	const idCheque = document.getElementById("idCheque").value
	const cancelarCheque = new bootstrap.Modal(document.getElementById("cancelarChequeModal"))
	cancelarCheque.show()
	document.getElementById("idChequeCancelar").value = idCheque

}
function salvarCancelamento(){

	const idCheque = document.getElementById("idChequeCancelar").value
	const motivo = document.getElementById("motivoCancelamento").value
	const actionCancelar = document.getElementById("actionCancelar").value

	fetch(`https://www.rdppetroleo.com.br/medwebnovo/controller/chequesDevolvidos.php?
	action=${actionCancelar}&id=${idCheque}&motivo=${motivo}`)

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
	let formData = new FormData(); 
	formData.append("file", arquivoAnexo); 
	formData.append("id", idCheque)
	formData.append("descricao", descricao) 

	const dados = await fetch('https://www.rdppetroleo.com.br/medwebnovo/controller/chequesDevolvidos.php?action='+action, {method: "POST", body: formData});
	const response = dados.text()
	console.log(response)
	console.log(dados)
/*
/*
	const formData = new FormData();
	formData.append("file", fileupload.files[0])
	formData.append("id", idCheque)
	formData.append("descricao", descricao)

	await fetch('https://www.rdppetroleo.com.br/medwebnovo/controller/teste.php?action='+action, {
	  method: "POST", 
	  body: formData
	}); 
	*/
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
	let formData = new FormData(); 

	formData.append("file", arquivoQuitacao)
	formData.append("id", idCheque) 

	await fetch('https://www.rdppetroleo.com.br/medwebnovo/controller/chequesDevolvidos.php?action='+action, {
		method: "POST", 
		body: formData
	});

	/*const formData = new FormData();
	formData.append("file", fileupload.files[0])
	formData.append("id", idCheque)


	await fetch('https://www.rdppetroleo.com.br/medwebnovo/controller/chequesDevolvidos.php?action='+action, {
		method: "POST", 
		body: formData
	}); */

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

	let formData = new FormData();
	formData.append("id", idCheque)
	formData.append("motivo", motivo)
	await fetch('https://www.rdppetroleo.com.br/medwebnovo/controller/chequesDevolvidos.php?action='+action, {
	  method: "POST", 
	  body: formData
	}); 
	
	visualizarCheque(idCheque)	

}
