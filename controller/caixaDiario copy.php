<?php 
session_start();
include './controllerAux/validaLogin.php';
include './controllerAux/vetoresAuxiliares.php';
include './controllerAux/functionsAuxiliar.php';
include '../model/CaixaDiario.php';

$action = $_REQUEST['action'];

if($action == 'editarModal'){

    //quando é realizado um requisiçao ajax precisa ser incluido no escopo 
    include '../model/CaixaDiario.php';
    include '../controller/controllerAux/functionsAuxiliar.php';

    $id_requisicao = $_REQUEST['id'];
  
    $row = selectCaixaDiarioById($id_requisicao);

    $return = ['dados' =>  utf8ize($row)];

    echo json_encode($return);

}
if($action  == 'salvarAlteracoes'){

    $id_requisicao = $_REQUEST['id_requisicao'];
    $obs = limpaObservacao($_REQUEST['obs']);
    $caixa = $_REQUEST['caixa'];
    $conc = $_REQUEST['conc'];
    $turnos_definitivo = $_REQUEST['turnos_definitivo'];
    $data_caixa = $_REQUEST['data_caixa'];
    $dep_brinks = $_REQUEST['dep_brinks'];
    $dep_cheque = $_REQUEST['dep_cheque'];
    $dep_dinheiro = $_REQUEST['dep_dinheiro'];

    $row = selectCaixaDiarioLastId($id_requisicao);
 
    updateCaixaDiarioAlteracao($id_requisicao, $dep_dinheiro, $dep_cheque, $dep_brinks, $data_caixa, $turnos_definitivo,$conc, $caixa, $obs);

    $obs = "<b>Alterou o caixa para:</b> <br>
    Depósito Dinheiro: $dep_dinheiro <br>
    Depósito Cheque: $dep_cheque <br>
    Depósito Brinks: $dep_brinks <br>
    Turnos definitivo: $turnos_definitivo <br>
    Observações: $obs <br>
    <br>
    <b>Antes os campos eram:</b> <br>
    Depósito Dinheiro: ".$row['dep_dinheiro']."  <br>
    Depósito Cheque: ".$row['dep_cheque']." <br>
    Depósito Brinks: ".$row['dep_brinks']." <br>
    Turnos definitivo: ".$row['turnos_definitivo']." <br>
    Observações: ".$row['obs']."<br>";

    insertCaixaDiarioObs($id_requisicao, $usuarioLogado, $obs);
}
if($action == 'fecharCxDiario' && $_REQUEST['concBancariaSim'] == 'on' &&  $_REQUEST['fechamentoSim'] == 'on'){

    $id_requisicao = $_REQUEST['id_requisicao'];
    $obs = 'ALTEROU O STATUS PARA FECHADO';
    $status = 'FECHADO';
    $confirmarConciliacao = "'concBancaria = 'SIM', fechaCaixa = 'SIM',";

    updateCaixaDiario($id_requisicao, $status, $confirmarConciliacao);

    insertCaixaDiarioObs($id_requisicao, $usuarioLogado, $obs);

}
if($action == 'abrirCxDiario'){

    $status = 'ABERTO';
    $id_requisicao = $_REQUEST['id_requisicao'];
    $obs = 'ALTEROU O STATUS PARA ABERTO';

    updateCaixaDiario($id_requisicao, $status, $confirmarConciliacao);

    insertCaixaDiarioObs($id_requisicao, $usuarioLogado, $obs);
}
if($action == 'reabrirCxDiario'){

    $id_requisicao = $_REQUEST['id_requisicao'];
    $status = 'ABERTO';
    $obs = 'REABRIU O CAIXA';

    updateCaixaDiario($id_requisicao, $status, $confirmarConciliacao);

    insertCaixaDiarioObs($id_requisicao, $usuarioLogado, $obs);

}
if($action == 'cancelarCaixa'){

    $id_requisicao  = $_REQUEST['id_requisicao'];
    $obs = 'ALTEROU O STATUS PARA CANCELADO';
    $status = 'CANCELADO';

    updateCaixaDiario($id_requisicao, $status, $confirmarConciliacao);

    insertCaixaDiarioObs($id_requisicao, $usuarioLogado, $obs);
 
}
if($action == 'gravarObservacao'){

    $obs = limpaObservacao($_REQUEST['observacao']);
    $id_requisicao = $_REQUEST['id_requisicao'];

    insertCaixaDiarioObs($id_requisicao, $usuarioLogado, $obs);

}
if($action == 'gravarAnexo'){

    $descricao = $_REQUEST['descricao'];
    $id_requisicao = $_REQUEST['id_requisicao'];

    if($_FILES['file']['name'] <> ''){

    $extensao = strtolower(end(explode('.', $_FILES['file']['name'])));

    insertCaixaDiarioAnexo($id_requisicao, $descricao, $extensao);

    $temp = $_FILES['file']['tmp_name'];
    $localDeArmazenagem = "assets/docs/fechamentoCaixa/";
    $tabela = "ccp_fechamentoCaixa_anexo";

    uploadArquivo($temp, $extensao, $tabela, $localDeArmazenagem);

    }

}
if($action == 'listar-tabela' || $action == ''){
    
    include '../model/CaixaDiario.php';

    $model = new Model();
 
    $rows = $model->findAll();
 
    $data = array('rows' => $rows);
 
    echo json_encode($data);

   /*     include 'view/modal/caixaDiario/caixaDiarioVisualizar.view.php';   
        include 'view/modal/caixaDiario/caixaDiarioIncluirObservacao.view.php';   
        include 'view/modal/caixaDiario/caixaDiarioIncluirAnexo.view.php';   
        include 'view/modal/caixaDiario/caixaDiarioEditar.view.php';   */
}
if($action == 'visualizarCaixaDiario'){

    $id = $_REQUEST['id'];

    $row = selectCaixaDiarioById($id);

    $txtTabAnexos = selectCaixaDiarioAnexos($id);

    $tabelaEventos = selectCaixaDiarioEventos($id);

    $return = ['dados' => utf8ize($row), 'tabelaAnexos' => utf8ize($txtTabAnexos), 'tabelaEventos' => utf8ize($tabelaEventos)];

    echo json_encode($return);

}
