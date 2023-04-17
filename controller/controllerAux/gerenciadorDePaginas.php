<?php 
$p = $_REQUEST['p'];

$acao = $_REQUEST['acao'];

$pag[1] = 'view/chequesDevolvidos.view.php';
$pag[2] = 'view/chequesDevolvidos.view.php';
$pag[3] = 'view/depositos.view.php';
$pag[4] = 'view/caixaDiario.view.php';
$pag[5] = 'view/serasa.view.php';
$pag[6] = 'view/enviarMateriais.view.php';
$pag[7] = 'view/solicitacaoDePagamentos.view.php';
$pag[8] = 'view/modelosDeDocumentos.view.php';
$pag[9] = 'view/precosPraca.view.php';
$pag[10] = 'view/precosPracaAnalise.view.php';
$pag[11] = 'view/cadastroClientes.view.php';
$pag[12] = 'view/gpMetas.view.php';


if (!$p){  $p = 1; }

$active[$p] = 'active';

$regex = '/\/(.*?)\./';
preg_match_all($regex, $pag[$p], $resultado);
foreach($resultado[1] as $texto){}

include "view/partials/head/$texto.head.php";

include 'view/partials/sideMenu.php';

include "$pag[$p]"; 
