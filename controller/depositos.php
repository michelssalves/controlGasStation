<?php
$action = $_REQUEST['action'];

	$contaDeposito = trim($_REQUEST['contaDeposito']); 
    $id_med = $_REQUEST['id_med']; 
    $dataIni = $_REQUEST['dataIni'];
	$dataFim = $_REQUEST['dataFim'];

	if ($contaDeposito == '') {$contaDeposito = 'CONTA'; }
	if ($contaDeposito <> 'CONTA' ) { $filtroContaDep = "AND conta LIKE '%".$contaDeposito."%'";}
	if ($contaDeposito == 'BB MEDS' ) { $filtroContaDep = " AND conta LIKE 'BB' AND loginName NOT IN ( 'MED03','MED10','MED13','MED16','MED18','MED20','MED23','MED27')";}
	if ($contaDeposito == 'BB PROPRIO' ) { $filtroContaDep = " AND conta LIKE 'BB' AND loginName IN ( 'MED03','MED10','MED13','MED16','MED18','MED20','MED23','MED27')";}
	if ($id_med <> '') { $filtroMed = "AND u.id = $id_med";}
	if ($dataIni == '') { $dataIni = date('Y-m-d'); }
	if ($dataFim == '') { $dataFim = date('Y-m-d'); }

		$sql = selectMedCaixaDiarioByMed($filtroMed, $filtroContaDep, $dataIni, $dataFim);

	if ($id_med == -1){

		$sql = selectMedCaixaDiarioByPeriodo();
		
	}
		$qry = odbc_exec( $connP, $sql) or die('Erro.:'.$sql);

	$valorIncrementado = 0;

while ($row = odbc_fetch_array($qry)) { 

	//atribui um id a todos os modais gerados no loop
	$modalAlterar = "modalAlterar$valorIncrementado";
	//gatilho para ativação do modal
	$linkModalAlterar = "data-bs-toggle='modal' data-bs-target='#$modalAlterar' style='cursor:pointer'";
	
		$totalDia = $row['dinheiro'] + $row['cheque'] ;

		if ($id_med == -1){	
			$txtTab .='<tr '.$linkModalAlterar.'>
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
			$txtTab .='<tr '.$linkModalAlterar.'>
				<td>'.dma($row['DATA']).'</td>
				<td>'.$vetorDiaSem[w($row['DATA'])].'</td>
				<td><center>'.$row['loginName'].'</td>
				<td>'.v2($row['dinheiro']).'</td>
				<td>'.$row['conta'].'</td>
				<td>'.v2($row['cheque']).'</td>
				<td><center>'.$row['contaCh'].'</td>
				<td>'.v2($row['ttdep']).'</td>
				<td>'.v2($row['debito']).'</td>
				<td><center>'.date('d/m/Y H:i',strtotime($row['datahoraReg'])).'</td>
				<td><center></td>
			</tr>';
		} 

		$totalDinheiro += $row['dinheiro'];
		$totalCheque += $row['cheque'];
		$totalDebito += $row['debito'];
		$totalGeral += $row['ttdep'];

		include 'view/modal/depositos/depositosAlterarModal.view.php';   

		$valorIncrementado++; 
	} 
	$txtTab .= '
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

		include 'view/modal/depositos/depositosIncluirObservacaoModal.view.php';   

if($action == 'alterarDeposito'){

	
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
	$textoObs = '';

	if (v2($chequeAnt) <> v2($cheque)) 		{ $textoObs = $textoObs."<br>CHEQUE ERA ".v2($chequeAnt)." PASSOU PARA ".v2($cheque);}
	if (v2($debitoAnt) <> v2($debito)) 		{ $textoObs = $textoObs."<br>DEBITO ERA ".v2($debitoAnt)." PASSOU PARA ".v2($debito);}
	if (v2($dinheiroAnt) <> v2($dinheiro)) 	{ $textoObs = $textoObs."<br>DINHEIRO ERA ".v2($dinheiroAnt)." PASSOU PARA ".v2($dinheiro);}
	if ($contaAnt <> $conta) 				{ $textoObs = $textoObs.'<br>CONTA DINHEIRO ERA '.$contaAnt.' PASSOU PARA '.$conta;}
	if ($contaAntCh <> $contaCh) 			{ $textoObs = $textoObs.'<br>CONTA CHEQUE ERA '.$contaAntCh.' PASSOU PARA '.$contaCh;}
	if ($dataAnt <> $data) 					{ $textoObs = $textoObs.'<br>DATA DO MOVIMENTO ERA '.$dataAnt.' PASSOU PARA '.$data;}
	if ($dinheiro == '') {$dinheiro = 0;}
	if ($cheque == '') {$cheque = 0;}
	if ($debito == '') {$debito = 0;}

	$textoObs = "REGISTRO ALTERADO: $textoObs";

	updateMedCaixaById($dinheiro, $cheque, $debito, $conta, $data, $contaCh, $id_reg);

	insertObservacaoCaixaDiarioObservacao($id_reg, $idUsuario, $textoObs);

}
if ($action == 'observacaoDeposito'){
	
	$textoObs = limpaObservacao($_REQUEST['textoObs']);
	$id_reg = $_REQUEST['id_reg'];

	insertObservacaoCaixaDiarioObservacao($id_reg, $idUsuario, $textoObs);
	
}