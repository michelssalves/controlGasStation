<?php
$action = $_REQUEST['action'];

$hoje = date('Y-m-d');
$amanha = date('Y-m-d', strtotime($hoje . ' +1 day'));

$data1 = $_REQUEST['data1'];
$data2 = $_REQUEST['data2'];
$tipoData = $_REQUEST['tipoData'];
$med = $_REQUEST['med'];
$cliente = $_REQUEST['cliente'];
$id = $_REQUEST['p2'];
$banco = $_REQUEST['banco'];

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

$FtipoData = " AND $tipoData BETWEEN $data1 AND $data2 ";

$sql = "SELECT ch.id, bco, nome, nrcheque, valor, motivo, dtCheque, dtDevol, ch.dthrInclusao, ch.cpfcnpj, u.loginName, status, ultimaAlteracao, dtQuitacao
		,NOW() as hoje,hoje - dtDevol AS dias, valor, valor + (valor * 0.001 * dias) AS valorCorr, valorQuitacao 
        FROM ccp_chequeDev AS ch 
	    LEFT JOIN ti_clientes AS u ON ch.id_med = u.id AND inativo = 0 
		WHERE ch.id > 0  $FtipoData $FBanco $Fid $Fcliente $Fbanco $Fmed ORDER BY ch.id";
$qry = odbc_exec($connP, $sql);

var_dump($sql);

while ($row = odbc_fetch_array($qry)) {

    //o extract faz com que nao precise escrever o row['alguma coisa'] posso colocar a varivel direto
    extract($row);

    $txtTab .= "<tr class='w3-hover-red'>
                    <td>$id</td>
                    <td>";
    $txtTab .= dma($dthrInclusao);
    $txtTab .= "    </td>
                    <td>$bco</td>
                    <td>";
    $txtTab .= l10($nome);
    $txtTab .= "    </td>
                    <td>$nrcheque</td>
                    <td>$motivo</td>
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
                    <td>";
    $txtTab .= v2($valorCorrigido);
    $txtTab .= "    </td>
                    <td>c</td>
                    <td>$loginName </td>
                    <td>";
    $txtTab .= l5($status);
    $txtTab .= "    </td>
                    <td>x</td>
                    </tr>";


}

