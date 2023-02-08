<?php
session_start();
include './controllerAux/validaLogin.php';
include './controllerAux/functionsAuxiliar.php';
include '../model/Serasa.php';

$action = $_REQUEST['action'];

if ($action == 'findAllMeds'){

    $model = new Model();

    $rows = $model->selectAllMeds();

    $data = array('rows' => utf8ize($rows));

    echo json_encode($data);
}
if ($action == 'findAll'){

    $status1 = $_REQUEST['statusNovo'];
    $status2 = $_REQUEST['statusPefin'];
    $status3 = $_REQUEST['statusBaixado'];
    $status4 = $_REQUEST['statusCancelado'];
    $med = $_REQUEST['idMed'];
    $matriz =  $_REQUEST['matriz'];
    $tipo =  $_REQUEST['tipo'];
    $cliente =  $_REQUEST['nomeCliente'];
    $paginaAtual = $_REQUEST['paginaAtual'];
    $resultadoPorPagina = 50;

    $start = ($paginaAtual * $resultadoPorPagina + 1) - $resultadoPorPagina;

    if ($matriz == 1) {
        $Fmatriz = " AND matriz = 1 ";
    }else{
        $Fmatriz = " AND matriz = 0 ";
    }
    if (isset($med) && $med <> '0') {
        $Fmed = "AND id_med = '$med' ";
    }
    if (isset($tipo) && $tipo <> '0') {
        $Ftipo = " AND tipo LIKE '%$tipo%' ";
    }
    if (isset($cliente) && $cliente <> '') {
        $Fcliente = " AND nomeCliente LIKE '%$cliente%' ";
    }
    if ($status1 == '' && $status2 == '' && $status3 == '' && $status4 == '') {
        $Fstatus =  "AND status = 'PEFIN'";
    } else {
        $Fstatus =  "AND status IN ('" . $status1 . "','" . $status2 . "','" . $status3 . "','" . $status4 . "')";
    }

    $model = new Model();

    $rows = $model->findAll($Fstatus, $Fmatriz, $Fmed, $Ftipo, $Fcliente, $start, $resultadoPorPagina);

    $data = array('rows' => utf8ize($rows[1]), 'results' => utf8ize($rows[0]));

    echo json_encode($data);
}
if ($action == 'findById'){

    $id = $_REQUEST['id'];

    $model = new Model();

    $rows = $model->findById($id);

    $data = array('rows' => utf8ize($rows));

    echo json_encode($data);
}
if ($action == 'gravarAnexo'){

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
/*if ($action == 'alterarCaixa') {

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