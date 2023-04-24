<?php 
session_start();

$index = $_REQUEST['p'];

$page[1] = 'view/chequesDevolvidos.view.php';
$page[2] = 'view/chequesDevolvidos.view.php';
$page[3] = 'view/depositos.view.php';
$page[4] = 'view/caixaDiario.view.php';
$page[5] = 'view/serasa.view.php';
$page[6] = 'view/enviarMateriais.view.php';
$page[7] = 'view/solicitacaoDePagamentos.view.php';
$page[8] = 'view/modelosDeDocumentos.view.php';
$page[9] = 'view/precosPraca.view.php';
$page[10] = 'view/precosPracaAnalise.view.php';
$page[11] = 'view/cadastroClientes.view.php';
$page[12] = 'view/gpMetas.view.php';
$page[13] = 'view/creditoIpiranga.view.php';
$page[14] = 'view/volumeMensalProjetado.view.php';
$page[15] = 'view/checkListAuditoria.view.php';

if(!$index){ $index = 1; }

$active[$index] = 'active';

$regex = '/\/(.*?)\./';

preg_match_all($regex, $page[$index], $resultado);

foreach($resultado[1] as $texto){}

include "view/partials/head/$texto.head.php";

include 'view/partials/sideMenu.php';

include "$page[$index]"; 

?>