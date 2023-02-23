<?php
session_start();
include './controllerAux/validaLogin.php';
include './controllerAux/functionsAuxiliar.php';
include '../model/EnviarMateriais.php';

$action = $_REQUEST['action'];

if ($action == 'findAllMeds') {

  $model = new Model();

  $rows = $model->selectAllMeds();

  $data = array('rows' => utf8ize($rows));

  echo json_encode($data);
}
if ($action == 'findAll') {

  $status1 = $_REQUEST['statusNovo'];
  $status2 = $_REQUEST['statusEnviado'];
  $status3 = $_REQUEST['statusFinalizado'];
  $status4 = $_REQUEST['statusCancelado'];
  $med = $_REQUEST['idMed'];
  $produto =  $_REQUEST['produto'];
  $paginaAtual = $_REQUEST['paginaAtual'];
  $resultadoPorPagina = 6;
  $start = ($paginaAtual * $resultadoPorPagina + 1) - $resultadoPorPagina;

  if (isset($med) && $med <> '0') {
    $Fmed = "AND p.codcliente = '$med' ";
  }

  if (isset($produto) && $produto <> '') {
    $Fproduto = "AND lista LIKE '%$produto%'";
  }
  if ($status1 == '' && $status2 == '' && $status3 == '' && $status4 == '') {
    $Fstatus =  "AND status = 'NOVO'";
  } else {
    $Fstatus =  "AND status IN ('" . $status1 . "','" . $status2 . "','" . $status3 . "','" . $status4 . "')";
  }

  $model = new Model();

  $rows = $model->findAll($Fstatus, $Fmed, $Fproduto, $start, $resultadoPorPagina);

  $data = array('rows' => utf8ize($rows[1]), 'results' => utf8ize($rows[0]));

  echo json_encode($data);
}
if ($action == 'findById') {

  $id = $_REQUEST['id'];

  $model = new Model();

  $rows = $model->findById($id);

  $rowObs = $model->selectObservacaoByIdPedido($id);

  $data = array('rows' => utf8ize($rows),  'rowsObs' => utf8ize($rowObs));
  
  echo json_encode($data);
}
if ($action == 'findByIdItem') {

  $id = $_REQUEST['id'];

  $model = new Model();

  $rows = $model->findByIdItem($id);

  $data = array('rows' => utf8ize($rows));

  echo json_encode($data);
}
if ($action == 'cancelarPedido') {

  $id = $_REQUEST['idPedido'];

  $model = new Model();

  if($model->cancelarPedido($id)) {

    $data = array('res' => 'success', 'msg' => 'Pedido Cancelado');

  } else {

    $data = array('res' => 'error', 'msg' => 'Erro para cancelar');
  }
  echo json_encode($data);
}
if ($action == 'cancelarItem') {

  $id = $_REQUEST['idItem'];

  $model = new Model();

  if($model->cancelarItem($id)) {

    $data = array('res' => 'success', 'msg' => 'Item Cancelado');
  } else {

    $data = array('res' => 'error', 'msg' => 'Erro para cancelar');
  }
  echo json_encode($data);
}
if ($action == 'alterarItem') {

  $id = $_REQUEST['idItem'];
  $quantidade = $_REQUEST['quantidade'];

  $model = new Model();

  if ($model->alterarQtdeItem($id, $quantidade)) {

    $data = array('res' => 'success', 'msg' => 'Alterado Com Sucesso');

  } else {

    $data = array('res' => 'error', 'msg' => 'Erro para alterar');
    
  }
  echo json_encode($data);
}
if ($action == 'addObservacao') {

  $id = $_REQUEST['idPedido'];
  $observacao = limpaObservacao($_REQUEST['observacao']);
 

  $model = new Model();

  if($model->insertObservacao($id, $usuarioLogado, $observacao)) {

    $data = array('res' => 'success', 'msg' => 'Alterado Com Sucesso');
  } else {

    $data = array('res' => 'error', 'msg' => 'Erro para alterar');
  }
  echo json_encode($data);
}
if ($action == 'alterarStatus') {

  $id = $_REQUEST['idPedido'];
  $status = $_REQUEST['status'];

  if($status == 'NOVO'){ $status = 'ENVIADO';}
  elseif($status == 'ENVIADO'){ $status = 'FINALIZADO';}

  $model = new Model();

  if($model->alterarStatus($id, $status)) {

    $data = array('res' => 'success', 'msg' => 'Alterado Com Sucesso');

  } else {

    $data = array('res' => 'error', 'msg' => 'Erro para alterar');
  }

  echo json_encode($data);
}



