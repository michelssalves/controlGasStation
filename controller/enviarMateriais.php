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
  $status2 = $_REQUEST['statusFinalizado'];
  $status3 = $_REQUEST['statusCancelado'];
  $med = $_REQUEST['idMed'];
  $cliente =  $_REQUEST['nomeCliente'];
  $paginaAtual = $_REQUEST['paginaAtual'];
  $resultadoPorPagina = 50;

  $start = ($paginaAtual * $resultadoPorPagina + 1) - $resultadoPorPagina;

  if (isset($med) && $med <> '0') {
    $Fmed = "AND p.codcliente = '$med' ";
  }

  if (isset($cliente) && $cliente <> '') {
    $Fcliente = " AND nomeCliente LIKE '%$cliente%' ";
  }
  if ($status1 == '' && $status2 == '' && $status3 == '') {
    $Fstatus =  "AND status = 'NOVO'";
  } else {
    $Fstatus =  "AND status IN ('" . $status1 . "','" . $status2 . "','" . $status3 . "')";
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

  //$model = new Model();

  if ($id) {

    $data = array('res' => 'success', 'msg' => 'Pedido Cancelado');
  } else {

    $data = array('res' => 'error', 'msg' => 'Erro para cancelar');
  }
  echo json_encode($data);
}
if ($action == 'cancelarItem') {

  $id = $_REQUEST['idItem'];

  //$model = new Model();

  if ($id) {

    $data = array('res' => 'success', 'msg' => 'Item Cancelado');
  } else {

    $data = array('res' => 'error', 'msg' => 'Erro para cancelar');
  }
  echo json_encode($data);
}
if ($action == 'alterarItem') {

  $id = $_REQUEST['idItem'];

  //$model = new Model();

  if ($id) {

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

  if ($model->insertObservacao($id, $usuarioLogado, $observacao)) {

    $data = array('res' => 'success', 'msg' => 'Alterado Com Sucesso');
  } else {

    $data = array('res' => 'error', 'msg' => 'Erro para alterar');
  }
  echo json_encode($data);
}

/*if ($action == 'gravarAnexo'){

    $id = $_REQUEST['id'];
    $descricao = limpaObservacao($_REQUEST['descricao']);
    $descricaoAnexo = "ANEXO";
    $temp = $_FILES['file']['tmp_name'];
    $localDeArmazenagem = "../assets/docs/serasa/";
    $tabela = 'ccp_serasa_anexo';
    $evento = "ADICIONOU UM ANEXO";

    if ($_FILES['file']['name'] <> ''){

        $model = new Model();

        $model->insertSerasaEventos($id, $evento, $usuarioLogado);

        $extensao = strtolower(end(explode('.', $_FILES['file']['name'])));

        if($model->insertSerasaAnexo($id, $descricaoAnexo, $descricao, $extensao)){

        uploadArquivo($temp, $extensao, $tabela, $localDeArmazenagem);

        $data = array('res' => 'success');

        }else {

            $data = array('res' => 'error');
           
        }
    }else{

       $data = array('res' => 'error');
       
    }

    echo json_encode($data);
}
if ($action == 'gravarObs'){

    $id = $_REQUEST['id'];
    $observacao = limpaObservacao($_REQUEST['observacao']);

    $model = new Model();

    if($model->insertSerasaObs($id, $usuarioLogado, $observacao)){

        $data = array('res' => 'success');

    }else {

        $data = array('res' => 'error');
    }

    echo json_encode($data);
}
if($action == 'findAnexosById'){

    $id = $_REQUEST['id'];

    $model = new Model();

    $rows = $model->selectSerasaAnexos($id);

    if(!empty($rows)){

        $data = array('rows' => utf8ize($rows));

    }else {

        $data = array('res' => 'error');
    }

    echo json_encode($data);
    
}
if($action == 'findEventosById'){

    $id = $_REQUEST['id'];

    $model = new Model();

    $rows = $model->selectSerasaEventos($id);
    
    if(!empty($rows)){

        $data = array('rows' => utf8ize($rows));

    }else {

        $data = array('res' => 'error');
    }

    echo json_encode($data);
    
}
if($action == 'findObservacoesById'){

    $id = $_REQUEST['id'];

    $model = new Model();

    $rows = $model->selectSerasaObservacoes($id);
    
    if(!empty($rows)){

        $data = array('rows' => utf8ize($rows));

    }else {

        $data = array('res' => 'error');
    }

    echo json_encode($data);
    
}
if($action == 'alterarStatus'){

    $id = $_REQUEST['id'];
    $status = $_REQUEST['status'];
    $observacaoStatus = $_REQUEST['observacaoStatus'];
    $evento = $_REQUEST['evento']; 
    
    
    $model = new Model();

    if($model->alterarStatus($id, $status)){

        $model->insertSerasaEventos($id, $evento, $usuarioLogado);
        $model->insertSerasaObs($id, $usuarioLogado, $observacaoStatus);

        $data = array('res' => 'success');

    }else {

        $data = array('res' => 'error');
    }

    echo json_encode($data);
    
}
if ($action == 'baixarSerasa'){

    $id = $_REQUEST['id'];
    $status = $_REQUEST['status'];
    $observacaoStatus = $_REQUEST['observacaoStatus'];
    $evento = $_REQUEST['evento']; 
    $descricao = $_REQUEST['descricao']; 
    $descricaoAnexo = "ANEXO";
    $temp = $_FILES['file']['tmp_name'];
    $localDeArmazenagem = "../assets/docs/serasa/";
    $tabela = 'ccp_serasa_anexo';
    $evento = "ADICIONOU UM COMPROVANTE DE PGTO";

    if ($_FILES['file']['name'] <> ''){

        $model = new Model();

        $extensao = strtolower(end(explode('.', $_FILES['file']['name'])));

        if($model->insertSerasaAnexo($id, $descricaoAnexo, $descricao, $extensao)){

            $model->alterarStatus($id, $status);
            $model->insertSerasaEventos($id, $evento, $usuarioLogado);
            $model->insertSerasaObs($id, $usuarioLogado, $observacaoStatus);
            uploadArquivo($temp, $extensao, $tabela, $localDeArmazenagem);

            $data = array('res' => 'success');

        }else {

            $data = array('res' => 'error');

        }
    }else{

       $data = array('res' => 'semAnexo');
       
    }

    echo json_encode($data);
}
if ($action == 'alterarSerasa'){

    $id = intval($_REQUEST['id_requisicao']);
    $dtNascimento = $_REQUEST['dtNascimento']; 
    $dtEmissao = $_REQUEST['dtEmissao']; 
    $dtVencimento = $_REQUEST['dtVencimento']; 
    $tipo = $_REQUEST['tipo']; 
    $valorInicial = $_REQUEST['valorInicial']; 
    $valorJuros = $_REQUEST['valorJuros']; 
    $evento = "ALTEROU O REGISTRO";

        $model = new Model();

        if($model->updateSerasa($id, $dtNascimento, $dtEmissao ,$dtVencimento, $tipo, $valorInicial, $valorJuros)){

            $model->insertSerasaEventos($id, $evento, $usuarioLogado);
            $data = array('res' =>  'success');
       
        }else {

            $data = array('res' => 'error');

        }
 
    echo json_encode($data);
}

