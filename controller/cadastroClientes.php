<?php
session_start();
include './controllerAux/validaLogin.php';
include './controllerAux/functionsAuxiliar.php';
include '../model/CadastroClientes.php';

$cadastroCliente = new CadastroCliente();

$action = $_REQUEST['action'];

if ($action == 'dadosCadastrais') {

    $id = $_REQUEST['id'];

    $rows = $cadastroCliente->dadosCadastrais($id);

    $data = array('cadastro' => utf8ize($rows));

    echo json_encode($data);
}
if ($action == 'dadosFinanceiros') {

    $id = $_REQUEST['id'];

    $rows = $cadastroCliente->dadosFinanceiros($id);

    $data = array('financeiro' => utf8ize($rows));

    echo json_encode($data);
}
if ($action == 'dadosVeiculos') {

    $id = $_REQUEST['id'];

    $rows = $cadastroCliente->dadosVeiculos($id);

    $data = array('veiculos' => utf8ize($rows));

    echo json_encode($data);
}
if ($action == 'dadosDocumentos') {

    $id = $_REQUEST['id'];

    $rows = $cadastroCliente->dadosDocumentos($id);

    $data = array('anexos' => utf8ize($rows));

    echo json_encode($data);
}
if ($action == 'dadosObservacao') {

    $id = $_REQUEST['id'];

    $rows = $cadastroCliente->dadosObservacao($id);

    $data = array('observacoes' => utf8ize($rows));

    echo json_encode($data);
}
if ($action == 'dadosEventos') {

    $id = $_REQUEST['id'];

    $rows = $cadastroCliente->dadosEventos($id);

    $data = array('eventos' => utf8ize($rows));

    echo json_encode($data);
}
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
        $FStatus = "AND status IN ('NOVO', '', '', '')";
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
    $evento = 'CRIADO CLIENTE';
  
    if($cadastroCliente->insertCliente($razaosocial,$emailCliente,$contato,$fone,$cnpj,$endereco,$bairro,$cidade,$uf,$ie,$nomeUsual,$idXpert, $cep,
    $numEndereco,$complEndereco,$pessoa,$status,$data_cadastro,$formaPgtoPadrao,$prazoPgto,$prazoAbast,$forma_pgto0,
    $forma_pgto1,$forma_pgto2,$forma_pgto3,$forma_pgto4,$forma_pgto5,$forma_pgto6,$forma_pgto7)) {
        
        $id = $cadastroCliente->findLastId();

        $cadastroCliente->insertEvento($id, $usuarioLogado, $evento);

        $msg = "Cadastrado com Sucesso!";
        $data = array('res' => 'success', 'msg' => utf8ize($msg));

    } else {

        $msg = "Erro no Cadastrado!";
        $data = array('res' => 'error', 'msg' => utf8ize($msg));
  
    }

    echo json_encode($data);
}
if ($action == 'updateClienteCadastrais'){

    $id = $_REQUEST['id'];
    $razaosocial = strtoupper(limpaObservacao(utf8_decode($_REQUEST['cliente'])));
    $emailCliente = limpaObservacao(utf8_decode($_REQUEST['email']));
    $contato =  strtoupper(limpaObservacao(utf8_decode($_REQUEST['Contato'])));
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
    $evento = 'ALTERADO CLIENTE';
  
    if($cadastroCliente->updateClienteCadastral($id, $razaosocial,$emailCliente,$contato,$fone,$cnpj,$endereco,$bairro,$cidade,$uf,$ie,$nomeUsual,$idXpert, $cep,
    $numEndereco,$complEndereco,$pessoa)) {
        
        $cadastroCliente->insertEvento($id, $usuarioLogado, $evento);

        $msg = "Atualizado com Sucesso!";
        $data = array('res' => 'success', 'msg' => utf8ize($msg));

    } else {

        $msg = "Erro na atualização!";
        $data = array('res' => 'error', 'msg' => utf8ize($msg));
    }

    echo json_encode($data);
}
if ($action == 'updateClienteFinanceiro'){

    $id = $_REQUEST['id'];
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
    $desc_alcool = $_REQUEST['desc_alcool'];
    $desc_gasolina = $_REQUEST['desc_gasolina'];
    $desc_dieselS500 = $_REQUEST['desc_dieselS500']; 
    $desc_dieselS10 = $_REQUEST['desc_dieselS10'];
    $desc_gnv = $_REQUEST['desc_gnv'];
    $acr_alcool = $_REQUEST['acr_alcool'];
    $acr_gasolina = $_REQUEST['acr_gasolina'];
    $acr_dieselS500 = $_REQUEST['acr_dieselS500'];
    $acr_dieselS10 = $_REQUEST['acr_dieselS10']; 
    $acr_gnv = $_REQUEST['acr_gnv'];
    $evento = 'ALTERADO FINANCEIRO';

    if($cadastroCliente->updateClienteFinanceiro($id, $formaPgtoPadrao,$prazoPgto,$prazoAbast,$forma_pgto0,
    $forma_pgto1,$forma_pgto2,$forma_pgto3,$forma_pgto4,$forma_pgto5,$forma_pgto6,$forma_pgto7, $desc_alcool, 
    $desc_gasolina, $desc_dieselS500, $desc_dieselS10,$desc_gnv,$acr_alcool,$acr_gasolina,$acr_dieselS500, 
    $acr_dieselS10, $acr_gnv )) {
        
        $cadastroCliente->insertEvento($id, $usuarioLogado, $evento);

        $msg = "Atualizado com Sucesso!";
        $data = array('res' => 'success', 'msg' => utf8ize($msg));

    } else {

        $msg = "Erro na atualização!";
        $data = array('res' => 'error', 'msg' => utf8ize($msg));
    }

    echo json_encode($data);
}
if ($action == 'addObservacao'){

    $obs = strtoupper(limpaObservacao(utf8_decode($_REQUEST['observacao'])));
    $id = $_REQUEST['id'];
    $evento = 'INSERIU OBSERVAÇÃO';
  
    if($cadastroCliente->insertObservacao($id, $idUsuario,$obs)) {

        $cadastroCliente->insertEvento($id, $usuarioLogado, $evento);

        $msg = "Adiconado Observação!";
        $data = array('res' => 'success', 'msg' => utf8ize($msg));

    } else {

        $msg = "Erro na observação!";
        $data = array('res' => 'error', 'msg' => utf8ize($msg));
    }

    echo json_encode($data);
}
if ($action == 'addAnexo') {

    $id = $_REQUEST['id'];
    $descricao = limpaObservacao(utf8_decode($_REQUEST['descricaoAnexo']));
    $evento = 'INCLUSÃO DE ANEXO';

    if ($_FILES['file']['name'] <> '') {

        $extensao = strtolower(end(explode('.', $_FILES['file']['name'])));

        if ($cadastroCliente->insertAnexo($descricao, $id, $extensao, $usuarioLogado)) {

            $temp = $_FILES['file']['tmp_name'];
            $localDeArmazenagem = "../assets/docs/docCliente/";
            $tabela = "med_cliente_documento";

            if(uploadArquivo($temp, $extensao, $tabela, $localDeArmazenagem)){
            
                $cadastroCliente->insertEvento($id, $usuarioLogado, $evento);

                $msg = "Anexado Com sucesso!";
                $data = array('res' => 'success', 'msg' => utf8ize($msg));

            } else {
                
                $msg = "Erro no upload do arquivo!";
                $data = array('res' => 'error', 'msg' => utf8ize($msg));
            }
        } else {

            $msg = "Erro ao registrar anexo na tabela!";
            $data = array('res' => 'error', 'msg' => utf8ize($msg));
        }
    } else {

        $msg = "Não foi adicionado anexo!";
        $data = array('res' => 'error', 'msg' => utf8ize($msg));
    }

    echo json_encode($data);
}
if ($action == 'addVeiculo'){

    $marca = strtoupper(limpaObservacao(utf8_decode($_REQUEST['marca'])));
    $modelo = strtoupper(limpaObservacao(utf8_decode($_REQUEST['modelo'])));
    $ano = utf8_decode($_REQUEST['ano']);
    $cor = strtoupper(limpaObservacao(utf8_decode($_REQUEST['cor'])));
    $placa = strtoupper(limpaObservacao(utf8_decode($_REQUEST['placa'])));
    $km = utf8_decode($_REQUEST['km']);
    $combustivel = utf8_decode($_REQUEST['combustivel']);
    $desconto = utf8_decode($_REQUEST['desconto']);
    $id = $_REQUEST['id'];

    if($cadastroCliente->insertVeiculo($placa, $marca, $modelo, $ano, $km, $combustivel, $desconto, $cor, $id)) {

        $msg = "Cadastrado com sucesso!";
        $data = array('res' => 'success', 'msg' => utf8ize($msg));

    } else {

        $msg = "Erro ao adicionar o veiculo!";
        $data = array('res' => 'error', 'msg' => utf8ize($msg));
    }

    echo json_encode($data);
}