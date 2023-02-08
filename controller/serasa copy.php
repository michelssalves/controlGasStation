<?php
$action = $_REQUEST['action'];

if ($action == 'solicitarPfin') {

    $descricaoAnexo = "FATURAS";
    $status = "NOVO";
    $tipoDoc = $_REQUEST['tipoDoc'];
    $cnpj = $_REQUEST['cnpj'];
    $valor = virgulaParaPonto($_REQUEST['valor']);
    $valorJuros = $valor * 1.03;
    $id_med = $_REQUEST['id_med'];
    $nomeCliente = limpaObservacao($_REQUEST['nomeCliente']);
    $endereco = $_REQUEST['endereco'];
    $estado = $_REQUEST['estado'];
    $cidade = $_REQUEST['cidade'];
    $bairro = $_REQUEST['bairro'];
    $numero = $_REQUEST['numero'];
    $cep = $_REQUEST['cep'];
    $obs = limpaObservacao($_REQUEST['obs']);
    $dataEmissao = ($_REQUEST['dataEmissao'] <> '' ? $_REQUEST['dataEmissao'] : '2000-01-01');
    $dataVencimento = ($_REQUEST['dataVencimento'] <> '' ? $_REQUEST['dataVencimento'] : '2000-01-01');
    $dataNascimento = ($_REQUEST['dataNascimento'] <> '' ? $_REQUEST['dataNascimento'] : '2000-01-01');
    $matriz = '1';

    if ($_SESSION['login'] == "SUPORTE") {

        insertSerasaGerencia($cnpj, $tipoDoc, $nomeCliente, $status, $valor, $obs, $valorJuros, $dataEmissao, $dataVencimento, $id_med, $dataNascimento, $endereco, $matriz, $estado, $cidade, $bairro, $numero, $cep);
    } else {

        insertSerasaOperacional($cnpj, $tipoDoc, $nomeCliente, $status, $valor, $obs, $valorJuros, $dataEmissao, $dataVencimento, $id_med, $dataNascimento, $endereco, $estado, $cidade, $bairro, $numero, $cep);
    }

    $idFechamentoCaixaAnexo = 1500;
    for ($i = 1; $i <= 5; $i++) {

        if ($_FILES["arquivo$i"]['name'] <> '') {

            $numDoc = $_REQUEST["numDoc$i"];

            $tabela = 'ccp_serasa';
            $campo = 'id_requisicao';
            $id_requisicao =  selectUltimoId($tabela, $campo);

            $extensao = strtolower(end(explode('.', $_FILES["arquivo$i"]['name'])));

            insertSerasaAnexo($id_requisicao, $numDoc, $descricaoAnexo, $extensao);

            $temp = $_FILES["arquivo$i"]['tmp_name'];
            $localDeArmazenagem = "assets/docs/serasa/";
            $tabela = 'ccp_serasa_anexo';

            uploadArquivo($temp, $extensao, $tabela, $localDeArmazenagem);
        }
    }
    $evento = "SOLICITAÇÃO DE PEFIN";

    insertSerasaEventos($id_requisicao, $evento, $usuarioLogado);
}
if ($action == 'gravarObservacao') {

    $id_requisicao = $_REQUEST['id_requisicao'];
    $observacao = limpaObservacao($_REQUEST['observacao']);

    insertSerasaObs($id_requisicao, $usuarioLogado, $observacao);
}
if ($action == 'gravarAnexo') {

    $id_requisicao = $_REQUEST['id_requisicao'];
    $numDoc = $_REQUEST['numDoc'];
    $descricaoAnexo = "ANEXO";
    $temp = $_FILES['file']['tmp_name'];
    $localDeArmazenagem = "assets/docs/serasa/";
    $tabela = 'ccp_serasa_anexo';
    $evento = "ADICIONOU UM ANEXO";

    insertSerasaEventos($id_requisicao, $evento, $usuarioLogado);

    if ($_FILES['file']['name'] <> '') {

        $extensao = strtolower(end(explode('.', $_FILES['file']['name'])));

        insertSerasaAnexo($id_requisicao, $numDoc, $descricaoAnexo, $extensao);

        uploadArquivo($temp, $extensao, $tabela, $localDeArmazenagem);
    }
}
if ($action == 'alterarStatus') {

    if ($_FILES['file']['name'] <> '') {

        if ($_REQUEST['statusAcao'] == '1') {

            $numDoc = 'EXCLUSÃO DO SPC';
            $status = 'PAGO';
            $descricaoAnexo = "COMPROVANTE DE PAGAMENTO";
            $evento = "ALTEROU O STATUS PARA PAGO";
        }
        if ($_REQUEST['statusAcao'] == '2') {

            $numDoc = 'INCLUSÃO NO SPC';
            $status = 'PEFIN';
            $descricaoAnexo = "DOC. BAIXA";
            $evento = "ALTEROU O STATUS PARA PEFIN";
        }

        $id_requisicao = $_REQUEST['id_requisicao'];

        if ($_REQUEST['statusAcao'] == '3') {

            $numDoc = 'BAIXADO';
            $status = 'BAIXADO';
            $descricaoAnexo = "DOC. BAIXA";
            $evento = "ALTEROU O STATUS PARA BAIXADO";
        }
        if ($_REQUEST['statusAcao'] == '4') {

            $numDoc = 'CANCELADO';
            $status = 'CANCELADO';
            $descricaoAnexo = "DOC. CANCELAMENTO";
            $evento = "CANCELOU A REQUISIÇÃO";
        }

        updateSerasa($status, $id_requisicao);

        insertSerasaEventos($id_requisicao, $evento, $usuarioLogado);

        $temp = $_FILES['file']['tmp_name'];
        $localDeArmazenagem = "assets/docs/serasa/";
        $tabela = 'ccp_serasa_anexo';

        $extensao = strtolower(end(explode('.', $_FILES['file']['name'])));

        insertSerasaAnexo($id_requisicao, $numDoc, $descricaoAnexo, $extensao);

        uploadArquivo($temp, $extensao, $tabela, $localDeArmazenagem, $idFechamentoCaixaAnexo);
    }
}
if ($action == 'filtrar-serasa') {

    $page =  $_REQUEST['page'];
    $statusPefin =  $_REQUEST['statusPefin'];
    $statusNovo =  $_REQUEST['statusNovo'];
    $statusPago =  $_REQUEST['statusPago'];
    $statusBaixado =  $_REQUEST['statusBaixado'];
    $statusCancelado =  $_REQUEST['statusCancelado'];
    $med =  $_REQUEST['med'];
    $matriz =  $_REQUEST['matriz'];
    $tipo =  $_REQUEST['tipo'];
    $cliente =  $_REQUEST['nomeCliente'];

    if ($matriz == 'Matriz') {
        $Fmatriz = " AND matriz = 1 ";
    }
    if ($matriz == 'Meds') {
        $Fmatriz = " AND matriz = 0 ";
    }
    if (isset($med) && $med <> '0') {
        $Fmed = "AND id_med = '$med' ";
    }
    if (isset($tipo) && $tipo <> 'Tipo') {
        $Ftipo = " AND tipo LIKE '%$tipo%' ";
    }
    if (isset($cliente) && $cliente <> '') {
        $Fcliente = " AND nomeCliente LIKE '%$cliente%' ";
    }
    if ($statusPefin == '' && $statusNovo == '' && $statusPago == '' && $statusBaixado == '' && $statusCancelado == '') {
        $Fstatus =  "AND status = 'PEFIN'";
    } else {
        $Fstatus =  "AND status IN ('" . $statusNovo . "','" . $statusPefin . "','" . $statusPago . "','" . $statusBaixado . "','" . $statusCancelado . "')";
    }

    $txtTable = filtrarSerasa($Fstatus, $Fmatriz, $Fmed, $Ftipo, $Fcliente, $page);
}
if ($action <> 'filtrar-serasa') {

    $page =  $_REQUEST['page'];

    if ($statusPefin == '' && $statusNovo == '' && $statusPago == '' && $statusBaixado == '' && $statusCancelado == '') {
        $Fstatus =  "AND status = 'PEFIN'";
    } else {
        $Fstatus =  "AND status IN ('" . $statusNovo . "','" . $statusPefin . "','" . $statusPago . "','" . $statusBaixado . "','" . $statusCancelado . "')";
    }

    $txtTable = filtrarSerasa($Fstatus, $Fmatriz, $Fmed, $Ftipo, $Fcliente, $page);
}

include 'view/modal/serasa/serasaAcoesRequisicao.view.php';
include 'view/modal/serasa/serasaCriarPfin.view.php';
include 'view/modal/serasa/serasaIncluirObservacao.view.php';
include 'view/modal/serasa/serasaIncluirAnexo.view.php';


