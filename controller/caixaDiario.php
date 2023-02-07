<?php
session_start();
include './controllerAux/validaLogin.php';
include './controllerAux/functionsAuxiliar.php';
include '../model/CaixaDiario.php';

$action = $_REQUEST['action'];

if ($action == 'findAll') {

    $status1 = $_REQUEST['statusNovo'];
    $status2 = $_REQUEST['statusFechado'];
    $status3 = $_REQUEST['statusDefinitivo'];
    $status4 = $_REQUEST['statusCancelado'];
    $status5 = $_REQUEST['statusAberto'];
    $med = $_REQUEST['idMed'];
    $data1 = $_REQUEST['data1'];
    $data2 = $_REQUEST['data2'];
    $turnoDefinitivo = $_REQUEST['turnoDefinitivo'];
    $concBancaria = $_REQUEST['concBancaria'];

    $filtroData = "AND data_caixa BETWEEN '$data1' AND '$data2'";

    if($status1 == '' && $status2 == '' && $status3 == '' && $status4 == '' && $status5 == ''){
        $filtroStatus = "AND status IN ('NOVO', 'ABERTO')";
    }else{
        $filtroStatus = "AND status IN ('$status1', '$status2', '$status3', '$status4', '$status5')";
    }
    if($med <> ''){ $filtroFilial = "AND id_med = $med ";  }
    if($turnoDefinitivo <> '0'){ $filtroTurno = "AND turnos_definitivo = '$turnoDefinitivo' ";  }
    if($concBancaria <> '0'){ $filtroConciliacao = "AND conc = '$concBancaria' ";  }
    
    $model = new Model();

    $rows = $model->findAll($filtroStatus, $filtroFilial, $filtroData, $filtroTurno, $filtroConciliacao);

    $data = array('rows' => utf8ize($rows));

    echo json_encode($data);
}
if ($action == 'findAllMeds') {

    $model = new Model();

    $rows = $model->selectAllMeds();

    $data = array('rows' => utf8ize($rows));

    echo json_encode($data);
}
if ($action == 'findById') {

    $id = $_REQUEST['id'];

    $model = new Model();

    $rows = $model->findById($id);

    $data = array('rows' => utf8ize($rows));

    echo json_encode($data);
}
if ($action == 'gravarAnexo') {

    $id = $_REQUEST['id'];
    $descricao = limpaObservacao($_REQUEST['descricao']);

    if ($_FILES['file']['name'] <> '') {

        $extensao = strtolower(end(explode('.', $_FILES['file']['name'])));

        $model = new Model();

        if ($model->insertCaixaDiarioAnexo($id, $descricao, $extensao)) {

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
if ($action == 'gravarObs') {

    $id = $_REQUEST['id'];
    $obs = limpaObservacao($_REQUEST['observacao']);

    $model = new Model();

    if($model->insertCaixaDiarioObs($id, $usuarioLogado, $obs)){

        $data = array('res' => 'success');

    }else {

        $data = array('res' => 'errorObs');
    }

    echo json_encode($data);
}
if ($action == 'alterarCaixa') {

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
   // $model = new Model();

   // if($model->updateCaixa($id, $dinheiro, $cheque, $brinks, $pix, $med, $data, $definitivo, $conciliacao, $fechamento, $observacao)){
    if($id){
        $data = array('res' => 'success');

    }else {

        $data = array('res' => 'errorObs');
    }

    echo json_encode($data);
}
if($action == 'cancelarCaixa'){

    $id = $_REQUEST['id_requisicao'];
    $motivoCancelamento = limpaObservacao($_REQUEST['motivoCancelamento']);
    $observacao = 'ALTEROU O STATUS PARA CANCELADO';
    $status = 'CANCELADO';
  
    $model = new Model();

    if($model->updateCancelarCaixa($id, $status, $observacao)){
        
        $model->insertCaixaDiarioObs($id, $usuarioLogado, $motivoCancelamento);

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
  
//    $model = new Model();

   // if($model->updateCancelarCaixa($id, $status, $observacao)){
        if($id){
      //  $model->insertCaixaDiarioObs($id, $usuarioLogado, $observacao);

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
  
    //$model = new Model();
   
    if($conc == 'SIM' && $caixa == 'SIM'){
        
       // $model->updateCancelarCaixa($id, $status, $observacao);
        //$model->insertCaixaDiarioObs($id, $usuarioLogado, $observacao);

        $data = array('res' => 'success');
    
    
    }else {

        $data = array('res' => 'error');
        
    }

    echo json_encode($data);
   
}
if($action == 'findAnexosById'){

    $id = $_REQUEST['id'];

    $model = new Model();

    $rows = $model->selectCaixaDiarioAnexos($id);

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

    $rows = $model->selectCaixaDiarioEventos($id);
    
    if(!empty($rows)){

        $data = array('rows' => utf8ize($rows));

    }else {

        $data = array('res' => 'errorAnexos');
    }

    echo json_encode($data);
    
}
    