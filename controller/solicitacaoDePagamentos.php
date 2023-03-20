<?php
session_start();
include './controllerAux/validaLogin.php';
include './controllerAux/functionsAuxiliar.php';
include '../model/SolicitacaoDePagamentos.php';

$action = $_REQUEST['action'];

if ($action == 'findAllMeds') {

  $solicitacaoDePagamento = new SolicitacaoDePagamento();

  $rows = $solicitacaoDePagamento->selectAllMeds();

  $data = array('rows' => utf8ize($rows));

  echo json_encode($data);
}
if ($action == 'findAllFornecedores') {

  $solicitacaoDePagamento = new SolicitacaoDePagamento();

  $rows = $solicitacaoDePagamento->selectAllFornecedores($idXpert); 
  
  $data = array('rows' => utf8ize($rows));

  echo json_encode($data);
}
if($action == 'findAll') {

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

  if($data1 != '' &&  $data2 != ''){

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

  $solicitacaoDePagamento = new SolicitacaoDePagamento();


  $rows = $solicitacaoDePagamento->findAll($Fstatus, $Fmed, $Ffornecedor, $Fdata, $start, $resultadoPorPagina);


  $data = array('rows' => utf8ize($rows[1]), 'results' => utf8ize($rows[0]), 'teste' => $teste);

  echo json_encode($data);
}
if($action == 'findById') {

  $id = $_REQUEST['id'];

  $solicitacaoDePagamento = new SolicitacaoDePagamento();

  $rows = $solicitacaoDePagamento->findById($id);
  $rowAnx = $solicitacaoDePagamento->selectAnexos($id);
  $rowObs = $solicitacaoDePagamento->selectObservacao($id);

  $data = array('rows' => utf8ize($rows),  'observacoes' => utf8ize($rowObs),  'anexos' => utf8ize($rowAnx));
  
  echo json_encode($data);
}
if($action == 'addObservacao') {

  $id = $_REQUEST['id'];

  $observacao = limpaObservacao(utf8_decode($_REQUEST['observacao']));
 
  $solicitacaoDePagamento = new SolicitacaoDePagamento();

  if($solicitacaoDePagamento->insertObservacao($id, $usuarioLogado, $observacao)) {

      $data = array('res' => 'success', 'msg' => 'Registrada Com Sucesso');
    } else {

      $data = array('res' => 'error', 'msg' => 'Erro para alterar');
    }

  echo json_encode($data);
}
if($action == 'alterarStatus') {

  $id = $_REQUEST['id'];
  $status = $_REQUEST['status'];

  $solicitacaoDePagamento = new SolicitacaoDePagamento();

  if($solicitacaoDePagamento->updateStatus($id, $status)) {

    $data = array('res' => 'success', 'msg' => 'Alterado Com Sucesso');

  } else {

    $data = array('res' => 'error', 'msg' => 'Erro para alterar');
  }

  echo json_encode($data);
}
if($action == 'gravarAnexoAdicional') {

    $descricao = limpaObservacao(utf8_decode($_REQUEST['descricao']));
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

        $solicitacaoDePagamento = new SolicitacaoDePagamento();

        
        if($solicitacaoDePagamento->insertAnexo($descricao, $extensao, $id, $usuarioLogado)){

            uploadArquivo($temp, $extensao, $tabela, $localDeArmazenagem, $campo);
  
            $data = array('res' =>  'success', 'msg' => 'Anexado com sucesso!');
       
        }else {
    
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
      $solicitacaoDePagamento = new SolicitacaoDePagamento();
      $id = $solicitacaoDePagamento->findLastId();
      
      $solicitacaoDePagamento->insertAnexo($descricao[0], $extensao, $id, $usuarioLogado);

      $idAnexo = $solicitacaoDePagamento->findLastIdAnexo();
      
      if($idAnexo){

          $temp = $_FILES['file']['tmp_name'];
          $localDeArmazenagem = "../assets/docs/solicitacaoPgtos/";
          $tabela = "ccp_reqCompras_anexos";
          $campo = "id_ccp_reqCompras_anexos";
          //$token = md5(time() . rand(0, 9999) . time());
          $nomeDoArquivo = "$idAnexo.$extensao";

          uploadArquivoCaixa($temp, $localDeArmazenagem, $nomeDoArquivo);

          $data = array('res' =>  'success', 'msg' => 'Salvo com sucesso!');
      }
  } else {

      $data = array('res' => 'error', 'msg' => 'Houve algum erro!');
  }

  echo json_encode($data);
}
