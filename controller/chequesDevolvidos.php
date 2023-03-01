<?php
session_start();
include './controllerAux/validaLogin.php';
include './controllerAux/functionsAuxiliar.php';
include '../model/ChequesDevolvidos.php';

$action = $_REQUEST['action'];

if($action == 'findAllMeds') {

    $model = new Model();
  
    $rows = $model->findAllMeds();
  
    $data = array('rows' => utf8ize($rows));
  
    echo json_encode($data);
}
if($action == 'findAll') {

    $status1 =  $_REQUEST['statusNovo'];
    $status2 =  $_REQUEST['statusNegociando'];
    $status3 =  $_REQUEST['statusQuitado'];
    $status4 =  $_REQUEST['statusPfin'];
    $status5 =  $_REQUEST['statusJuridico'];
    $status6 =  $_REQUEST['statusExecucao'];
    $status7 =  $_REQUEST['statusCaducou'];
    $status8 =  $_REQUEST['statusExtraviado'];
    $status9 =  $_REQUEST['statusCancelado'];
    $tipoData = $_REQUEST['tipoData'];
    $idMed = $_REQUEST['idMed'];
    $data1 = $_REQUEST['data1'];
    $data2 = $_REQUEST['data2'];
    $paginaAtual = $_REQUEST['paginaAtual'];
    $resultadoPorPagina = 6;
    $start = ($paginaAtual * $resultadoPorPagina + 1) - $resultadoPorPagina;


    if ($status1 == '' && $status2 == '' && $status3 == '' && $status4 == '' && $status5 == '' && $status6 == '' && $status7 == '' && $status8 == '' && $status9 == ''){
        $Fstatus =  "AND ch.status = 'PFIN'";
    }else {
        $Fstatus =  "AND ch.status IN ('" . $status1 . "','" . $status2 . "','" . $status3 . "','" . $status4 . "',
        '" . $status5 . "','" . $status6 . "','" . $status7 . "','" . $status8 . "','" . $status9 . "')";
    }
    if ($idMed <> '0') {

        $Fmed = "AND u.id = $idMed";
    }
    if (empty($tipoData) || $tipoData == '0') {

        $tipoData = 'ch.dthrInclusao';
    }
    if ($tipoData  === '1') {
        $tipoData = 'ch.dtCheque';
    }
    if ($tipoData  === '2') {
        $tipoData = 'ch.dtDevol';
    }
    if ($tipoData  === '3') {
        $tipoData = 'ch.dtQuitacao';
    }

    $FtipoData = " AND $tipoData BETWEEN '" . $data1 . "' AND '" . $data2 . "' ";

    $model = new Model();

    $rows = $model->findAll($FtipoData, $Fmed, $Fstatus, $start, $resultadoPorPagina);

    $data = array('rows' => utf8ize($rows[1]), 'results' => utf8ize($rows[0]));

    echo json_encode($data);
}
if($action == 'findById') {

    $id = $_REQUEST['id'];

    $model = new Model();

    $rows = $model->findById($id);
    $rowObs = $model->selectObservacaoes($id);
    $rowAnx = $model->selectAnexos($id);
    $rowEve = $model->selectEventos($id);

    $data = array('rows' => utf8ize($rows),  'obs' => utf8ize($rowObs),  'anexos' => utf8ize($rowAnx),  'eventos' => utf8ize($rowEve));

    echo json_encode($data);
}
if($action == 'gravarAnexo') {

    $id = $_REQUEST['id'];
    $evento = 'Incluiu um Anexo';

    if ($_FILES['file']['name'] <> '') {

        if ($descricao == '') {

            $descricao = $_FILES['file']['name'];
        }

        $extensao = strtolower(end(explode('.', $_FILES['file']['name'])));
        $temp = $_FILES['file']['tmp_name'];
        $localDeArmazenagem = "../assets/docs/chequesDevolvidos/";
        $tabela = "ccp_chequeDevAnexo";

        $model = new Model();

        
        if($model->insertAnexo($descricao, $extensao, $id, $idUsuario, $usuarioLogado)){

            uploadArquivo($temp, $extensao, $tabela, $localDeArmazenagem);
            $model->insertEvento($evento, $id, $idUsuario, $usuarioLogado);
            $model->updateUltimaAlteracao($id);

            $data = array('res' =>  'success', 'msg' => 'Anexado com sucesso!');
       
        }else {
    
            $data = array('res' => 'error', 'msg' => 'Houve algum erro!');
    
        }
    
        echo json_encode($data);
    } else {
        echo 'Houve algum erro, tente refazer o processo';
    }
}
if($action == 'addObservacao') {

    $id = $_REQUEST['id'];
    $observacao = limpaObservacao(utf8_decode($_REQUEST['observacao']));
    $evento = 'Incluiu Observação';

    $model = new Model();

    if(
    $model->insertObservacao($id, $idUsuario, $usuarioLogado, $observacao) == TRUE &&
    $model->insertEvento($evento, $id, $idUsuario, $usuarioLogado )  == TRUE
    ){

        $data = array('res' =>  'success', 'msg' => 'Registrado com sucesso!');
   
    }else {

        $data = array('res' => 'error', 'msg' => 'Houve algum erro!');

    }

    echo json_encode($data);
}
if($action == 'quitarCheque') {

    $id = $_REQUEST['id'];
    $evento = 'Incluiu Comprovante';
    $status = 'QUITADO';

    if ($_FILES['file']['name'] <> '') {

        $descricao = $_FILES['file']['name'];
        $extensao = strtolower(end(explode('.', $_FILES['file']['name'])));
        $temp = $_FILES['file']['tmp_name'];
        $localDeArmazenagem = "../assets/docs/chequesDevolvidos/";
        $tabela = "ccp_chequeDevAnexo";

        $model = new Model();

       if($model->insertAnexo($descricao, $extensao, $id, $idUsuario, $usuarioLogado)){

        uploadArquivo($temp, $extensao, $tabela, $localDeArmazenagem);
        $model->insertEvento($evento, $id, $idUsuario, $usuarioLogado);
        $model->updateDataQuitacao($id, $status);
     
        $data = array('res' =>  'success', 'msg' => 'Quitado com sucesso!');
   
    }else {

        $data = array('res' => 'error', 'msg' => 'Houve algum erro!');

    }

    echo json_encode($data);

    } else {
        echo 'Houve algum erro, tente refazer o processo';
    }
}
if($action == 'mudarStatus') {

    $id = $_REQUEST['id'];
    $status = $_REQUEST['status'];
    $evento = 'Alterarou Status';

    $model = new Model();

    if($model->updateStatus($id, $status)){
   

        $model->insertEvento($evento, $id, $idUsuario, $usuarioLogado);
        $data = array('res' =>  'success', 'msg' => 'Alterado com sucesso!');
   
    }else {

        $data = array('res' => 'error', 'msg' => 'Houve algum erro!');

    }

    echo json_encode($data);
}
if($action == 'considerarPfin') {

    $id = $_REQUEST['id'];
    $status = $_REQUEST['status'];
    $evento = 'Alterarou Status';

    $model = new Model();

    if($model->updateStatus($id, $status)){

        $model->insertEvento($evento, $id, $idUsuario, $usuarioLogado);
        $data = array('res' =>  'success', 'msg' => 'Alterado P/ PFIN com sucesso!');
   
    }else {

        $data = array('res' => 'error', 'msg' => 'Houve algum erro!');

    }

    echo json_encode($data);
}
