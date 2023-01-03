<?php

$action = $_REQUEST['action'];

$data1 = $_REQUEST['data1'];
$data2 = $_REQUEST['data2'];
$tipoData = $_REQUEST['tipoData'];
$id_med = $_REQUEST['id_med'];
$cliente = $_REQUEST['cliente'];
$id = $_REQUEST['p2'];
$banco = $_REQUEST['banco'];

$filtroStatus = '';


//COLOCA TODOS OS CHECKBOX DENTRO DO VETOR $s
for ($st = 0; $st <= 11; $st++) {

    $s[$st] = $_REQUEST['s' . $st];
}

//SE A OPÇÃO 'TODOS' ESTIVER FLEGADA ESSE FOR FARA TODOS OS REQUESTS DE 's' RECEBER CHECKED
if ($s[0] == 'checked') {

    for ($st = 0; $st <= 11; $st++) {
        $s[$st] = 'checked';
    }
}
//FILTRA STATUS
if ($s[1] == 'checked') {
    $filtroStatus = $filtroStatus . ",'NOVO'";
}
if ($s[2] == 'checked') {
    $filtroStatus = $filtroStatus . ",'NEGOCIANDO'";
}
if ($s[3] == 'checked') {
    $filtroStatus = $filtroStatus . ",'QUITADO'";
}
if ($s[4] == 'checked') {
    $filtroStatus = $filtroStatus . ",'PFIN'";
}
if ($s[5] == 'checked') {
    $filtroStatus = $filtroStatus . ",'JURIDICO'";
}
if ($s[6] == 'checked') {
    $filtroStatus = $filtroStatus . ",'EXECUCAO'";
}
if ($s[7] == 'checked') {
    $filtroStatus = $filtroStatus . ",'CADUCO'";
}
if ($s[8] == 'checked') {
    $filtroStatus = $filtroStatus . ",'EXTRAVIADO'";
}
if ($s[9] == 'checked') {
    $filtroStatus = $filtroStatus . ",'CANCELADO'";
}
if ($s[10] == 'checked') {
    $filtroStatus = $filtroStatus . ",'SEM SOLUCAO'";
}

if ($filtroStatus == '') {
    $filtroStatus = "AND status IN ('NOVO', 'NEGOCIANDO', 'PFIN')";
    $s1 = 'checked';
    $s2 = 'checked';
    $s4 = 'checked';
} else {
    $filtroStatus = "AND status IN (''" . $filtroStatus . ")";
}

if ($id <> '') {
    $Fid = "AND ch.id = $id";
}
if ($cliente <> '') {
    $Fcliente = "AND nome LIKE '%$cliente%' ";
}
if ($banco <> '') {
    $Fbanco = "AND bco = $banco";
}
if ($id_med <> '') {
    $Fmed = "AND ch.id_med = $id_med";
}
if (empty($tipoData)) {

    $tipoData = 'dthrInclusao';
}
if ($tipoData  === '0') {
    $tipoData = 'dthrInclusao';
}
if ($tipoData  === '1') {
    $tipoData = 'dtCheque';
}
if ($tipoData  === '2') {
    $tipoData = 'dtDevol';
}
if ($tipoData  === '3') {
    $tipoData = 'dtQuitacao';
}
if ($data1 == '') {

    $data1 = date('1999-01-01');
}
if ($data2  == '') {

    $hoje = date('Y-m-d');
    $amanha = date('Y-m-d', strtotime($hoje . ' +1 day'));
    $data2 = $amanha;
}

$FtipoData = " AND $tipoData BETWEEN '" . $data1 . "' AND '" . $data2 . "' ";

$qry = selectChequeDevolvidos($FtipoData, $FBanco, $Fid, $Fcliente, $Fbanco, $Fmed, $filtroStatus);

//var_dump($sql);
// variaveis declaradas para apresentarem os valores totais e corrigidos ao fim da tabela
$totalValor = 0;
$totalValorCorrigido = 0;

while ($row = odbc_fetch_array($qry)) {

    //o extract faz com que nao precise escrever o row['alguma coisa'] posso colocar a varivel direto
    extract($row);

    $ultimaAlt = '';
    if ($ultimaAlteracao <> '') {
        $ultimaAlt = dma($ultimaAlteracao);
    }
    $dtQuita = '';
    if ($dtQuitacao <> '') {
        $dtQuita = dma($dtQuitacao);
    }

    //esses vetores estao no arquivo de conexao
    $motivoTitle = $vetorMotivo[$motivo];
    $bancoTitle = $vetorBanco[$bco];

    if ($valorQuitacao <> '') {
        $valorCorrigido = $valorQuitacao;
        $tituloValCorr = 'Valor Recebido';
    } else {
        $valorCorrigido = $valorCorr;
        $tituloValCorr = 'Taxa de 0,1% por dia de atraso';
    }
    if ($subclasse == 'OUTRO') {
        $obs = '(' . l50($obs) . ')';
    } else {
        $obs = '';
    }
    //atribui um id a todos os modais gerados no loop
    $modal = "modal$id";
    //gatilho para ativação do modal
    $link = "data-bs-toggle='modal' data-bs-target='#$modal' style='cursor:pointer'";

    $txtTab .= "<tr $link>
                <td>$id</td>
                <td>" . dma($dthrInclusao) . "</td>
                <td title='$bancoTitle'>$bco</td>
                <td>" . l10($nome) . "</td>
                <td>$nrcheque</td>
                <td title='$motivoTitle'>$motivo</td>
                <td>" . dma($dtCheque) . "</td>
                <td>" . v2($valor) . "</td>
                <td>" . dma($dtDevol) . "</td>
                <td>$dias</td>
                <td title=$tituloValCorr>" . v2($valorCorrigido) . "</td>
                <td>$dtQuita</td>
                <td>$loginName </td>
                <td>" . l5($status) . "</td>
                <td>$ultimaAlt</td>
            </tr>";
    $totalValor += $valor;
    $totalValorCorrigido += $valorCorr;

    include 'view/modal/chequesDevolvidos/chequesDevolvidosVisualizarModal.view.php';
}

    $txtTab .= "</tbody>
            <tr class='w3-yellow'>
                <td colspan='7'><center>Total</td><td><center>
                <a>".v2($totalValor)."</a></td><td colspan='2'></td>
                <td><center><a>".v2($totalValorCorrigido)."</a></td><td colspan='4'></td>
            </tr>";
            
            include 'view/modal/chequesDevolvidos/chequesDevolvidosIncluirCheque.view.php';
            include 'view/modal/chequesDevolvidos/chequesDevolvidosCancelarCheque.view.php';
            include 'view/modal/chequesDevolvidos/chequesDevolvidosConfirmarQuitacaoModal.view.php';
            include 'view/modal/chequesDevolvidos/chequesDevolvidosIncluirAnexo.view.php';
            include 'view/modal/chequesDevolvidos/chequesDevolvidosIncluirObservacao.view.php';
            include 'view/modal/chequesDevolvidos/chequesDevolvidosSemSolucao.view.php';        
           
