<?php
session_start();
$id = $_SESSION['id_u'];

require_once '../model/EnviarMateriais.php';

$enviarMaterial = new EnviarMaterial();

$usuario = $enviarMaterial->selectUserById($id);
//var_dump($usuario);
if ($usuario['nomeCompleto']) {

$action = $_REQUEST['action'];

if ($action == 'findAllMeds') {

  $rows = $enviarMaterial->findAllMeds();

  $data = array('rows' => $enviarMaterial->converterUtf8($rows));

  echo json_encode($data);
}
if ($action == 'findAllClasses') {

  $rows = $enviarMaterial->selectAllClasses();

  $data = array('rows' => $enviarMaterial->converterUtf8($rows));

  echo json_encode($data);
}
if ($action == 'findProdutos') {

  $classe = $_REQUEST['classe'];

  $rows = $enviarMaterial->selectProdutos($classe);

  $data = array('rows' => $enviarMaterial->converterUtf8($rows));

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

  $rows = $enviarMaterial->findAll($Fstatus, $Fmed, $Fproduto, $start, $resultadoPorPagina);

  $data = array('rows' => $enviarMaterial->converterUtf8($rows[1]), 'results' => $enviarMaterial->converterUtf8($rows[0]));

  echo json_encode($data);
}
if ($action == 'findById') {

  $id = $_REQUEST['id'];

  $rows = $enviarMaterial->findById($id);

  $rowObs = $enviarMaterial->selectObservacao($id);

  $data = array('rows' => $enviarMaterial->converterUtf8($rows),  'rowsObs' => $enviarMaterial->converterUtf8($rowObs));

  echo json_encode($data);
}
if ($action == 'findByIdItem') {

  $id = $_REQUEST['id'];

  $rows = $enviarMaterial->findByIdItem($id);

  $data = array('rows' => $enviarMaterial->converterUtf8($rows));

  echo json_encode($data);
}
if ($action == 'cancelarPedido') {

  $id = $_REQUEST['idPedido'];

  if ($enviarMaterial->updateCancelarPedido($id)) {

    $data = array('res' => 'success', 'msg' => 'Pedido Cancelado');
  } else {

    $data = array('res' => 'error', 'msg' => 'Erro para cancelar');
  }
  echo json_encode($data);
}
if ($action == 'cancelarItem') {

  $id = $_REQUEST['idItem'];

  if ($enviarMaterial->updateCancelarItem($id)) {

    $data = array('res' => 'success', 'msg' => 'Item Cancelado');
  } else {

    $data = array('res' => 'error', 'msg' => 'Erro para cancelar');
  }
  echo json_encode($data);
}
if ($action == 'alterarItem') {

  $id = $_REQUEST['idItem'];
  $quantidade = $_REQUEST['quantidade'];

  if ($enviarMaterial->updateQtdeItem($id, $quantidade)) {

    $data = array('res' => 'success', 'msg' => 'Alterado Com Sucesso');
  } else {

    $data = array('res' => 'error', 'msg' => 'Erro para alterar');
  }
  echo json_encode($data);
}
if ($action == 'addObservacao') {

  $id = $_REQUEST['idPedido'];
  $observacao = $enviarMaterial->limpaObservacao(utf8_decode($_REQUEST['observacao']));

  if ($enviarMaterial->insertObservacao($id, $usuarioLogado, $observacao)) {

    $data = array('res' => 'success', 'msg' => 'Alterado Com Sucesso');
  } else {

    $data = array('res' => 'error', 'msg' => 'Erro para alterar');
  }
  echo json_encode($data);
}
if ($action == 'alterarStatus') {

  $id = $_REQUEST['idPedido'];
  $status = $_REQUEST['status'];

  if ($status == 'NOVO') {
    $status = 'ENVIADO';
  } elseif ($status == 'ENVIADO') {
    $status = 'FINALIZADO';
  }

  if ($enviarMaterial->updateStatus($id, $status)) {

    $data = array('res' => 'success', 'msg' => 'Alterado Com Sucesso');
  } else {

    $data = array('res' => 'error', 'msg' => 'Erro para alterar');
  }

  echo json_encode($data);
}
if ($action == 'solicitacaoMateriais') {

  $listaItems = json_decode($_REQUEST['listaItems'], true);
  $tam = count($listaItems);

  for ($x = 0; $x < $tam; $x++) {

    $qtde[$x] = $listaItems[$x]['qtde'];
    $idProduto[$x] = $listaItems[$x]['idProduto'];
    $descricao[$x] = $listaItems[$x]['produto'];
  }
  $enviarMaterial->insertPedido($idUsuario);
  $idPedido = $enviarMaterial->findLastId();
 
  if ($enviarMaterial->insertItens($idPedido, $idProduto, $qtde, $descricao, $tam)) {

    $data = array('res' => 'success', 'msg' => 'Registrado Com Sucesso');
  } else {

    $data = array('res' => 'error', 'msg' => 'Erro para alterar');
  }

  echo json_encode($data);
}
}else{

  header("https://www.rdppetroleo.com.br/medwebnovo/?p=6");
  
}