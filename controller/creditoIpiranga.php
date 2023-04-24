<?php
session_start();
$id = $_SESSION['id_u'];

require_once '../model/CreditoIpiranga.php';

$creditoIpiranga = new CreditoIpiranga();

$usuario = $creditoIpiranga->selectUserById($id);
//var_dump($usuario);
if ($usuario['nomeCompleto']) {

   $action = $_REQUEST['action'];

   if ($action == 'findAllMeds') {

    $rows = $creditoIpiranga->findAllMeds();

    $data = array('rows' => $creditoIpiranga->converterUtf8($rows));

    echo json_encode($data);
}
if ($action == 'findPeriodo') {

    $rows = $creditoIpiranga->findPeriodo();

    $data = array('rows' => $creditoIpiranga->converterUtf8($rows));

    echo json_encode($data);
}
if ($action == 'findAll') {

    $idMed = $_REQUEST['idMed'];
    $p1 = $_REQUEST['P1'];
    $p2 = $_REQUEST['P2'];
    $p3 = $_REQUEST['P3'];
    $p4 = $_REQUEST['P4'];
    $p5 = $_REQUEST['P5'];
    $p6 = $_REQUEST['P6'];
    $bandeira = $_REQUEST['bandeira'];
    $periodo = (intval($_REQUEST['periodo']) ? $_REQUEST['periodo'] : date('Y-m'));
    $ano = date('Y', strtotime($periodo));
    $mes = date('m', strtotime($periodo));
    $dia = "1";

    $filtroProduto = "AND IdProduto IN ('$p1','$p2','$p3','$p4','$p5','$p6')";
    if ($idMed <> ''){$filtroFilial = "AND idFilial IN ($idMed)";} 	 
    //$fFilial2 = " AND id_xpert IN ($idMed)"; 
    if ($bandeira  <> ''){$filtroBandeira  = "AND bandeira = '$bandeira'"; }
    if ($periodo <> ''){$filtroPeriodo = "AND month(c.DataComprovante) = $mes AND year(c.DataComprovante) = $ano"; 
		} else { 
        $filtroPeriodo = "AND c.DataComprovante >= '2016-08-31' "; 
	} 

    $rows = $creditoIpiranga->findAll($filtroFilial, $filtroProduto, $filtroBandeira, $filtroPeriodo);

    $data = array('rows' => $creditoIpiranga->converterUtf8($rows));

    echo json_encode($data);
}
}else{

    header("https://www.rdppetroleo.com.br/medwebnovo/?p=12");
    
  }
