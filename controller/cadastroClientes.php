<?php
session_start();
include './controllerAux/validaLogin.php';
include './controllerAux/functionsAuxiliar.php';
include '../model/CadastroClientes.php';

$cadastroCliente = new CadastroCliente();

$action = $_REQUEST['action'];

if ($action == 'findAll') {

    $status1 = $_REQUEST['statusNovo'];
    $status2 = $_REQUEST['statusCadastrado'];
    $status3 = $_REQUEST['statusSerasa'];
    $status4 = $_REQUEST['statusCancelado'];

    $data1 = $_REQUEST['data1'];
    $data2 = $_REQUEST['data2'];

    $paginaAtual = ($_REQUEST['paginaAtual'] ? $_REQUEST['paginaAtual'] : '1');
    $resultadoPorPagina = 12;

    $start = ($paginaAtual * $resultadoPorPagina + 1) - $resultadoPorPagina;

    if ($status1 == '' && $status2 == '' && $status3 == '' && $status4 == '' ){
        $FStatus = "AND status IN ('CADASTRADO', 'NOVO', 'CANCELADO', 'CONFERIDO SERASA')";
    } else {
        $FStatus = "AND status IN ('$status1', '$status2', '$status3', '$status4')";
    }

    $FFilial = "AND loginName = '$usuarioLogado'";

    if ($data1 == '') { $data1 = '2015-01-01'; }
    if ($data2 == '') { $data2 = date("Y-m-d"); }
    $FData = "AND c.data_cadastro BETWEEN '$data1' AND '$data2'";
    
    $rows = $cadastroCliente->findAll($FStatus, $FFilial, $FData, $start, $resultadoPorPagina);

    $data = array('rows' => utf8ize($rows[1]), 'results' => utf8ize($rows[0]));

    echo json_encode($data);

}
if ($action == 'addCliente'){

    $razaosocial = strtoupper(limpaObservacao(utf8_decode($_REQUEST['cliente'])));
    $emailCliente = limpaObservacao(utf8_decode($_REQUEST['email']));
    $contato =  strtoupper(limpaObservacao(utf8_decode($_REQUEST['contato'])));
    $fone = $_REQUEST['fone'];
    $cnpj = $_REQUEST['cnpj'];
    $endereco = strtoupper(limpaObservacao(utf8_decode($_REQUEST['endereco'])));
    $bairro = strtoupper(limpaObservacao(utf8_decode($_REQUEST['bairro'])));
    $cidade = strtoupper(limpaObservacao(utf8_decode($_REQUEST['cidade'])));
    $uf = strtoupper(limpaObservacao(utf8_decode($_REQUEST['uf'])));
    $ie = $_REQUEST['ie'];
    $nomeUsual = strtoupper(limpaObservacao(utf8_decode($_REQUEST['nomeUsual'])));
    $idXpert = $_REQUEST['idXpert'];
    $cep = $_REQUEST['cep'];
    $numEndereco = $_REQUEST['numEndereco'];
    $complEndereco = strtoupper(limpaObservacao(utf8_decode($_REQUEST['complEndereco'])));
    $pessoa = $_REQUEST['pessoa'];
    $status = 'NOVO';
    $data_cadastro = date('Y-m-d');
    $formaPgtoPadrao = strtoupper(limpaObservacao(utf8_decode($_REQUEST['formaPgtoPadrao'])));
    $prazoPgto = strtoupper($_REQUEST['prazoPgto']);
    $prazoAbast = strtoupper($_REQUEST['prazoAbast']);
    $forma_pgto0 = ($_REQUEST['forma_pgto0'] ? $_REQUEST['forma_pgto0'] : '0');
    $forma_pgto1 = ($_REQUEST['forma_pgto1'] ? $_REQUEST['forma_pgto1'] : '0');
    $forma_pgto2 = ($_REQUEST['forma_pgto2'] ? $_REQUEST['forma_pgto2'] : '0');
    $forma_pgto3 = ($_REQUEST['forma_pgto3'] ? $_REQUEST['forma_pgto3'] : '0');
    $forma_pgto4 = ($_REQUEST['forma_pgto4'] ? $_REQUEST['forma_pgto4'] : '0');
    $forma_pgto5 = ($_REQUEST['forma_pgto5'] ? $_REQUEST['forma_pgto5'] : '0');
    $forma_pgto6 = ($_REQUEST['forma_pgto6'] ? $_REQUEST['forma_pgto6'] : '0');
    $forma_pgto7 = ($_REQUEST['forma_pgto7'] ? $_REQUEST['forma_pgto7'] : '0');
    $forma_pgto8 = ($_REQUEST['forma_pgto8'] ? $_REQUEST['forma_pgto8'] : '0');
    $forma_pgto9 = ($_REQUEST['forma_pgto9'] ? $_REQUEST['forma_pgto9'] : '0');
    $forma_pgtox = ($_REQUEST['forma_pgtox'] ? $_REQUEST['forma_pgtox'] : '0');
  
    if($cadastroCliente->insertCliente($razaosocial,$emailCliente,$contato,$fone,$cnpj,$endereco,$bairro,$cidade,$uf,$ie,$nomeUsual,$idXpert, $cep,
    $numEndereco,$complEndereco,$pessoa,$status,$data_cadastro,$formaPgtoPadrao,$prazoPgto,$prazoAbast,$forma_pgto0,
    $forma_pgto1,$forma_pgto2,$forma_pgto3,$forma_pgto4,$forma_pgto5,$forma_pgto6,$forma_pgto7,$forma_pgto8,$forma_pgto9,$forma_pgtox)) {

        $data = array('res' => 'success');

    } else {

        $data = array('res' => 'errorObs');
    }

    echo json_encode($data);
}