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

	$sql = "SELECT c.id AS id_reg, DATA,u.loginName, c.dinheiro, c.conta_dep AS conta, c.cheque, c.conta_depCh AS contaCh, 
					c.dinheiro + c.cheque AS ttdep, debito, c.datahoraReg 	
					FROM med_caixa AS c 
					LEFT JOIN ti_clientes AS u ON c.id_med = u.id
					WHERE c.id > 0 $filtroMed $filtroContaDep
					AND data BETWEEN '$dataIni' AND '$dataFim' ORDER BY loginName, data";

	if ($med == -1){
		$sql = 	"SELECT loginName, 1 AS cont, sum(cont) AS dias, sum(c.dinheiro) AS dinheiro, sum(c.cheque) AS cheque, sum(debito) AS debito
				FROM med_caixa AS c 
				LEFT JOIN ti_clientes AS u ON c.id_med = u.id 
				WHERE c.id > 0 AND month(data) = 8 AND year(data) = 2015
				GROUP BY u.loginName
				ORDER BY u.loginName";
	
	}
	
	$qry = odbc_exec( $connP, $sql) or die('Erro.:'.$sql);
$valorIncrementado = 0;
while ($row = odbc_fetch_array($qry)) { 

//atribui um id a todos os modais gerados no loop
$modal = "modal$valorIncrementado";
//gatilho para ativação do modal
$link = "data-bs-toggle='modal' data-bs-target='#$modal' style='cursor:pointer'";

//	if ($nivel == 5 or $id_u == 75){ 
//	$link = "PopupCenter('caixaDiarioVisualizar.php?id_reg=".$row['id_reg']."','',800,400)".'"  style="cursor:pointer';
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
		'<tr '.$link.'>
                    <th >'.dma(date('Y-m-d')).'</th>
					<th>'.$vetorDiaSem[w(date('Y-m-d'))].'</th>
					<th><center>'.$row['loginName'].'</th>
					<td>'.v2($row['dinheiro']).'</th>
				    <td>'.$row['conta'].'</th>
					<td>'.v2($row['cheque']).'</th>
				    <th><center>'.$row['contaCh'].'</th>
					<td>'.v2($row['ttdep']).'</th>
					<td>'.v2($row['debito']).'</th>
				    <th><center>'.date('d/m/Y H:i',strtotime($row['datahoraReg'])).'</th>
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
			<tr class="versalete14Amarelo">
				    <th colspan="3">Totais</th>
					<th><center>'.v2($totalDinheiro).'</th>
				    <th colspan="1" >&nbsp;</th>
					<th><center>'.v2($totalCheque).'</th>
				    <th colspan="1" >&nbsp;</th>
					<th><center>'.v2($totalGeral).'</th>
					<th><center>'.v2($totalDebito).'</th>
				    <th colspan="1" >&nbsp;</th>
				  </tr>
			</tfoot>
		    </table>';