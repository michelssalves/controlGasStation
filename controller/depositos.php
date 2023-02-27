<?php
session_start();
include './controllerAux/validaLogin.php';
include './controllerAux/vetoresAuxiliares.php';
include './controllerAux/functionsAuxiliar.php';
include '../model/Depositos.php';

$action = $_REQUEST['action'];


if ($action == 'findAllMeds') {

    $model = new Model();
  
    $rows = $model->findAllMeds();
  
    $data = array('rows' => utf8ize($rows));
  
    echo json_encode($data);
  }
if ($action == 'findAll') {

	$contaDeposito = $_REQUEST['contaDeposito'];
    $idMed = $_REQUEST['idMed'];
    $data1 = ($_REQUEST['data1']);
    $data2 = ($_REQUEST['data2']);
    $paginaAtual = $_REQUEST['paginaAtual'];
    $resultadoPorPagina = 6;
    $start = ($paginaAtual * $resultadoPorPagina + 1) - $resultadoPorPagina;

    if ($idMed <> '0') {

        $Fmed = "AND u.id = $idMed";
    }
	if ($contaDeposito <> 'CONTA') {

        $Fconta = "AND c.conta_depCh = '$contaDeposito'";
    }
	if(!empty($data1) && !empty($data2)){

    	$FtipoData = " AND c.data BETWEEN '$data1' AND '$data2' ";
	}
    $model = new Model();

    $rows = $model->findAll($FtipoData, $Fmed, $Fconta, $start, $resultadoPorPagina);

    $data = array('rows' => utf8ize($rows[1]), 'results' => utf8ize($rows[0]));

    echo json_encode($data);
}


if ($action == 'findById') {

    $id = $_REQUEST['id'];

    $model = new Model();

    $rows = $model->findById($id);

 //   $rowObs = $model->selectObservacaoByIdPedido($id);

  //  $data = array('rows' => utf8ize($rows),  'rowsObs' => utf8ize($rowObs));

    $data = array('rows' => utf8ize($rows));

    echo json_encode($data);
}