<?php
session_start();
include './controllerAux/validaLogin.php';
include './controllerAux/functionsAuxiliar.php';
include '../model/PrecosPraca.php';

$precosPraca = new PrecosPraca();

$action = $_REQUEST['action'];

if ($action == 'findAll') {

  $paginaAtual = ($_REQUEST['paginaAtual'] ? $_REQUEST['paginaAtual'] : '1');
  $resultadoPorPagina = 12;
  $start = ($paginaAtual * $resultadoPorPagina + 1) - $resultadoPorPagina;

  $rows = $precosPraca->findAll($idUsuario, $start, $resultadoPorPagina);

  $data = array('rows' => utf8ize($rows[1]), 'results' => utf8ize($rows[0]));

  echo json_encode($data);

}
if ($action == 'findById') {

  $id = $_REQUEST['id'];

  $rows = $precosPraca->findById($id);

  $data = array('rows' => utf8ize($rows));

  echo json_encode($data);
}
if ($action == 'alterarConcorrente') {

  $gasC = $_REQUEST['gasolinaC'];
  $gasAd = $_REQUEST['gasolinaAd'];
  $etanol = $_REQUEST['etanol'];
  $diesel = $_REQUEST['dieselC'];
  $dieselAd = $_REQUEST['dieselAd'];
  $gnv = $_REQUEST['gnv'];
  $idConc = $_REQUEST['idConcorrente'];


  if ($precosPraca->updateConcorrente($gasC, $gasAd, $etanol, $diesel, $dieselAd, $gnv, $idConc)) {

    $data = array('res' => 'success', 'msg' => 'Alterado Com Sucesso');

  } else {

    $data = array('res' => 'error', 'msg' => 'Erro para alterar');
    
  }

  echo json_encode($data);
}
if ($action == 'criarConcorrente') {

  $nome = limpaObservacao(utf8_decode($_REQUEST['razaoSocial']));
  $bandeira = $_REQUEST['bandeira'];
  $distancia = $_REQUEST['distancia'];
  $endereco = limpaObservacao(utf8_decode($_REQUEST['endereco']));
  $bairro = limpaObservacao(utf8_decode($_REQUEST['bairro']));
  $cep = $_REQUEST['cep'];
  $cidade = limpaObservacao(utf8_decode($_REQUEST['cidade']));
  $uf = limpaObservacao(utf8_decode($_REQUEST['uf']));
  

  if ($precosPraca->insertConcorrente($nome, $bandeira, $idUsuario, $distancia, $endereco, $bairro, $cep, $cidade, $uf, $idXpert)) {

    $idPosto = $precosPraca->findLastId();

    if ($precosPraca->insertConcorrenteTabelaPrecos($idPosto)) {

      $data = array('res' => 'success', 'msg' => 'Criado Com Sucesso');
    }
  } else {

    $data = array('res' => 'error', 'msg' => 'Erro para alterar');
  }

  echo json_encode($data);
}
