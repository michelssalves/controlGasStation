<?php
session_start();
$id = $_SESSION['id_u'];

require_once '../model/PrecosPracaAnalise.php';

$precosPracaAnalise = new PrecosPracaAnalise();

$usuario = $precosPracaAnalise->selectUserById($id);
//var_dump($usuario);
if ($usuario['nomeCompleto']) {

    $action = $_REQUEST['action'];

    if ($action == 'findAll') {

        $med = $_REQUEST['idMed'];
        $bandeira = $_REQUEST['bandeira'];

        if ($med <> "0") {
            $filtroMed = "AND id_filial = $med ";
        }
        if ($bandeira <> "0") {
            $filtroBandeira = "AND c.bandeira = '$bandeira'";
        }

        $paginaAtual = ($_REQUEST['paginaAtual'] ? $_REQUEST['paginaAtual'] : '1');
        $resultadoPorPagina = 12;
        $start = ($paginaAtual * $resultadoPorPagina + 1) - $resultadoPorPagina;

        $rows = $precosPracaAnalise->findAll($filtroBandeira, $filtroMed, $start, $resultadoPorPagina);

        $data = array('rows' => $precosPracaAnalise->converterUtf8($rows[1]), 'results' => $precosPracaAnalise->converterUtf8($rows[0]));

        echo json_encode($data);
    }
    if ($action == 'findAllMeds') {

        $rows = $precosPracaAnalise->findAllMeds();

        $data = array('rows' => $precosPracaAnalise->converterUtf8($rows));

        echo json_encode($data);
    }
}else{

    header("https://www.rdppetroleo.com.br/medwebnovo/?p=10");
    
  }