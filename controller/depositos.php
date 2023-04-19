<?php
session_start();
$id = $_SESSION['id_u'];

require_once '../model/Depositos.php';

$depositos = new Deposito();

$usuario = $depositos->selectUserById($id);
//var_dump($usuario);
if ($usuario['nomeCompleto']) {

$action = $_REQUEST['action'];

if($action == 'findAllMeds') {

    $rows = $depositos->findAllMeds();
  
    $data = array('rows' => $depositos->converterUtf8($rows));
  
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

    $rows = $depositos->findAll($FtipoData, $Fmed, $Fconta, $start, $resultadoPorPagina);

    $data = array('rows' => $depositos->converterUtf8($rows[1]), 'results' => $depositos->converterUtf8($rows[0]));

    echo json_encode($data);
}
if($action == 'findById') {

    $id = $_REQUEST['id'];

    $rows = $depositos->findById($id);

    $rowObs = $depositos->selectObservacoes($id);

    $data = array('rows' => $depositos->converterUtf8($rows),  'rowsObs' => $depositos->converterUtf8($rowObs));

    echo json_encode($data);
}
if($action == 'addDeposito'){

    $dataDeposito = $_REQUEST['dataDeposito'];
    $dinheiro = $_REQUEST['dinheiro'];
    $cheque = $_REQUEST['cheque'];
    $debito = $_REQUEST['debito'];
    $conta = $_REQUEST['conta'];
    $contaCh = $_REQUEST['contaCh'];

    if($dataDeposito && $dinheiro && $conta){

        if($depositos->insertDeposito($idUsuario, $dataDeposito, $dinheiro, $cheque, $debito, $conta, $contaCh)){

        $data = array('res' =>  'success', 'msg' => 'Registrado com sucesso!');

        }
   
    }else {

        $data = array('res' => 'error', 'msg' => 'Houve algum erro!');

    }

    echo json_encode($data);
}
if($action == 'addObservacao') {

    $id = $_REQUEST['id'];
    $observacao = $depositos->limpaObservacao(utf8_decode($_REQUEST['observacao']));

    if($depositos->insertObservacao($id, $idUsuario, $observacao)){

        $data = array('res' =>  'success', 'msg' => 'Registrado com sucesso!');
   
    }else {

        $data = array('res' => 'error', 'msg' => 'Houve algum erro!');

    }

    echo json_encode($data);
}
}else{

    header("https://www.rdppetroleo.com.br/medwebnovo/?p=3");
    
  }