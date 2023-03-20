<?php
session_start();
include './controllerAux/validaLogin.php';
include './controllerAux/functionsAuxiliar.php';
include '../model/CadastroClientes.php';

$action = $_REQUEST['action'];
