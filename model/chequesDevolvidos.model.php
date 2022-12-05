<?php
$action = $_REQUEST['action'];

$data1 = $_REQUEST['data1'];
$data2 = $_REQUEST['data2'];
$tipoData = $_REQUEST['tipoData'];
$med = $_REQUEST['med'];
$cliente = $_REQUEST['cliente'];
$id = $_REQUEST['p2'];
$banco = $_REQUEST['banco'];

$filtroStatus = '';


//COLOCA TODOS OS CHECKBOX DENTRO DO VETOR $s
for ($st=0;$st<=11; $st++){

		$s[$st] = $_REQUEST['s'.$st]; 
 
	}

//SE A OPÇÃO TODOS ESTIVER FLEGADO MARCAR TODAS AS OPÇÕES COMO CHECKED
if ($s[0] == 'checked'){

    for ($st=0; $st<=11; $st++){
        $s[$st] = 'checked';
    }
}
//FILTRA STATUS
if ($s[1] == 'checked') {$filtroStatus = $filtroStatus.",'NOVO'"; }
if ($s[2] == 'checked') {$filtroStatus = $filtroStatus.",'NEGOCIANDO'"; }
if ($s[3] == 'checked') {$filtroStatus = $filtroStatus.",'QUITADO'"; }
if ($s[4] == 'checked') {$filtroStatus = $filtroStatus.",'PFIN'"; }
if ($s[5] == 'checked') {$filtroStatus = $filtroStatus.",'JURIDICO'"; }
if ($s[6] == 'checked') {$filtroStatus = $filtroStatus.",'EXECUCAO'"; }
if ($s[7] == 'checked') {$filtroStatus = $filtroStatus.",'CADUCO'"; }
if ($s[8] == 'checked') {$filtroStatus = $filtroStatus.",'EXTRAVIADO'"; }
if ($s[9] == 'checked') {$filtroStatus = $filtroStatus.",'CANCELADO'"; }
if ($s[10] == 'checked'){$filtroStatus = $filtroStatus.",'SEM SOLUCAO'"; }  

if ($filtroStatus == '' ){
    $filtroStatus = "AND status IN ('NOVO', 'NEGOCIANDO', 'PFIN')";
    $s1 = 'checked';$s2 = 'checked';$s4 = 'checked';}
else{
    $filtroStatus = "and status in (''".$filtroStatus.")";}

if ($id <> '') {
    $Fid = "AND ch.id = $id";
}
if ($cliente <> '') {
    $Fcliente = "AND nome LIKE '%$cliente%' ";
}
if ($banco <> '') {
    $Fbanco = "AND bco = $banco";
}
if ($med <> '') {
    $Fmed = "AND ch.id_med = $med";
}
if ($tipoData  === '0') {
    $tipoData = 'dthrInclusao';
}
if ($tipoData  === '1') {
    $tipoData = 'dtCheque';
}
if ($tipoData  === '2') {
    $tipoData = 'dtDevol';
}
if ($tipoData  === '3') {
    $tipoData = 'dtQuitacao';
}
if ($data1 == '') {

    $data1 = date('Y-m-d');

}
if ($data2  == '') {

    $hoje = date('Y-m-d');
    $amanha = date('Y-m-d', strtotime($hoje . ' +1 day'));
    $data2 = $amanha;
    
}

$FtipoData = " AND $tipoData BETWEEN '".$data1."' AND '".$data2."' ";

$sql = "SELECT ch.id, bco, nome , nrcheque, valor, motivo, dtCheque, dtDevol, ch.dthrInclusao, ch.cpfcnpj, u.loginName, status, ultimaAlteracao, dtQuitacao
		,NOW() as hoje,hoje - dtDevol AS dias, valor, valor + (valor * 0.001 * dias) AS valorCorr, valorQuitacao 
        FROM ccp_chequeDev AS ch 
	    LEFT JOIN ti_clientes AS u ON ch.id_med = u.id AND inativo = 0 
		WHERE ch.id > 0  $FtipoData $FBanco $Fid $Fcliente $Fbanco $Fmed $filtroStatus ORDER BY ch.id";
$qry = odbc_exec($connP, $sql);

//var_dump($sql);
// variaveis declaradas para apresentarem os valores totais e corrigidos ao fim da tabela
$totalValor = 0;
$totalValorCorrigido = 0;

while ($row = odbc_fetch_array($qry)) {

    //o extract faz com que nao precise escrever o row['alguma coisa'] posso colocar a varivel direto
    extract($row);

	$ultimaAlt = '';
	if($ultimaAlteracao <> ''){
        $ultimaAlt = dma($ultimaAlteracao);
    }
	$dtQuita = '';
	if ($dtQuitacao <> ''){
        $dtQuita = dma($dtQuitacao);
    }

	$link = "visualizaCheque.php?id_cheque=$id";

    //esses vetores estão no arquivo de conexao
	$motivoTitle = $vetorMotivo[$motivo];
	$bancoTitle = $vetorBanco[$bco];

	if ($valorQuitacao <> ''){
        $valorCorrigido = $valorQuitacao; 
        $tituloValCorr = 'Valor Recebido';
    }else{
        $valorCorrigido = $valorCorr; 
        $tituloValCorr = 'Taxa de 0,1% por dia de atraso';
    } 
    if ($subclasse == 'OUTRO'){
        $obs = '('.l50($obs).')';
    }else {
        $obs = '';
    } 

    $txtTab .= "<tr class='w3-hover-red'>
                    <td>$id</td>
                    <td>";
    $txtTab .= dma($dthrInclusao);
    $txtTab .= "    </td>
                    <td title='$bancoTitle'>$bco</td>
                    <td>";
    $txtTab .= l10($nome);
    $txtTab .= "    </td>
                    <td>$nrcheque</td>
                    <td title='$motivoTitle'>$motivo</td>
                    <td>";
    $txtTab .= dma($dtCheque);
    $txtTab .= "    </td>
                    <td>";
    $txtTab .= v2($valor);
    $txtTab .= "    </td>
                    <td>";
    $txtTab .= dma($dtDevol);
    $txtTab .= "    </td>
                    <td>$dias</td>
                    <td title=$tituloValCorr>";
    $txtTab .= v2($valorCorrigido);
    $txtTab .= "    </td>
                    <td>$dtQuita</td>
                    <td>$loginName </td>
                    <td>";
    $txtTab .= l5($status);
    $txtTab .= "    </td>
                    <td>$ultimaAlt</td>
                    </tr>";
                    $totalValor += $valor;
                    $totalValorCorrigido += $valorCorr;
  } 
  
  
    $txtTab .="
        </tbody>
              <tr>
                    <td colspan='7'><center>Total</td>
                    <td><center><a>";
    $txtTab .=v2($totalValor);
    $txtTab .="</a></td>
                    <td colspan='2'></td>
                    <td><center><a>";
    $txtTab .= v2($totalValorCorrigido);
    $txtTab .="</a></td>
                    <td colspan='4'></td>
                    </tr>";
  