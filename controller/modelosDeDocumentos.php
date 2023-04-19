<?php
session_start();
$id = $_SESSION['id_u'];

require_once '../model/ModelosDeDocumentos.php';

$modelosDeDocumento = new ModelosDeDocumento();

$usuario = $modelosDeDocumento->selectUserById($id);
//var_dump($usuario);
if ($usuario['nomeCompleto']) {
  $action = $_REQUEST['action'];

  if($action == 'findAll') {

    $fileList = glob('../assets/docs/modelosDeDocumentos/*.*');
    $name = 'name';
    $endereco= 'endereco';
    $lk= 'link';
    $x = 0;

    foreach ($fileList as $filename) {
    
        $x++;
        $link[$x][$endereco] =  $filename;
        $link[$x][$name] =  str_replace('../assets/docs/modelosDeDocumentos/', '', $filename);
        $nomeArquivo = str_replace('../assets/docs/modelosDeDocumentos/', '', $filename);
        $link[$x][$lk] = "https://www.rdppetroleo.com.br/medwebnovo/assets/docs/modelosDeDocumentos/$nomeArquivo";
    }

    $data = array('rows' => $modelosDeDocumento->converterUtf8($link));

    echo json_encode($data);
  }
}else{

  header("https://www.rdppetroleo.com.br/medwebnovo/?p=8");
  
}

