async function visualizarCaixaDiario(id){

	const tabelaCxDiarioAnexos = document.querySelector(".tabelaCxDiarioAnexos")
	const tabelaCxDiarioEventos = document.querySelector(".tabelaCxDiarioEventos")
    const visualizarCaixaDiario = new bootstrap.Modal(document.getElementById("visualizarCaixaDiario"))
	const formData = new FormData();
	formData.append("id", id)
	const dados = await fetch('https://www.rdppetroleo.com.br/medwebnovo/controller/caixaDiario.php?action=visualizarCaixaDiario', {
	  method: "POST", 
	  body: formData
	}); 

	const response = await dados.json()
	const tabelaAnexos = response['tabelaAnexos'].toString()
	const tabelaEventos = response['tabelaEventos'].toString()

	visualizarCaixaDiario.show()

	tabelaCxDiarioAnexos.innerHTML = tabelaAnexos
	tabelaCxDiarioEventos.innerHTML = tabelaEventos

	document.getElementById("idRequisicaoVisualizar").value = id
	document.getElementById("depDinheiroVisualizar").value = response['dados'].dep_dinheiro
	document.getElementById("depChequeVisualizar").value = response['dados'].dep_cheque
	document.getElementById("depBrinksVisualizar").value = response['dados'].dep_brinks
	document.getElementById("dataCaixaVisualizar").value = response['dados'].data_caixa
	document.getElementById("turnosDefinitivoVisualizar").value = response['dados'].turnos_definitivo
	document.getElementById("obsVisualizar").value = response['dados'].obs
	document.getElementById("concVisualizar").value = response['dados'].conc
	document.getElementById("caixaVisualizar").value = response['dados'].caixa

} 






