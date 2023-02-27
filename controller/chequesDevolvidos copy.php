<?php

$action = $_REQUEST['action'];

if ($action == 'incluir-cheque') {

    $idMed = $_REQUEST['idMed'];
    $codigoBanco = $_REQUEST['codigoBanco'];
    $rzSocialCheque = $_REQUEST['rzSocialCheque'];
    $rzSocialCliente = $_REQUEST['rzSocialCliente'];
    $telefone = $_REQUEST['telefone'];
    $nrCheque = $_REQUEST['nrCheque'];
    $valor = $_REQUEST['valor'];
    $motivo = $_REQUEST['motivo'];
    $dataCheque = $_REQUEST['dataCheque'];
    $dataDevol = $_REQUEST['dataDevol'];
    $cpfcnpj = $_REQUEST['cpfcnpj'];
    $evento = 'Incluído no Sistema';

    $row = selectMedCadatrosGerentesByMed($idMed);
    $emailGerentePosto = $row[0];
    $nomeGerentePosto = $row[1];
    $emailGerenteRede = $row[2];
    $nomeGerenteRede = $row[3];

    $idCheque = insertNovoChequeDevolvido($codigoBanco, $rzSocialCheque, $rzSocialCliente, $telefone, $nrCheque, $valor, $motivo, $dataCheque, $dataDevol, $cpfcnpj, $idMed, $idUsuario, $usuarioLogado, $evento);

    if ($_FILES['chequeFrente']['name'] <> '' && $_FILES['chequeVerso']['name'] <> '') {

        $extensao = strtolower(end(explode('.', $_FILES['chequeFrente']['name'])));
        $temp = $_FILES['chequeFrente']['tmp_name'];
        $descricao = 'CHEQUE FRENTE';
        $localDeArmazenagem = "assets/docs/chequesDevolvidos/";
        $tabela = "ccp_chequeDevAnexo";

        insertChequeDevolvidoAnexo($descricao, $extensao, $idCheque, $idUsuario, $usuarioLogado);

        uploadArquivo($temp, $extensao, $tabela, $localDeArmazenagem);

        $extensao = strtolower(end(explode('.', $_FILES['chequeVerso']['name'])));
        $temp = $_FILES['chequeVerso']['tmp_name'];
        $descricao = 'CHEQUE VERSO';

        insertChequeDevolvidoAnexo($descricao, $extensao, $idCheque, $idUsuario, $usuarioLogado);

        if (uploadArquivo($temp, $extensao, $tabela, $localDeArmazenagem)) {

            $assunto = 'NOTIFICAÇÃO DE CHEQUE DEVOLVIDO Nº ' . $idCheque . " - Cliente: " . $rzSocialCheque;
            $mensagemHTML = '
                            <table align="center" width="100%">
                                <tr>
                                    <td align="center">
                                     <table id="table-1" width="760" >
                                        <tr align="left" bgcolor="#006633">
                                          <td height="20" colspan="3" align="right" bgcolor="#FFFFFF"><div align="center"><img src="assets/img/logos/topo-rdp-petroleo.png" alt="RDP"><p></div>
                                  </td>
                                </tr>
                                <tr align="center"><td colspan = "2"><h2>NOTIFICAÇÃO DE CHEQUE DEVOLVIDO Nº ' . $idCheque . '<br>
                                <tr align="center"><td colspan = "2"><h2><hr></td></tr>	
                                <tr ><td width="200">Data/Hora Registro.:</td><td>' . date('Y-m-d H:i:s') . '</td></tr>
                                <tr ><td>Destinatários.:</td><td>' . $nomeGerentePosto . ' (' . $emailGerentePosto . ')</td></tr>
                                <tr ><td>&nbsp;</td><td >' . $nomeGerenteRede . ' (' . $emailGerenteRede . ')</td></tr>
                        
                                <tr ><td colspan="2">&nbsp;</td></tr>
                                <tr ><td colspan="2">Um cheque de cliente da sua unidade foi devolvido, algumas ações são necessárias para regularizar esta situação.</td></tr>
                                <tr ><td colspan="2">Para visualizar em detalhes este incidente vá até o site da <a href="https://www.rdppetroleo.com.br">RDP Petroleo</a>,clique em Intranet, depois clique em <b>"Controle Financeiro Mediterrâneo"</b> <p>Qualquer duvida entre em contato com o Suporte na Matriz dos Postos Mediterrâneo em Curitiba (41) 3254-5330</td></tr>
                            </table>';

            enviarEmail($assunto, $mensagemHTML);
        }
    }
}
//QUITACAO DO CHEQUE OU PFIN-> NÃO FOI CRIADO FORM PARA PFIN POR NAO COMPREENDER O ESCOPO, POREM O BACKEND É O MESMO DO QUITAÇÃO
if ($action == 'quitacao' || $action == 'pendenciaFinanceira' || $action == 'cancelar-cheque') {

    $idCheque = $_REQUEST['id'];

    if ($action == 'quitacao') {
        $status = "status = 'QUITADO',";
        $evento = 'Confirmada Quitação';
    }
    if ($action == 'pendenciaFinanceira') {

        $status = "status = 'PFIN',";
        $evento = 'Incluido em PFIN (Serasa/SPC)';
    }
    if ($action == 'cancelar-cheque') {

        $status = "status = 'CANCELADO',";
        $evento = 'CANCELADO';
    }

    if ($status <> '' && $evento <> '') {

        updateChequeDevolvidoById($status, $idCheque);
        insertChequeDevolvidoEvento($evento, $idCheque, $idUsuario, $usuarioLogado);
    }
    if ($_REQUEST['motivo'] <> '') {

        $observacao = limpaObservacao($_REQUEST['motivo']);
        insertChequeDevolvidoObersevacao($idCheque, $idUsuario, $usuarioLogado, $observacao);
    }

    if ($_FILES['file']['name'] <> '') {

        $extensao = strtolower(end(explode('.', $_FILES['file']['name'])));
        $temp = $_FILES['file']['tmp_name'];
        $localDeArmazenagem = "../assets/docs/chequesDevolvidos/";
        $tabela = "ccp_chequeDevAnexo";

        uploadArquivo($temp, $extensao, $tabela, $localDeArmazenagem);
    }
}
//GRAVAR ANEXO
if ($action == 'gravarAnexo') {

    $idCheque = $_REQUEST['id'];
    $descricao = limpaObservacao($_REQUEST['descricao']);
    $evento = 'Incluiu Anexo';

    if ($_FILES['file']['name'] <> '') {

        if ($descricao == '') {

            $descricao = $_FILES['file']['name'];
        }

        $extensao = strtolower(end(explode('.', $_FILES['file']['name'])));
        $temp = $_FILES['file']['tmp_name'];
        $localDeArmazenagem = "../assets/docs/chequesDevolvidos/";
        $tabela = "ccp_chequeDevAnexo";

        insertChequeDevolvidoAnexo($descricao, $extensao, $idCheque, $idUsuario, $usuarioLogado);

        uploadArquivo($temp, $extensao, $tabela, $localDeArmazenagem);

        updateChequeDevolvidoById($status = "", $idCheque);

        insertChequeDevolvidoEvento($evento, $idCheque, $idUsuario, $usuarioLogado);
    } else {
        echo 'Houve algum erro, tente refazer o processo';
    }
}
//GRAVAR OBS E NOTIFICAR POR EMAIL             
if ($action == 'gravarObservacao') {

    $idCheque = $_REQUEST['id'];
    $observacao = limpaObservacao($_REQUEST['obs']);
    $evento = 'Incluiu Observação';
    $email =  $_REQUEST['email'];

    insertChequeDevolvidoObersevacao($idCheque, $idUsuario, $usuarioLogado, $observacao);

    insertChequeDevolvidoEvento($evento, $idCheque, $idUsuario, $usuarioLogado);

    if ($email == 'true') {

        $assunto = 'Atualização no Cheque Devolvido Nº ' . $idCheque;
        $mensagemHTML = ' 
            <table align="center" width="100%">
                        <tr>
                            <td align="center">
                            <table id="table-1" width="760" >
                                <tr align="left" bgcolor="#006633">
                                <td height="20" align="right" bgcolor="#FFFFFF"><div align="center"><img src="https://www.rdppetroleo.com.br/medwebnovo/assets/img/logos/topo-rdp-petroleo.png" alt="RDP"><p></div>
                            </td>
                        </tr>
                        <tr align="center"><td><h2>UM REGISTRO DE CHEQUE DEVOLVIDO Nº ' . $idCheque . ' DE SUA UNIDADE RECEBEU ATUALIZAÇÃO<br>
                        <tr align="center"><td ><h2><hr></td></tr>	
                        <tr><td><h3>Detalhe: ' . $observacao . '<h3></td></tr>
                        <tr align="center"><td ><hr><a href="https://www.rdppetroleo.com.br">Clique aqui e acesse o site da RDP para maiores detalhes </a><hr></td></tr>
                        </table>';

        enviarEmail($assunto, $mensagemHTML);
    }
}
if ($action == 'visualizarCheque') {

    $idCheque = $_REQUEST['id'];

    $row = selectChequeDevolvidosById($idCheque);
    extract($row);
    $txtTable .= "<table class='table table-sm table-bordered border-dark'>
    <input type='hidden' id='idCheque' value='$idCheque'>
    <tr>
      <th colspan='2'>STATUS</th>
      <td colspan='3'>$status</td>
    </tr>
    <tr>
      <th colspan='2'>DT INC</th>
      <td colspan='3'>" . dma($dthrInclusao) . "</td>
    </tr>
    <tr>
      <th colspan='2'>MED</th>
      <td colspan='3'>$usuarioLogado</td>
    </tr>
    <tr>
      <th colspan='2'>BANCO</th>
      <td colspan='3'>$bco - $vetorBanco[$bco]</td>
    </tr>
    <tr>
      <th colspan='2'>CORRENTISTA</th>
      <td colspan='3'>$nome</td>
    </tr>
    <tr>
      <th colspan='2'>CLIENTE</th>
      <td colspan='3'>$nomeCliente</td>
    </tr>
    <tr>
      <th colspan='2'>CPF/CNPJ</th>
      <td colspan='3'>$cpfcnpj</td>
    </tr>
    <tr>
      <th colspan='2'>TELEFONE</th>
      <td colspan='3'>$telefone</td>
    </tr>
    <tr>
      <th colspan='2'>VALOR</th>
      <td colspan='3'>" . v2($valor) . "</td>
    </tr>
    <tr>
      <th colspan='2'>Nº CHEQUE</th>
      <td colspan='3'>$nrcheque</td>
    </tr>
    <tr>
      <th colspan='2'>MOTIVO</th>
      <td colspan='3'>$motivo - $vetorMotivo[$motivo]</td>
    </tr>
    <tr>
      <th colspan='2'>DT CHEQUE</th>
      <td colspan='3'>" . dma($dtCheque) . "</td>
    </tr>
    <tr>
      <th colspan='2'>DT DEV</th>
      <td colspan='3'>" . dma($dtDevol) . "</td>
    </tr>
    <tr>
      <th colspan='2'>DT QUIT</th>
      <td colspan='3'>" . dma($dtQuitacao) . "</td>
    </tr>
    <tr>
      <th colspan='2'>PDV</th>
      <td colspan='3'>$pdv</td>
    </tr>
    </table>
    <table class='table table-sm table-bordered border-dark'>
    <tr>
      <th colspan='2'>Data Hora</th>
      <th>Usuário</th>
      <th colspan='2'>Observação</th>
    </tr>";

    $qryObs = selectChequeObsById($idCheque);
    while ($rowObs = odbc_fetch_array($qryObs)) {
        extract($rowObs);

        $txtTable .= "<tr>
            <td colspan='2'>" . dmaH($datahora) . "</td>
            <td>$usuario</td>
            <td colspan='2'>$obs</td>
        </tr>";
    }

    $txtTable .= "
    </table>
    <table class='table table-sm table-bordered border-dark'>
      <tr>
        <th colspan='2'>Data Hora</th>
        <th>Usuário</td>
        <th>Descrição/Nome</th>
        <th>Tipo</th>
      </tr>";

    $qryAnexo = selectChequeAnexoById($idCheque);

    while ($rowAnexo = odbc_fetch_array($qryAnexo)) {

        extract($rowAnexo);

        $link2 = "'https://www.rdppetroleo.com.br/medwebnovo/view/modal/visualizarDocumentosModal.view.php?doc=$id.$tipo&pasta=chequesDevolvidos'";

        $txtTable .= "<tr>
            <td colspan='2'>" . dmaH($datahora) . "</td>
            <td>$usuario</td>
            <td><a style='cursor:pointer' onclick='abriNovaJanela($link2)'>$descricao</td>
            <td>$tipo</td>
        </tr>";
    }

    $txtTable .= "</table>
    <table class='table table-sm table-bordered border-dark'>
    <tr>
    <th colspan='2'>Data Hora</th>
    <th>Usuário</th>
    <th colspan='2'>Descrição</th>
    </tr>";

    $qryEventos = selectChequeEventos($idCheque);
    while ($rowEventos = odbc_fetch_array($qryEventos)) {

        extract($rowEventos);

        $txtTable .= "<tr>
            <td colspan='2'>" . dmaH($dthrEvento) . "</td>
            <td>$usuario</td>
            <td colspan='2'>$evento</td>
        </tr>";
    }

    $txtTable .= "</table>";

    echo utf8ize($txtTable);
}
