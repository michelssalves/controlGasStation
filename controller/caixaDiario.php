<?php
session_start();
include './controllerAux/validaLogin.php';
include './controllerAux/functionsAuxiliar.php';
include '../model/CaixaDiario.php';

$action = $_REQUEST['action'];

if($action == 'findAllMeds') {

    $model = new Model();

    $rows = $model->findAllMeds();

    $data = array('rows' => utf8ize($rows));

    echo json_encode($data);
}
if($action == 'findAll') {
    
    $status1 = $_REQUEST['statusNovo'];
    $status2 = $_REQUEST['statusFechado'];
    $status3 = $_REQUEST['statusCancelado'];
    $status4 = $_REQUEST['statusAberto'];
    $med = $_REQUEST['idMed'];
    $data1 = $_REQUEST['data1'];
    $data2 = $_REQUEST['data2'];
    $turnoDefinitivo = $_REQUEST['turnoDefinitivo'];
    $concBancaria = $_REQUEST['concBancaria'];
    $paginaAtual = $_REQUEST['paginaAtual'];
    $resultadoPorPagina = 12;

    $start = ($paginaAtual * $resultadoPorPagina + 1) - $resultadoPorPagina;

    $filtroData = "AND data_caixa BETWEEN '$data1' AND '$data2'";

    if($status1 == '' && $status2 == '' && $status3 == '' && $status4 == ''){
        $filtroStatus = "AND status IN ('NOVO', 'ABERTO')";
    }else{
        $filtroStatus = "AND status IN ('$status1', '$status2', '$status3', '$status4')";
    }
    if($med <> ''){ $filtroFilial = "AND id_med = $med ";  }
    if($turnoDefinitivo <> '0'){ $filtroTurno = "AND turnos_definitivo = '$turnoDefinitivo' ";  }
    if($concBancaria <> '0'){ $filtroConciliacao = "AND conc = '$concBancaria'";  }
    
    $model = new Model();

    $rows = $model->findAll($filtroStatus, $filtroFilial, $filtroData, $filtroTurno, $filtroConciliacao, $start, $resultadoPorPagina);

    $data = array('rows' => utf8ize($rows[1]), 'results' => utf8ize($rows[0]));

    echo json_encode($data);
}
if($action == 'findById') {

    $id = $_REQUEST['id'];

    $model = new Model();

    $rows = $model->findById($id);

    $data = array('rows' => utf8ize($rows));

    echo json_encode($data);
}
if($action == 'addAnexo') {

    $id = $_REQUEST['id'];
    $descricao = limpaObservacao(utf8_decode($_REQUEST['descricaoAnexo']));

    if ($_FILES['file']['name'] <> '') {

        $extensao = strtolower(end(explode('.', $_FILES['file']['name'])));

        $model = new Model();

        if ($model->insertAnexo($id, $descricao, $extensao)) {

            $temp = $_FILES['file']['tmp_name'];
            $localDeArmazenagem = "../assets/docs/fechamentoCaixa/";
            $tabela = "ccp_fechamentoCaixa_anexo";

            uploadArquivo($temp, $extensao, $tabela, $localDeArmazenagem);

            $data = array('res' => 'success');

        }else {

            $data = array('res' => 'errorInsert');
           
        }
    } else {

       $data = array('res' => 'errorAnexo');
       
    }

    echo json_encode($data);
}
if($action == 'gravarObs') {

    $id = $_REQUEST['id'];
    $obs = limpaObservacao(utf8_decode($_REQUEST['observacao']));

    $model = new Model();

    if($model->insertObservacoes($id, $usuarioLogado, $obs)){

        $data = array('res' => 'success');

    }else {

        $data = array('res' => 'errorObs');
    }

    echo json_encode($data);
}
if($action == 'alterarCaixa') {

    $id = $_REQUEST['id_requisicao'];
    $dinheiro = $_REQUEST['dinheiro'];
    $cheque = $_REQUEST['cheque'];
    $brinks = $_REQUEST['brinks'];
    $pix = $_REQUEST['pix'];
    $med = $_REQUEST['med'];
    $data = $_REQUEST['data'];
    $definitivo = $_REQUEST['definitivo'];
    $conciliacao = $_REQUEST['conciliacao'];
    $fechamento = $_REQUEST['fechamento'];
    $observacao = $_REQUEST['observacao'];
    $model = new Model();

    if($model->updateCaixa($id, $dinheiro, $cheque, $brinks, $pix, $med, $data, $definitivo, $conciliacao, $fechamento, $observacao)){
   
        $data = array('res' => 'success');

    }else {

        $data = array('res' => 'errorObs');
    }

    echo json_encode($data);
}
if($action == 'cancelarCaixa'){

    $id = $_REQUEST['id_requisicao'];
    $motivoCancelamento = limpaObservacao(utf8_decode($_REQUEST['motivoCancelamento']));
    $observacao = 'ALTEROU O STATUS PARA CANCELADO';
    $status = 'CANCELADO';
  
    $model = new Model();

    if($model->updateCancelarCaixa($id, $status, $observacao)){
        
        $model->insertObservacoes($id, $usuarioLogado, $motivoCancelamento);

        $data = array('res' => 'success');

    }else {

        $data = array('res' => 'errorObs');
    }

    echo json_encode($data);

}
if($action == 'abrirCaixa'){

    $id = $_REQUEST['id'];
    $status = 'ABERTO';
    $observacao = 'ALTEROU O STATUS PARA ABERTO';
  
    $model = new Model();

    if($model->updateCancelarCaixa($id, $status, $observacao)){
        
        $model->insertObservacoes($id, $usuarioLogado, $observacao);

        $data = array('res' => 'success');

    }else {

        $data = array('res' => 'error');
    }

    echo json_encode($data);
    
}
if($action == 'fecharCaixa'){

    $id = $_REQUEST['id_requisicao'];
    $observacao = 'ALTEROU O STATUS PARA FECHADO';
    $status = 'FECHADO';
    $conc = $_REQUEST['conc'];
    $caixa = $_REQUEST['caixa'];
  
    $model = new Model();
   
    if($conc == 'SIM' && $caixa == 'SIM'){
        
        $model->updateCancelarCaixa($id, $status, $observacao);
        $model->insertObservacoes($id, $usuarioLogado, $observacao);

        $data = array('res' => 'success');
    
    
    }else {

        $data = array('res' => 'error');
        
    }

    echo json_encode($data);
   
}
if($action == 'findAnexosById'){

    $id = $_REQUEST['id'];

    $model = new Model();

    $rows = $model->selectAnexos($id);

    if(!empty($rows)){

        $data = array('rows' => utf8ize($rows));

    }else {

        $data = array('res' => 'errorAnexos');
    }

    echo json_encode($data);
    
}
if($action == 'findEventosById'){

    $id = $_REQUEST['id'];

    $model = new Model();

    $rows = $model->selectEventos($id);
    
    if(!empty($rows)){

        $data = array('rows' => utf8ize($rows));

    }else {

        $data = array('res' => 'errorAnexos');
    }

    echo json_encode($data);
    
}
    