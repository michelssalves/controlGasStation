<?php
session_start();
$id = $_SESSION['id_u'];

require_once '../model/CreditoIpiranga.php';

$creditoIpiranga = new CreditoIpiranga();

$usuario = $creditoIpiranga->selectUserById($id);
//var_dump($usuario);
if ($usuario['nomeCompleto']) {

   /* $action = $_REQUEST['action'];

    if ($action == 'findAll') {

        $idGrupo = (intval($_REQUEST['idGrupo']) ? $_REQUEST['idGrupo'] : 5);
        $periodo = (intval($_REQUEST['periodo']) ? $_REQUEST['periodo'] : date('Y-m'));
        $gerencia = (intval($_REQUEST['gerencia'] === 0 ? '' : $_REQUEST['gerencia']));
        if ($gerencia) {
            $filtroGerencia = "AND gerenteRede = $gerencia";
        }

        if ($idGrupo == 1) {
            $campo = "qtde";
            $filtroGrupo = "AND id_grupo = 1";
            $filtroProduto = "AND id_grupo = 1";
        } //Combustiveis
        if ($idGrupo == 2) {
            $campo = "valor";
            $filtroGrupo = "AND id_grupo = 2";
            $filtroProduto = "AND id_grupo = 2";
        } //Lubrificantes
        if ($idGrupo == 6) {
            $campo = "qtde";
            $filtroGrupo = "AND id_grupo = 1";
            $filtroProduto = "AND id_produto IN (1,2,3)";
        } //Ciclo OTTO
        if ($idGrupo == 7) {
            $campo = "qtde";
            $filtroGrupo = "AND id_grupo = 1";
            $filtroProduto = "AND id_produto IN (4,5)";
        } //Diesel
        $ano = date('Y', strtotime($periodo));
        $mes = date('m', strtotime($periodo));
        $dia = "1";
        if ($idGrupo != 5) {

            $rows = $gpMetas->findOutros($idGrupo, $filtroGrupo, $filtroGerencia, $campo, $filtroProduto, $mes, $ano, $dia);
        } else {

            $rows = $gpMetas->findConveniencia($idGrupo, $filtroGerencia, $mes, $ano, $dia);
        }

        $data = array('rows' => $gpMetas->converterUtf8($rows));

        echo json_encode($data);
    }
    if ($action == 'findPeriodo') {

        $rows = $gpMetas->findPeriodo();

        $data = array('rows' => $gpMetas->converterUtf8($rows));

        echo json_encode($data);
    }*/
}else{

    header("https://www.rdppetroleo.com.br/medwebnovo/?p=12");
    
  }
