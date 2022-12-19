<?php
$action = $_REQUEST['action'];

	$contaDeposito = trim($_REQUEST['contaDeposito']); 
    $med = $_REQUEST['med']; 
    $dataIni = $_REQUEST['dataIni'];
	$dataFim = $_REQUEST['dataFim'];

	if ($contaDeposito == '') {$contaDeposito = 'CONTA'; }
	if ($contaDeposito <> 'CONTA' ) { $filtroContaDep = "AND conta LIKE '%".$contaDeposito."%'";}
	if ($contaDeposito == 'BB MEDS' ) { $filtroContaDep = " AND conta LIKE 'BB' AND loginName NOT IN ( 'MED03','MED10','MED13','MED16','MED18','MED20','MED23','MED27')";}
	if ($contaDeposito == 'BB PROPRIO' ) { $filtroContaDep = " AND conta LIKE 'BB' AND loginName IN ( 'MED03','MED10','MED13','MED16','MED18','MED20','MED23','MED27')";}
	if ($med == '') {$med = 0; }
	if ($med <> '') { $filtroMed = "AND u.id = $med";}
	if ($dataIni == '') { $dataIni = date('Y-m-d'); }
	if ($dataFim == '') { $dataFim = date('Y-m-d'); }

		$sql = selectMedCaixaDiarioByMed($filtroMed, $filtroContaDep, $dataIni, $dataFim);

	if ($med == -1){

		$sql = selectMedCaixaDiarioByPeriodo();
		
	}
		$qry = odbc_exec( $connP, $sql) or die('Erro.:'.$sql);

	$valorIncrementado = 0;

while ($row = odbc_fetch_array($qry)) { 

	//atribui um id a todos os modais gerados no loop
	$modalAlterar = "modalAlterar$valorIncrementado";
	$modalObservacao = "modalObservacao$valorIncrementado";
	//gatilho para ativação do modal
	$linkModalAlterar = "data-bs-toggle='modal' data-bs-target='#$modalAlterar' style='cursor:pointer'";
	$linkModalObservacao = "data-bs-toggle='modal' data-bs-target='#$modalObservacao' style='cursor:pointer'";

	//	if ($nivel == 5 or $id_u == 75){ 

	//	}

		$totalDia = $row['dinheiro'] + $row['cheque'] ;

		if ($med == -1){	
			$txtTab =  $txtTab.
			'<tr >
						<th></th>
						<th><center>'.$row['dias'].'</th>
						<th><center>'.$row['loginName'].'</th>
						<td>'.v2($row['dinheiro']).'</th>
						<td>'.v2($row['cheque']).'</th>
						<td>'.v2($totalDia).'</th>
						<td><center></th>
						<td><center>'.v2($row['debito']).'</th>
						<th><center></th>
					</tr>';
		} else{	
			$txtTab =  $txtTab.
			'<tr>
				<td '.$linkModalAlterar.'>'.dma($row['DATA']).'</td>
				<td '.$linkModalAlterar.'>'.$vetorDiaSem[w($row['DATA'])].'</td>
				<td '.$linkModalAlterar.'><center>'.$row['loginName'].'</td>
				<td '.$linkModalAlterar.'>'.v2($row['dinheiro']).'</td>
				<td '.$linkModalAlterar.'>'.$row['conta'].'</td>
				<td '.$linkModalAlterar.'>'.v2($row['cheque']).'</td>
				<td '.$linkModalAlterar.'><center>'.$row['contaCh'].'</td>
				<td '.$linkModalAlterar.'>'.v2($row['ttdep']).'</td>
				<td '.$linkModalAlterar.'>'.v2($row['debito']).'</td>
				<td '.$linkModalAlterar.'><center>'.date('d/m/Y H:i',strtotime($row['datahoraReg'])).'</td>
				<td><center><i class="fa-solid fa-pencil" '.$linkModalObservacao.'></i></td>
			</tr>';
		} 

		$totalDinheiro += $row['dinheiro'];
		$totalCheque += $row['cheque'];
		$totalDebito += $row['debito'];
		$totalGeral += $row['ttdep'];

		include 'view/modal/caixaDiarioVisualizarModal.view.php';   

	$valorIncrementado++; 
	} 
	$txtTab =  $txtTab.'
				</tbody>
				<tfoot>
				<tr class="w3-yellow">
						<td colspan="3">Totais</ttdh>
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

if($action == 'alterar-cx-diario'){

	$hoje = date('Y-m-d H:i');
	$id_reg = $_REQUEST['id_reg'];
	$dinheiro = str_replace(',', ".", $_REQUEST['dinheiro']);
	$cheque = str_replace(',', ".", $_REQUEST['cheque']);
	$debito = str_replace(',', ".", $_REQUEST['debito']);
	$data = $_REQUEST['data'];
	$conta = $_REQUEST['conta'];
	$contaCh = $_REQUEST['contaCh'];

	$row = selectMedCaixaDiarioById($id_reg);

	$dinheiroAnt = $row['dinheiro'];
	$chequeAnt = $row['cheque'];
	$debitoAnt = $row['debito'];
	$contaAnt = $row['conta_dep'];
	$contaAntCh = $row['conta_depCh'];
	$dataAnt = 	$row['data'];
	$txtConta = '';

	if (v2($chequeAnt) <> v2($cheque)) 		{ $txtConta = $txtConta."<br>CHEQUE ERA ".v2($chequeAnt)." PASSOU PARA ".v2($cheque);}
	if (v2($debitoAnt) <> v2($debito)) 		{ $txtConta = $txtConta."<br>DEBITO ERA ".v2($debitoAnt)." PASSOU PARA ".v2($debito);}
	if (v2($dinheiroAnt) <> v2($dinheiro)) 	{ $txtConta = $txtConta."<br>DINHEIRO ERA ".v2($dinheiroAnt)." PASSOU PARA ".v2($dinheiro);}
	if ($contaAnt <> $conta) 				{ $txtConta = $txtConta.'<br>CONTA DINHEIRO ERA '.$contaAnt.' PASSOU PARA '.$conta;}
	if ($contaAntCh <> $contaCh) 			{ $txtConta = $txtConta.'<br>CONTA CHEQUE ERA '.$contaAntCh.' PASSOU PARA '.$contaCh;}
	if ($dataAnt <> $data) 					{ $txtConta = $txtConta.'<br>DATA DO MOVIMENTO ERA '.$dataAnt.' PASSOU PARA '.$data;}
	if ($dinheiro == '') {$dinheiro = 0;}
	if ($cheque == '') {$cheque = 0;}
	if ($debito == '') {$debito = 0;}

	updateMedCaixaById($dinheiro, $cheque, $debito, $conta, $data, $contaCh, $id_reg);

	insertObservacaoCaixaDiarioObservacao2($id_reg, $id_u, $dataYmd, $txtConta);

}
if ($action == 'observacao-cx-diario'){
	
	$textoObs = limpaObservacao($_REQUEST['textoObs']);
	$id_reg = $_REQUEST['id_reg'];

	insertObservacaoCaixaDiarioObservacao1($id_reg, $id_u, $textoObs);
	
}