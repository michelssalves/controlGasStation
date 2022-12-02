<?php 

$p = $_REQUEST['p'];

$acao = $_REQUEST['acao'];

$pag[0] = 'login.php';
$pag[1] = 'controladores.class.php';
$pag[2] = 'assets/class/chequesDevolvidos.class.php';
$pag[3] = 'agenda.php';
$pag[4] = 'licencas.php';
$pag[5] = 'classes.php';
$pag[6] = 'email.php';
$pag[7] = 'usuarios.php';
$pag[8] = 'criarChave.php';

if (!$p) 
{ 
	$p = 1; 
}

$active[$p] = 'active';

include ('menu.php');
include "$pag[$p]"; 
