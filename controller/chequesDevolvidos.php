<?php
session_start();
$id = $_SESSION['id_u'];

require_once '../model/ChequesDevolvidos.php';

$chequeDevolvido = new ChequeDevolvido();

$usuario = $chequeDevolvido->selectUserById($id);
//var_dump($usuario);
if ($usuario['nomeCompleto']) {

$action = $_REQUEST['action'];

if($action == 'findAllMeds') {

    $chequeDevolvido = new ChequeDevolvido();
  
    $rows = $chequeDevolvido->findAllMeds();
  
    $data = array('rows' => $chequeDevolvido->converterUtf8($rows));
  
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
    $resultadoPorPagina = 10;
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

    $chequeDevolvido = new ChequeDevolvido();

    $rows = $chequeDevolvido->findAll($FtipoData, $Fmed, $Fstatus, $start, $resultadoPorPagina);

    $data = array('rows' => $chequeDevolvido->converterUtf8($rows[1]), 'results' => $chequeDevolvido->converterUtf8($rows[0]));

    echo json_encode($data);
}
if($action == 'findById') {

    $id = $_REQUEST['id'];

    $chequeDevolvido = new ChequeDevolvido();

    $rows = $chequeDevolvido->findById($id);
    $rowObs = $chequeDevolvido->selectObservacaoes($id);
    $rowAnx = $chequeDevolvido->selectAnexos($id);
    $rowEve = $chequeDevolvido->selectEventos($id);

    $data = array('rows' => $chequeDevolvido->converterUtf8($rows),  'obs' => $chequeDevolvido->converterUtf8($rowObs),  'anexos' => $chequeDevolvido->converterUtf8($rowAnx),  'eventos' => $chequeDevolvido->converterUtf8($rowEve));

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

        $chequeDevolvido = new ChequeDevolvido();

        
        if($chequeDevolvido->insertAnexo($descricao, $extensao, $id, $idUsuario, $usuarioLogado)){

            $chequeDevolvido->uploadArquivo($temp, $extensao, $tabela, $localDeArmazenagem);
            $chequeDevolvido->insertEvento($evento, $id, $idUsuario, $usuarioLogado);
            $chequeDevolvido->updateUltimaAlteracao($id);

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
    $observacao = $chequeDevolvido->limpaObservacao(utf8_decode($_REQUEST['observacao']));
    $evento = 'Incluiu Observação';

    $chequeDevolvido = new ChequeDevolvido();

    if(
    $chequeDevolvido->insertObservacao($id, $idUsuario, $usuarioLogado, $observacao) == TRUE &&
    $chequeDevolvido->insertEvento($evento, $id, $idUsuario, $usuarioLogado )  == TRUE
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

        $chequeDevolvido = new ChequeDevolvido();

       if($chequeDevolvido->insertAnexo($descricao, $extensao, $id, $idUsuario, $usuarioLogado)){

        $chequeDevolvido->uploadArquivo($temp, $extensao, $tabela, $localDeArmazenagem);
        $chequeDevolvido->insertEvento($evento, $id, $idUsuario, $usuarioLogado);
        $chequeDevolvido->updateDataQuitacao($id, $status);
     
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

    $chequeDevolvido = new ChequeDevolvido();

    if($chequeDevolvido->updateStatus($id, $status)){
   

        $chequeDevolvido->insertEvento($evento, $id, $idUsuario, $usuarioLogado);
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

    $chequeDevolvido = new ChequeDevolvido();

    if($chequeDevolvido->updateStatus($id, $status)){

        $chequeDevolvido->insertEvento($evento, $id, $idUsuario, $usuarioLogado);
        $data = array('res' =>  'success', 'msg' => 'Alterado P/ PFIN com sucesso!');
   
    }else {

        $data = array('res' => 'error', 'msg' => 'Houve algum erro!');

    }

    echo json_encode($data);
}
}else{

    header("https://www.rdppetroleo.com.br/medwebnovo/?p=2");
    
  }