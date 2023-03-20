<?php
session_start();
include './controllerAux/validaLogin.php';
include './controllerAux/functionsAuxiliar.php';
include '../model/CadastroClientes.php';

$action = $_REQUEST['action'];

if ($action == 'findAll') {

    $status1 = $_REQUEST['statusNovo'];
    $status2 = $_REQUEST['statusCadastrado'];
    $status3 = $_REQUEST['statusSerasa'];
    $status4 = $_REQUEST['statusCancelado'];

    $data1 = $_REQUEST['data1'];
    $data2 = $_REQUEST['data2'];

    $paginaAtual = ($_REQUEST['paginaAtual'] ? $_REQUEST['paginaAtual'] : '1');
    $resultadoPorPagina = 12;

    $start = ($paginaAtual * $resultadoPorPagina + 1) - $resultadoPorPagina;

    if ($status1 == '' && $status2 == '' && $status3 == '' && $status4 == '' ){
        $FStatus = "AND status IN ('CADASTRADO', 'NOVO', 'CANCELADO', 'CONFERIDO SERASA')";
    } else {
        $FStatus = "AND status IN ('$status1', '$status2', '$status3', '$status4')";
    }

    $FFilial = "AND loginName = '$usuarioLogado'";

    if ($data1 == '') { $data1 = '2015-01-01'; }
    if ($data2 == '') { $data2 = date("Y-m-d"); }
    $FData = "AND c.data_cadastro BETWEEN '$data1' AND '$data2'";
    
    $cadastroCliente = new CadastroCliente();

    $rows = $cadastroCliente->findAll($FStatus, $FFilial, $FData, $start, $resultadoPorPagina);

    $data = array('rows' => utf8ize($rows[1]), 'results' => utf8ize($rows[0]));

    echo json_encode($data);
}