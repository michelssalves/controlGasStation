<?php
session_start();
$id = $_SESSION['id_u'];

require_once '../model/PrecosPraca.php';

$precosPraca = new PrecosPraca();

$usuario = $precosPraca->selectUserById($id);
//var_dump($usuario);
if ($usuario['nomeCompleto']) {

  $action = $_REQUEST['action'];

  if ($action == 'findAll') {

    $paginaAtual = ($_REQUEST['paginaAtual'] ? $_REQUEST['paginaAtual'] : '1');
    $resultadoPorPagina = 12;
    $start = ($paginaAtual * $resultadoPorPagina + 1) - $resultadoPorPagina;

    $rows = $precosPraca->findAll($idUsuario, $start, $resultadoPorPagina);

    $data = array('rows' => $precosPraca->converterUtf8($rows[1]), 'results' => $precosPraca->converterUtf8($rows[0]));

    echo json_encode($data);
  }
  if ($action == 'findById') {

    $id = $_REQUEST['id'];

    $rows = $precosPraca->findById($id);

    $data = array('rows' => $precosPraca->converterUtf8($rows));

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

    $nome = $precosPraca->limpaObservacao(utf8_decode($_REQUEST['razaoSocial']));
    $bandeira = $_REQUEST['bandeira'];
    $distancia = $_REQUEST['distancia'];
    $endereco = $precosPraca->limpaObservacao(utf8_decode($_REQUEST['endereco']));
    $bairro = $precosPraca->limpaObservacao(utf8_decode($_REQUEST['bairro']));
    $cep = $_REQUEST['cep'];
    $cidade = $precosPraca->limpaObservacao(utf8_decode($_REQUEST['cidade']));
    $uf = $precosPraca->limpaObservacao(utf8_decode($_REQUEST['uf']));


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
}else{

  header("https://www.rdppetroleo.com.br/medwebnovo/?p=9");
  
}
