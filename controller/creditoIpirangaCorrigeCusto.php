<?php
session_start();
$id = $_SESSION['id_u'];

require_once '../model/CreditoIpirangaCorrigeCusto.php';

$corrigeCusto = new CorrigeCusto();

$usuario = $corrigeCusto->selectUserById($id);
//var_dump($usuario);
if ($usuario['nomeCompleto']) {

   $action = $_REQUEST['action'];

   if ($action == 'findAllCidadesOrigem') {

    $rows = $corrigeCusto->findAllCidadesOrigem();

    $data = array('rows' => $corrigeCusto->converterUtf8($rows));

    echo json_encode($data);
}
if ($action == 'findPeriodo') {

    $rows = $corrigeCusto->findPeriodo();

    $data = array('rows' => $corrigeCusto->converterUtf8($rows));

    echo json_encode($data);
}
if ($action == 'findAll') {

    $produto = ($_REQUEST['produto'] ? $_REQUEST['produto'] : '0');
    $origem = ($_REQUEST['cidade'] ? $_REQUEST['cidade'] : '0');
    $destino = ($_REQUEST['destino'] ? $_REQUEST['destino'] : '0');
    $dataInicio = ($_REQUEST['data1'] ? $_REQUEST['data1'] : date('Y-m-d', strtotime("-30 day", strtotime(date('Y-m-d')))));
    $dataFim = ($_REQUEST['data2'] ? $_REQUEST['data2'] : date('Y-m-d'));

    if ($produto <> '0') { $filtroProduto = "AND PI.IdProduto = $produto"; }
    if ($origem <> '0') { $filtroOrigem = "AND PI.IdEntidade = $origem "; }
    if ($destino <> '0') { $filtroDestino = "AND DESTINO = '$destino' "; }

    $filtroPeriodo = "AND PI.DATA BETWEEN '$dataInicio' AND '$dataFim'";

    $rows = $corrigeCusto->findAll($filtroProduto, $filtroOrigem, $filtroDestino, $filtroPeriodo);

    $data = array('rows' => $corrigeCusto->converterUtf8($rows));

    echo json_encode($data);
}
if ($action == 'updateFrete') {

    $p = ($_REQUEST['p']);
    $u = ($_REQUEST['u']);
    $f = ($_REQUEST['f']);
    $o = ($_REQUEST['o']);

    $rows = $corrigeCusto->updateFrete($p, $u, $o, $f);

    $data = array('rows' => $corrigeCusto->converterUtf8($rows));

    echo json_encode($data);
}
}else{

    header("https://www.rdppetroleo.com.br/medwebnovo/?p=12");
    
  }
