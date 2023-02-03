<?php
session_start();
include './controllerAux/validaLogin.php';
include './controllerAux/functionsAuxiliar.php';
include '../model/CaixaDiario.php';

$action = $_REQUEST['action'];

if ($action == 'findAll') {

    $model = new Model();

    $rows = $model->findAll();

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

       // if ($model->insertCaixaDiarioAnexo($id, $descricao, $extensao)) {

        if($id){   
           
            $temp = $_FILES['file']['tmp_name'];
            $localDeArmazenagem = "../assets/docs/fechamentoCaixa/";
            $tabela = "ccp_fechamentoCaixa_anexo";

          //  uploadArquivo($temp, $extensao, $tabela, $localDeArmazenagem);

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

    //if($model->insertCaixaDiarioObs($id, $usuarioLogado, $obs)){

    if($id){    

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
    $model = new Model();

    //if($model->updateCaixa($id, $dinheiro, $cheque, $brinks, $pix, $med, $data, $definitivo, $conciliacao, $fechamento, $observacao)){
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

    if($id){
        
       // $model->updateCancelarCaixa($id, $status, $observacao);

       // $model->insertCaixaDiarioObs($id, $usuarioLogado, $motivoCancelamento);

        $data = array('res' => 'success');

    }else {

        $data = array('res' => 'errorObs');
    }

    echo json_encode($data);

}
if($action == 'abrirCaixa'){

    $status = 'ABERTO';
    $id = $_REQUEST['id_requisicao'];
    $observacao = 'ALTEROU O STATUS PARA ABERTO';
  
    $model = new Model();

    if($id){
        
       // $model->updateCancelarCaixa($id, $status, $observacao);

       // $model->insertCaixaDiarioObs($id, $usuarioLogado, $observacao);

        $data = array('res' => 'success');

    }else {

        $data = array('res' => 'errorObs');
    }

    echo json_encode($data);
    
}
if($action == 'fecharCaixa'){

    $id = $_REQUEST['id_requisicao'];
    $observacao = 'ALTEROU O STATUS PARA FECHADO';
    $status = 'FECHADO';
  
    $model = new Model();

    if($id){
        
       // $model->updateCancelarCaixa($id, $status, $observacao);

       // $model->insertCaixaDiarioObs($id, $usuarioLogado, $observacao);

        $data = array('res' => 'success');

    }else {

        $data = array('res' => 'errorObs');
    }

    echo json_encode($data);
    
}

    