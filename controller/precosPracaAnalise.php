<?php
session_start();
include './controllerAux/validaLogin.php';
include './controllerAux/functionsAuxiliar.php';
include '../model/PrecosPracaAnalise.php';

$precosPracaAnalise = new PrecosPracaAnalise();

$action = $_REQUEST['action'];

if ($action == 'findAll') {

$med = $_REQUEST['idMed'];
$bandeira = $_REQUEST['bandeira'];

if($med <> "0"){ $filtroMed = "AND id_filial = $med "; }
if($bandeira <> "0"){ $filtroBandeira = "AND c.bandeira = '$bandeira'"; }

    $paginaAtual = ($_REQUEST['paginaAtual'] ? $_REQUEST['paginaAtual'] : '1');
    $resultadoPorPagina = 12;
    $start = ($paginaAtual * $resultadoPorPagina + 1) - $resultadoPorPagina;
  
    $rows = $precosPracaAnalise->findAll($filtroBandeira, $filtroMed, $start, $resultadoPorPagina);
  
    $data = array('rows' => utf8ize($rows[1]), 'results' => utf8ize($rows[0]));
  
    echo json_encode($data);
  
}
if($action == 'findAllMeds') {

    $rows = $precosPracaAnalise->findAllMeds();
  
    $data = array('rows' => utf8ize($rows));
  
    echo json_encode($data);
}
