<?php
session_start();
include './controllerAux/validaLogin.php';
include './controllerAux/functionsAuxiliar.php';
include '../model/ModelosDeDocumentos.php';

$action = $_REQUEST['action'];

if ($action == 'findAll') {

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

  $data = array('rows' => utf8ize($link));

  echo json_encode($data);
}
