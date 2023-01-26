<?php
session_start();
include './controllerAux/validaLogin.php';
include './controllerAux/vetoresAuxiliares.php';
include './controllerAux/functionsAuxiliar.php';
include '../model/depositos.php';

$action = $_REQUEST['action'];

if($action == 'filtrar-depositos' || $action == 'limpar-filtrar-depositos' || $action == ''){

$contaDeposito = trim($_REQUEST['contaDeposito']);
$id_med = $_REQUEST['id_med'];
$dataIni = $_REQUEST['dataIni'];
$dataFim = $_REQUEST['dataFim'];

if($action == 'limpar-filtrar-depositos'){

	$id_med = '';
	$contaDeposito = '';
	$dataIni = date('Y-m-d');
	$dataFim = date('Y-m-d');
	
}
if ($contaDeposito == '') {
	$contaDeposito = 'CONTA';
}
if ($contaDeposito <> 'CONTA') {
	$filtroContaDep = "AND conta LIKE '%" . $contaDeposito . "%'";
}
if ($contaDeposito == 'BB MEDS') {
	$filtroContaDep = " AND conta LIKE 'BB' AND loginName NOT IN ( 'MED03','MED10','MED13','MED16','MED18','MED20','MED23','MED27')";
}
if ($contaDeposito == 'BB PROPRIO') {
	$filtroContaDep = " AND conta LIKE 'BB' AND loginName IN ( 'MED03','MED10','MED13','MED16','MED18','MED20','MED23','MED27')";
}
if ($id_med <> '') {
	$filtroMed = "AND u.id = $id_med";
}
if ($dataIni == '') {
	$dataIni = date('Y-m-d');
}
if ($dataFim == '') {
	$dataFim = date('Y-m-d');
}

$qry = selectDepositoCxByMed($filtroMed, $filtroContaDep, $dataIni, $dataFim);

while ($row = odbc_fetch_array($qry)) {
	
	extract($row);

	$link = "id='$id_reg' onclick='visualizarDeposito(this.id)' style='cursor:pointer'";

	$totalDia = $row['dinheiro'] + $row['cheque'];

		$txtTab .= "<tr $link>
				<td>$id_reg</td>	
				<td>".dma($row['DATA'])."</td>
				<td>".$vetorDiaSem[w($row['DATA'])]."</td>
				<td><center>$loginName</td>
				<td>".v2($dinheiro)."</td>
				<td>$conta</td>
				<td>".v2($row['cheque'])."</td>
				<td><center>$contaCh</td>
				<td>".v2($row['ttdep'])."</td>
				<td>".v2($row['debito'])."</td>
				<td><center>".dmaH($row['datahoraReg'])."</td>
				<td><center></td>
			</tr>";
	
	$totalDinheiro += $dinheiro;
	$totalCheque += $cheque;
	$totalDebito += $debito;
	$totalGeral += $ttdep;

}
		$txtTab .= '</tbody>
				<tfoot>
					<tr class="w3-yellow">
						<td colspan="3">Totais</td>
						<td colspan="1">'.v2($totalDinheiro).'</td>
						<td colspan="1" >&nbsp;</td>
						<td colspan="1">'.v2($totalCheque).'</td>
						<td colspan="1" >&nbsp;</td>
						<td colspan="1">'.v2($totalGeral).'</td>
						<td colspan="1">'.v2($totalDebito).'</td>
						<td colspan="2" >&nbsp;</td>
					</tr>
				</tfoot>
				</table>';
}
include 'view/modal/depositos/depositosAlterarModal.view.php';
include 'view/modal/depositos/depositosIncluirObservacaoModal.view.php';
if ($action == 'visualizarDeposito') {

	$id = $_REQUEST['id'];

	$qry = selectDepositoCxByIdAjax($id);
	$row = odbc_fetch_array($qry);


	$qry = selectDepositosCxObs($id);

	$txtTable .= "<table class='table table-sm table-bordered border-dark'>
	<thead class='header-tabela'>
		<thead>
			<tr>
				<th>Autor</th>
				<th>Data</th>
				<th>Obs</th>
			</tr>
		</thead>
	<tbody>";

	while($rowObs = odbc_fetch_array($qry)){

		extract($rowObs);

		$txtTable .= "<tr>
			<td>$nomecompleto</td>
			<td>".dmaH($datahora)."</td>
			<td>$texto</td>
		</tr>";
	}

	$txtTable .= "</tbody></table>";
	
	$return = ['dados' => utf8ize($row), 'tabela' => utf8ize($txtTable)];

	echo json_encode($return);

}
if ($action == 'alterarDeposito') {

	$id_reg = $_REQUEST['idDeposito'];
	$dinheiro = str_replace(',', ".", $_REQUEST['dinheiro']);
	$cheque = str_replace(',', ".", $_REQUEST['cheque']);
	$debito = str_replace(',', ".", $_REQUEST['debitos']);
	$data = $_REQUEST['dataMovimento'];
	$conta = $_REQUEST['conta'];
	$contaCh = $_REQUEST['contaCh'];

	$row = selectDepositoCxById($id_reg);

	$dinheiroAnt = $row['dinheiro'];
	$chequeAnt = $row['cheque'];
	$debitoAnt = $row['debito'];
	$contaAnt = $row['conta_dep'];
	$contaAntCh = $row['conta_depCh'];
	$dataAnt = 	$row['data'];
	$textoObs = '';

	if (v2($chequeAnt) <> v2($cheque)) {
		$textoObs = $textoObs . "<br>CHEQUE ERA " . v2($chequeAnt) . " PASSOU PARA " . v2($cheque);
	}
	if (v2($debitoAnt) <> v2($debito)) {
		$textoObs = $textoObs . "<br>DEBITO ERA " . v2($debitoAnt) . " PASSOU PARA " . v2($debito);
	}
	if (v2($dinheiroAnt) <> v2($dinheiro)) {
		$textoObs = $textoObs . "<br>DINHEIRO ERA " . v2($dinheiroAnt) . " PASSOU PARA " . v2($dinheiro);
	}
	if ($contaAnt <> $conta) {
		$textoObs = $textoObs . '<br>CONTA DINHEIRO ERA ' . $contaAnt . ' PASSOU PARA ' . $conta;
	}
	if ($contaAntCh <> $contaCh) {
		$textoObs = $textoObs . '<br>CONTA CHEQUE ERA ' . $contaAntCh . ' PASSOU PARA ' . $contaCh;
	}
	if ($dataAnt <> $data) {
		$textoObs = $textoObs . '<br>DATA DO MOVIMENTO ERA ' . $dataAnt . ' PASSOU PARA ' . $data;
	}
	if ($dinheiro == '') {
		$dinheiro = 0;
	}
	if ($cheque == '') {
		$cheque = 0;
	}
	if ($debito == '') {
		$debito = 0;
	}

	$textoObs = "REGISTRO ALTERADO: $textoObs";

	updateDepositoCxById($dinheiro, $cheque, $debito, $conta, $data, $contaCh, $id_reg);

	insertDepositoCxObs($id_reg, $idUsuario, $textoObs);
}
if ($action == 'observacaoDeposito') {

	$observacao = limpaObservacao($_REQUEST['observacao']);
	$id_reg = $_REQUEST['idDepositoObs'];

	insertDepositoCxObs($id_reg, $idUsuario, $observacao);
}
