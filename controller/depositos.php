<?php
session_start();
include './controllerAux/validaLogin.php';
include './controllerAux/vetoresAuxiliares.php';
include './controllerAux/functionsAuxiliar.php';
include '../model/Depositos.php';

$action = $_REQUEST['action'];

if($action == 'findAllMeds') {


    $model = new Model();
  
    $rows = $model->findAllMeds();
  
    $data = array('rows' => utf8ize($rows));
  
    echo json_encode($data);
}
if($action == 'findAll') {

	$contaDeposito = $_REQUEST['contaDeposito'];
    $idMed = $_REQUEST['idMed'];
    $data1 = ($_REQUEST['data1'] ? $_REQUEST['data1'] : date('Y-m-d'));
    $data2 = ($_REQUEST['data2'] ? $_REQUEST['data2'] : date('Y-m-d') );
    $paginaAtual = $_REQUEST['paginaAtual'];
    $resultadoPorPagina = 11;
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
if($action == 'findById') {

    $id = $_REQUEST['id'];

    $model = new Model();

    $rows = $model->findById($id);

    $rowObs = $model->selectObservacoes($id);

    $data = array('rows' => utf8ize($rows),  'rowsObs' => utf8ize($rowObs));

    echo json_encode($data);
}
if($action == 'addDeposito'){

    $dataDeposito = $_REQUEST['dataDeposito'];
    $dinheiro = $_REQUEST['dinheiro'];
    $cheque = $_REQUEST['cheque'];
    $debito = $_REQUEST['debito'];
    $conta = $_REQUEST['conta'];
    $contaCh = $_REQUEST['contaCh'];
 
    $model = new Model();
  
    if($dataDeposito && $dinheiro && $conta){

        if($model->insertDeposito($idUsuario, $dataDeposito, $dinheiro, $cheque, $debito, $conta, $contaCh)){

        $data = array('res' =>  'success', 'msg' => 'Registrado com sucesso!');

        }
   
    }else {

        $data = array('res' => 'error', 'msg' => 'Houve algum erro!');

    }

    echo json_encode($data);
}
if($action == 'addObservacao') {

    $id = $_REQUEST['id'];
    $observacao = limpaObservacao(utf8_decode($_REQUEST['observacao']));

    $model = new Model();

    if($model->insertObservacao($id, $idUsuario, $observacao)){

        $data = array('res' =>  'success', 'msg' => 'Registrado com sucesso!');
   
    }else {

        $data = array('res' => 'error', 'msg' => 'Houve algum erro!');

    }

    echo json_encode($data);
}