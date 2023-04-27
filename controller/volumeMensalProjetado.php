<?php
session_start();
$id = $_SESSION['id_u'];

require_once '../model/VolumeMensalProjetado.php';

$volumeMensalProjetado = new VolumeMensalProjetado();

$usuario = $volumeMensalProjetado->selectUserById($id);
//var_dump($usuario);
if ($usuario['nomeCompleto']) {

   $action = $_REQUEST['action'];


    if ($action == 'findPeriodo') {

        $rows = $gpMetas->findPeriodo();

        $data = array('rows' => $volumeMensalProjetado->converterUtf8($rows));

        echo json_encode($data);
    }
}else{

    header("https://www.rdppetroleo.com.br/medwebnovo/?p=12");
    
  }
