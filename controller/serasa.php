<?php
session_start();
$id = $_SESSION['id_u'];

require_once '../model/Serasa.php';

$serasa = new Serasa();

$usuario = $serasa->selectUserById($id);
//var_dump($usuario);
if ($usuario['nomeCompleto']) {

    $action = $_REQUEST['action'];

    if ($action == 'findAllMeds') {

        $rows = $serasa->findAllMeds();

        $data = array('rows' => $serasa->converterUtf8($rows));

        echo json_encode($data);
    }
    if ($action == 'findAll') {

        $status1 = $_REQUEST['statusNovo'];
        $status2 = $_REQUEST['statusPefin'];
        $status3 = $_REQUEST['statusBaixado'];
        $status4 = $_REQUEST['statusCancelado'];
        $med = $_REQUEST['idMed'];
        $matriz =  $_REQUEST['matriz'];
        $tipo =  $_REQUEST['tipo'];
        $cliente =  $_REQUEST['nomeCliente'];
        $paginaAtual = $_REQUEST['paginaAtual'];
        $resultadoPorPagina = 12;

        $start = ($paginaAtual * $resultadoPorPagina + 1) - $resultadoPorPagina;

        if ($matriz == 1) {
            $Fmatriz = " AND matriz = 1 ";
        } else {
            $Fmatriz = " AND matriz = 0 ";
        }
        if (isset($med) && $med <> '0') {
            $Fmed = "AND id_med = '$med' ";
        }
        if (isset($tipo) && $tipo <> '0') {
            $Ftipo = "AND tipo LIKE '%$tipo%'";
        }
        if (isset($cliente) && $cliente <> '') {
            $Fcliente = " AND nomeCliente LIKE '%$cliente%' ";
        }
        if ($status1 == '' && $status2 == '' && $status3 == '' && $status4 == '') {
            $Fstatus =  "AND status = 'PEFIN'";
        } else {
            $Fstatus =  "AND status IN ('" . $status1 . "','" . $status2 . "','" . $status3 . "','" . $status4 . "')";
        }

        $rows = $serasa->findAll($Fstatus, $Fmatriz, $Fmed, $Ftipo, $Fcliente, $start, $resultadoPorPagina);

        $data = array('rows' => $serasa->converterUtf8($rows[1]), 'results' => $serasa->converterUtf8($rows[0]));

        echo json_encode($data);
    }
    if ($action == 'findById') {

        $id = $_REQUEST['id'];

        $rows = $serasa->findById($id);

        $data = array('rows' => $serasa->converterUtf8($rows));

        echo json_encode($data);
    }
    if ($action == 'gravarAnexo') {

        $id = $_REQUEST['id'];
        $descricao = $serasa->limpaObservacao(utf8_decode($_REQUEST['descricao']));
        $descricaoAnexo = "ANEXO";
        $temp = $_FILES['file']['tmp_name'];
        $localDeArmazenagem = "../assets/docs/serasa/";
        $tabela = 'ccp_serasa_anexo';
        $evento = "ADICIONOU UM ANEXO";

        if ($_FILES['file']['name'] <> '') {

            $serasa->insertEventos($id, $evento, $usuario['loginName']);

            $extensao = strtolower(end(explode('.', $_FILES['file']['name'])));

            if ($serasa->insertAnexo($id, $descricaoAnexo, $descricao, $extensao)) {

                $serasa->uploadArquivo($temp, $extensao, $tabela, $localDeArmazenagem);

                $data = array('res' => 'success');
            } else {

                $data = array('res' => 'error');
            }
        } else {

            $data = array('res' => 'error');
        }

        echo json_encode($data);
    }
    if ($action == 'gravarObs') {

        $id = $_REQUEST['id'];
        $observacao = $serasa->limpaObservacao(utf8_decode($_REQUEST['observacao']));

        if ($serasa->insertObservacao($id, $usuario['loginName'], $observacao)) {

            $data = array('res' => 'success');
        } else {

            $data = array('res' => 'error');
        }

        echo json_encode($data);
    }
    if ($action == 'findAnexosById') {

        $id = $_REQUEST['id'];

        $rows = $serasa->selectAnexos($id);

        if (!empty($rows)) {

            $data = array('rows' => $serasa->converterUtf8($rows));
        } else {

            $data = array('res' => 'error');
        }

        echo json_encode($data);
    }
    if ($action == 'findEventosById') {

        $id = $_REQUEST['id'];

        $rows = $serasa->selectEventos($id);

        if (!empty($rows)) {

            $data = array('rows' => $serasa->converterUtf8($rows));
        } else {

            $data = array('res' => 'error');
        }

        echo json_encode($data);
    }
    if ($action == 'findObservacoesById') {

        $id = $_REQUEST['id'];

        $rows = $serasa->selectObservacoes($id);

        if (!empty($rows)) {

            $data = array('rows' => $serasa->converterUtf8($rows));
        } else {

            $data = array('res' => 'error');
        }

        echo json_encode($data);
    }
    if ($action == 'alterarStatus') {

        $id = $_REQUEST['id'];
        $status = $_REQUEST['status'];
        $observacaoStatus = $_REQUEST['observacaoStatus'];
        $evento = $_REQUEST['evento'];

        if ($serasa->updateStatus($id, $status)) {

            $serasa->insertEventos($id, $evento,  $usuario['loginName']);
            $serasa->insertObservacao($id, $usuario['loginName'], $observacaoStatus);

            $data = array('res' => 'success');
        } else {

            $data = array('res' => 'error');
        }

        echo json_encode($data);
    }
    if ($action == 'baixarSerasa') {

        $id = $_REQUEST['id'];
        $status = $_REQUEST['status'];
        $observacaoStatus = $_REQUEST['observacaoStatus'];
        $evento = $_REQUEST['evento'];
        $descricao = $_REQUEST['descricao'];
        $descricaoAnexo = "ANEXO";
        $temp = $_FILES['file']['tmp_name'];
        $localDeArmazenagem = "../assets/docs/serasa/";
        $tabela = 'ccp_serasa_anexo';
        $evento = "ADICIONOU UM COMPROVANTE DE PGTO";

        if ($_FILES['file']['name'] <> '') {

            $extensao = strtolower(end(explode('.', $_FILES['file']['name'])));

            if ($serasa->insertAnexo($id, $descricaoAnexo, $descricao, $extensao)) {

                $serasa->updateStatus($id, $status);
                $serasa->insertEventos($id, $evento, $usuario['loginName']);
                $serasa->insertObservacao($id, $usuario['loginName'], $observacaoStatus);
                $serasa->uploadArquivo($temp, $extensao, $tabela, $localDeArmazenagem);

                $data = array('res' => 'success');
            } else {

                $data = array('res' => 'error');
            }
        } else {

            $data = array('res' => 'semAnexo');
        }

        echo json_encode($data);
    }
    if ($action == 'alterarSerasa') {

        $id = intval($_REQUEST['id_requisicao']);
        $dtNascimento = $_REQUEST['dtNascimento'];
        $dtEmissao = $_REQUEST['dtEmissao'];
        $dtVencimento = $_REQUEST['dtVencimento'];
        $tipo = $_REQUEST['tipo'];
        $valorInicial = $_REQUEST['valorInicial'];
        $valorJuros = $_REQUEST['valorJuros'];
        $evento = "ALTEROU O REGISTRO";

        if ($serasa->updateSerasa($id, $dtNascimento, $dtEmissao, $dtVencimento, $tipo, $valorInicial, $valorJuros)) {

            $serasa->insertEventos($id, $evento, $usuario['loginName']);
            $data = array('res' =>  'success');
        } else {

            $data = array('res' => 'error');
        }

        echo json_encode($data);
    }
}else{

    header("https://www.rdppetroleo.com.br/medwebnovo/?p=5");
    
}
