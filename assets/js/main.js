function esconderSideBar(){

	const nomeClasseBody = document.getElementById('idBody').className;
	const el = document.getElementById('idBody');

	if(nomeClasseBody  == 'app sidebar-mini'){

		el.classList.remove('app', 'sidebar-mini');
		el.classList.add('app', 'sidebar-mini', 'sidenav-toggled');

	}else{
		el.classList.remove('app', 'sidebar-mini', 'sidenav-toggled');
		el.classList.add('app', 'sidebar-mini');
		
	}

}
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
function incluirObservacao(id){

	console.log(id)

    const incluirObs = new bootstrap.Modal(document.getElementById("incluirObservacaoModal"))
	document.getElementById("id_observacao").value = id
//	document.getElementById("med").value = med
    incluirObs.show()
   
}	
function incluirAnexo(id){

	console.log(id)


    const incluirAnexo = new bootstrap.Modal(document.getElementById("incluirAnexoModal"))
	document.getElementById("id_anexo").value = id
    incluirAnexo.show()
   
}		
function cancelarCheque(id_cheque){

	console.log(id_cheque)

    const cancelarCheque = new bootstrap.Modal(document.getElementById("cancelarChequeModal"))
	document.getElementById("id_cheque_cancelar").value = id_cheque
    cancelarCheque.show()
   
}
function incluirCheque(id_cheque){

	console.log(id_cheque)
    const incluirCheque = new bootstrap.Modal(document.getElementById("incluirChequeModal"))
    incluirCheque.show()
   
}
async function editarForm(id){

	const dados = await fetch(`model/caixaDiario.model.php?action=editarModal&id=${id}`)
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
	key = String.fromCharCode( key );
	//var regex = /^[0-9.,]+$/;
	var regex = /^[0-9,]+$/;
	if( !regex.test(key) ) {
	   theEvent.returnValue = false;
	   if(theEvent.preventDefault) theEvent.preventDefault();
	}
 }


