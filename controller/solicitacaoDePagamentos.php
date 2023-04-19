<?php
session_start();
$id = $_SESSION['id_u'];
require_once '../model/SolicitacaoDePagamentos.php';

$solicitacaoDePagamento = new SolicitacaoDePagamento();

$usuario = $solicitacaoDePagamento->selectUserById($id);

if ($usuario['nomeCompleto']) {

  $action = $_REQUEST['action'];

  if ($action == 'findAllMeds') {

    $rows = $solicitacaoDePagamento->findAllMeds();

    $data = array('rows' => $rows);

    echo json_encode($data);
  }
  if ($action == 'findAllFornecedores') {

    $rows = $solicitacaoDePagamento->selectAllFornecedores($usuario['idXpert']);

    $data = array('rows' => $rows);

    echo json_encode($data);
  }
  if ($action == 'findAll') {

    $data1 = $_REQUEST['data1'];
    $data2 = $_REQUEST['data2'];
    $status1 = $_REQUEST['statusNovo'];
    $status2 = $_REQUEST['statusPendente'];
    $status3 = $_REQUEST['statusAguardando'];
    $status4 = $_REQUEST['statusFinalizado'];
    $status5 = $_REQUEST['statusCancelado'];
    $med = $_REQUEST['idMed'];
    $fornecedor =  $_REQUEST['fornecedor'];
    $dataVencimento = $_REQUEST['dataVencimento'];
    $paginaAtual  = ($_REQUEST['paginaAtual'] ? $_REQUEST['paginaAtual'] : '1');

    $resultadoPorPagina = 12;
    $start = ($paginaAtual * $resultadoPorPagina + 1) - $resultadoPorPagina;

    if ($data1 != '' &&  $data2 != '') {

      $Fdata = "AND r.vencimento BETWEEN '$data1' AND '$data2'";
    }

    if (isset($med) && $med <> '0') {
      $Fmed = "AND med LIKE '%$med%' ";
    }

    if (isset($fornecedor) && $fornecedor <> '') {
      $Ffornecedor = "AND fornecedor LIKE '%$fornecedor%'";
    }
    if ($status1 == '' && $status2 == '' && $status3 == '' && $status4 == '' && $status5 == '') {
      $Fstatus =  "AND status IN ('NOVO', 'AGUARDANDO')";
    } else {
      $Fstatus =  "AND status IN ('" . $status1 . "','" . $status2 . "','" . $status3 . "','" . $status4 . "','" . $status5 . "')";
    }

    $rows = $solicitacaoDePagamento->findAll($Fstatus, $Fmed, $Ffornecedor, $Fdata, $start, $resultadoPorPagina);

    $data = array('rows' =>  $solicitacaoDePagamento->converterUtf8($rows[1]), 'results' =>  $solicitacaoDePagamento->converterUtf8($rows[0]));

    echo json_encode($data);
  }
  if ($action == 'findById') {

    $id = $_REQUEST['id'];

    $rows = $solicitacaoDePagamento->findById($id);
    $rowAnx = $solicitacaoDePagamento->selectAnexos($id);
    $rowObs = $solicitacaoDePagamento->selectObservacao($id);

    $data = array('rows' => $rows,  'observacoes' => $rowObs,  'anexos' => $rowAnx);

    echo json_encode($data);
  }
  if ($action == 'addObservacao') {

    $id = $_REQUEST['id'];

    $observacao = $solicitacaoDePagamento->limpaObservacao(utf8_decode($_REQUEST['observacao']));

    if ($solicitacaoDePagamento->insertObservacao($id, $usuarioLogado, $observacao)) {

      $data = array('res' => 'success', 'msg' => 'Registrada Com Sucesso');
    } else {

      $data = array('res' => 'error', 'msg' => 'Erro para alterar');
    }

    echo json_encode($data);
  }
  if ($action == 'alterarStatus') {

    $id = $_REQUEST['id'];
    $status = $_REQUEST['status'];

    if ($solicitacaoDePagamento->updateStatus($id, $status)) {

      $data = array('res' => 'success', 'msg' => 'Alterado Com Sucesso');
    } else {

      $data = array('res' => 'error', 'msg' => 'Erro para alterar');
    }

    echo json_encode($data);
  }
  if ($action == 'gravarAnexoAdicional') {

    $descricao = $solicitacaoDePagamento->limpaObservacao(utf8_decode($_REQUEST['descricao']));
    $id = $_REQUEST['id'];

    if ($_FILES['file']['name'] <> '') {

      if ($descricao == '') {

        $descricao = $_FILES['file']['name'];
      }

      $extensao = strtolower(end(explode('.', $_FILES['file']['name'])));
      $temp = $_FILES['file']['tmp_name'];
      $localDeArmazenagem = "../assets/docs/solicitacaoPgtos/";
      $tabela = "ccp_reqCompras_anexos";
      $campo = "id_ccp_reqCompras_anexos";

      if ($solicitacaoDePagamento->insertAnexo($descricao, $extensao, $id, $usuarioLogado)) {

        $solicitacaoDePagamento->uploadArquivo($temp, $extensao, $tabela, $localDeArmazenagem, $campo);

        $data = array('res' =>  'success', 'msg' => 'Anexado com sucesso!');
      } else {

        $data = array('res' => 'error', 'msg' => 'Houve algum erro!');
      }

      echo json_encode($data);
    } else {
      echo 'Houve algum erro, tente refazer o processo';
    }
  }
  if ($action == 'addDocumentos') {

    if ($_FILES['file']['name'] <> '') {

      $extensao = strtolower(end(explode('.', $_FILES['file']['name'])));
      $descricao = explode('.', $_FILES['file']['name']);

      $id = $solicitacaoDePagamento->findLastId();

      $solicitacaoDePagamento->insertAnexo($descricao[0], $extensao, $id, $usuarioLogado);

      $idAnexo = $solicitacaoDePagamento->findLastIdAnexo();

      if ($idAnexo) {

        $temp = $_FILES['file']['tmp_name'];
        $localDeArmazenagem = "../assets/docs/solicitacaoPgtos/";
        $tabela = "ccp_reqCompras_anexos";
        $campo = "id_ccp_reqCompras_anexos";
        //$token = md5(time() . rand(0, 9999) . time());
        $nomeDoArquivo = "$idAnexo.$extensao";

        $solicitacaoDePagamento->uploadArquivoCaixa($temp, $localDeArmazenagem, $nomeDoArquivo);

        $data = array('res' =>  'success', 'msg' => 'Salvo com sucesso!');
      }
    } else {

      $data = array('res' => 'error', 'msg' => 'Houve algum erro!');
    }

    echo json_encode($data);
  }
}else{

  header("https://www.rdppetroleo.com.br/medwebnovo/?p=7");
  
}