//INCLUIR NOVO CHEQUE
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
if ($action == 'quitacao' || $action == 'pfin' || $action == 'cancelar-cheque') {

    $idCheque = $_REQUEST['idCheque'];

    if ($action == 'quitacao') {
        $status = "status = 'QUITADO',";
        $evento = 'Confirmada Quitação';
    }
    if ($action == 'pfin') {
        $status = "status = 'PFIN',";
        $evento = 'Incluido em PFIN (Serasa/SPC)';
    }
    if ($action == 'cancelar-cheque') {
        $status = "status = 'CANCELADO',";
        $evento = 'CANCELADO';
    }

    updateChequeDevolvidoById($status, $idCheque);
    insertChequeDevolvidoEvento($evento, $idCheque, $idUsuario, $usuarioLogado);

    if ($_REQUEST['motivoCancelamento'] <> '') {

        $observacao = $_REQUEST['motivoCancelamento'];
        insertChequeDevolvidoObersevacao($idCheque, $idUsuario, $usuarioLogado, $observacao);
    }
    if ($_FILES['file']['name'] <> '') {

        $action = 'gravarAnexo';
    }
}
//OPCAO SEM SOLUCAO
if ($action == 'semsolucao') {

    $observacao = $_REQUEST['observacao'];
    $idCheque = $_REQUEST['idCheque'];
    $status = "status = 'SEM SOLUCAO',";
    $evento = 'CHEQUE SEM SOLUCAO';

    updateChequeDevolvidoById($status, $idCheque);
    insertChequeDevolvidoEvento($evento, $idCheque, $idUsuario, $usuarioLogado);

    if ($observacao <> '') {

        insertChequeDevolvidoObersevacao($idCheque, $idUsuario, $usuarioLogado, $observacao);
    }
}
//GRAVAR ANEXO
if ($action == 'gravarAnexo') {

    $idCheque = $_REQUEST['idCheque'];
    $descricao = $_REQUEST['descricao'];
    $file = $_REQUEST['file'];
    $evento = 'Incluiu Anexo';

    if ($_FILES['file']['name'] <> "") {

        if ($descricao == '') {
            $descricao = $_FILES['file']['name'];
        }

        $extensao = strtolower(end(explode('.', $_FILES['file']['name'])));
        $temp = $_FILES['file']['tmp_name'];
        $localDeArmazenagem = "assets/docs/chequesDevolvidos/";
        $tabela = "ccp_chequeDevAnexo";

        insertChequeDevolvidoAnexo($descricao, $extensao, $idCheque, $idUsuario, $usuarioLogado);

        uploadArquivo($temp, $extensao, $tabela, $localDeArmazenagem);

        updateChequeDevolvidoById($status = "", $idCheque);

        insertChequeDevolvidoEvento($evento, $idCheque, $idUsuario, $usuarioLogado);
    } else {
        echo "<script>alert('Houve algum erro, tente refazer o processo')</script>";
    }
}
//GRAVAR OBS E NOTIFICAR POR EMAIL             
if ($action == 'gravarObservacao') {

    $idCheque = $_REQUEST['idCheque'];
    $observacao = $_REQUEST['observacao'];
    $evento = 'Incluiu Observação';

    insertChequeDevolvidoObersevacao($idCheque, $idUsuario, $usuarioLogado, $observacao);

    insertChequeDevolvidoEvento($evento, $idCheque, $idUsuario, $usuarioLogado);

    if ($_REQUEST['enviarEmail'] == 'on') {

        $assunto = 'Atualização no Cheque Devolvido Nº ' . $idCheque;
        $mensagemHTML = ' 
        <table align="center" width="100%">
                    <tr>
                        <td align="center">
                         <table id="table-1" width="760" >
                            <tr align="left" bgcolor="#006633">
                              <td height="20" align="right" bgcolor="#FFFFFF"><div align="center"><img src="assets/img/logos/topo-rdp-petroleo.png" alt="RDP"><p></div>
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
