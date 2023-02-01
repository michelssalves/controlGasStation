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
    

    