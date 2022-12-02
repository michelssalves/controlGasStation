<?php 

$p = $_REQUEST['p'];

$acao = $_REQUEST['acao'];

$pag[0] = 'login.php';
$pag[1] = 'controladores.class.php';
$pag[2] = 'assets/class/controladores.class.php';
$pag[3] = 'agenda.php';
$pag[4] = 'licencas.php';
$pag[5] = 'classes.php';
$pag[6] = 'email.php';
$pag[7] = 'usuarios.php';
$pag[8] = 'criarChave.php';

$titulo[1] = '<i class="fa fa-file-pdf-o" ></i> Documentos';
$titulo[2] = '<i class="fa fa-users" ></i> Clientes ';
$titulo[3] = '<i class="fa fa-calendar" ></i> Agenda';
$titulo[4] = '<i class="fa fa-edit" ></i> Licenças';
$titulo[5] = '<i class="fa fa-database" ></i> Classes';
$titulo[6] = '<i class="fa fa-envelope" ></i> Email';
$titulo[7] = '<i class="fa fa-users" ></i> Usuarios';
$titulo[8] = '<i class="fa fa-unlock" ></i> Gerar Chave BioDigital';


if (!$p) 
{ 
	$p = 1; 
}

$active[$p] = 'active';

include ('menu.php');
include "$pag[$p]"; 
