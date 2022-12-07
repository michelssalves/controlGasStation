<?php
$id_cheque = $_REQUEST['id_cheque'];

$sql = "SELECT ch.id, bco, nome, nrcheque, valor, motivo, dtCheque, dtDevol, ch.dthrInclusao, ch.cpfcnpj, u.loginName AS filial, status, nomeCliente, telefone, ultimaAlteracao, 
		* FROM ccp_chequeDev AS ch 
		LEFT JOIN rh_usuario AS u ON ch.id_med = u.id
		WHERE ch.id = $id_cheque ";
     
	$qry = odbc_exec($connP, $sql);
	$row = odbc_fetch_array($qry);
	extract($row);

    //var_dump($row);