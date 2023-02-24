<?php
session_start();
include './controllerAux/validaLogin.php';
include './controllerAux/functionsAuxiliar.php';
include '../model/ChequesDevolvidos.php';

$action = $_REQUEST['action'];

if ($action == 'findAllMeds') {

    $model = new Model();
  
    $rows = $model->findAllMeds();
  
    $data = array('rows' => utf8ize($rows));
  
    echo json_encode($data);
  }
if ($action == 'findAll') {

    $status1 =  $_REQUEST['statusNovo'];
    $status2 =  $_REQUEST['statusNegociando'];
    $status3 =  $_REQUEST['statusQuitado'];
    $status4 =  $_REQUEST['statusPfin'];
    $status5 =  $_REQUEST['statusJuridico'];
    $status6 =  $_REQUEST['statusExecucao'];
    $status7 =  $_REQUEST['statusCaducou'];
    $status8 =  $_REQUEST['statusExtraviado'];
    $status9 =  $_REQUEST['statusCancelado'];
    $tipoData = $_REQUEST['tipoData'];
    $idMed = $_REQUEST['idMed'];
    $data1 = $_REQUEST['data1'];
    $data2 = $_REQUEST['data2'];
    $paginaAtual = $_REQUEST['paginaAtual'];
    $resultadoPorPagina = 6;
    $start = ($paginaAtual * $resultadoPorPagina + 1) - $resultadoPorPagina;


    if ($status1 == '' && $status2 == '' && $status3 == '' && $status4 == '' && $status5 == '' && $status6 == '' && $status7 == '' && $status8 == '' && $status9 == ''){
        $Fstatus =  "AND ch.status = 'PFIN'";
    }else {
        $Fstatus =  "AND ch.status IN ('" . $status1 . "','" . $status2 . "','" . $status3 . "','" . $status4 . "',
        '" . $status5 . "','" . $status6 . "','" . $status7 . "','" . $status8 . "','" . $status9 . "')";
    }
    if ($idMed <> '0') {

        $Fmed = "AND u.id = $idMed";
    }
    if (empty($tipoData) || $tipoData == '0') {

        $tipoData = 'ch.dthrInclusao';
    }
    if ($tipoData  === '1') {
        $tipoData = 'ch.dtCheque';
    }
    if ($tipoData  === '2') {
        $tipoData = 'ch.dtDevol';
    }
    if ($tipoData  === '3') {
        $tipoData = 'ch.dtQuitacao';
    }

    $FtipoData = " AND $tipoData BETWEEN '" . $data1 . "' AND '" . $data2 . "' ";

    $model = new Model();

    $rows = $model->findAll($FtipoData, $Fmed, $Fstatus, $start, $resultadoPorPagina);

    $data = array('rows' => utf8ize($rows[1]), 'results' => utf8ize($rows[0]));

    echo json_encode($data);
}


if ($action == 'findById') {

    $id = $_REQUEST['id'];

    $model = new Model();

    $rows = $model->findById($id);

    $arrayMotivo = array(

        '0' => array( 
            'cod' =>  '11',
            'desc' =>  'Insuficiência de fundos - 1ª apresentação',
        
        ),
        '1' => array( 
            'cod' =>  '12',
            'desc' =>  'Insuficiência de fundos - 2º apresentação',
        
        ),
        '2' => array( 
            'cod' =>  '13',
            'desc' =>  'Conta encerrada',
        ),
        '3' => array( 
            'cod' =>  '14',
            'desc' =>  'Prática espária - compromisso pronto acolhimento',
        ),
        '4' => array( 
            'cod' =>  '20',
            'desc' =>  'Folha de cheque cancelada por solicitação do correntista',
        ),
        '5' => array( 
            'cod' =>  '21',
            'desc' =>  'Contra-ordem ou oposição ao pagamento',
        ),
        '6' => array( 
            'cod' =>  '22',
            'desc' =>  'Divergência ou insuficiência de assinatura',
        ),
        '7' => array( 
            'cod' =>  '23',
            'desc' =>  'Cheques de Órgãos da administração federal em desacordo com o decreto-lei 200',
        ),
        '8' => array( 
            'cod' =>  '24',
            'desc' =>  'Bloqueio judicial ou determinação do bacen',
        ),
        '9' => array( 
            'cod' =>  '25',
            'desc' =>  'Cancelamento de talonário pelo banco sacado',
        ),
        '10' => array( 
            'cod' =>  '26',
            'desc' =>  'Inoperância temporária de transporte',
        ),
        '11' => array( 
            'cod' =>  '27',
            'desc' =>  'Feriado municipal não previsto',
        ),
        '12' => array( 
            'cod' =>  '28',
            'desc' =>  'Contra-ordem ou oposição ao pagamento motivada por furto ou roubo',
        ),
        '13' => array( 
            'cod' =>  '29',
            'desc' =>  'Falta de confirmação do recebimento do talonário pelo correntista',
        ),
        '14' => array( 
            'cod' =>  '30',
            'desc' =>  'Furto ou roubo de malotes',
        ),
        '15' => array( 
            'cod' =>  '31',
            'desc' =>  'Erro formal de preenchimento',
        ),
        '16' => array( 
            'cod' =>  '32',
            'desc' =>  'Ausência ou irregularidade na aplicação do carimbo de compensação',
        ),
        '17' => array( 
            'cod' =>  '33',
            'desc' =>  'Divergência de endosso',
        ),
        '18' => array( 
            'cod' =>  '34',
            'desc' =>  'Cheque apresentado por estabelecimento que não o indicado no cruzamento em preto, sem o endosso-mandato',
        ),
        '19' => array( 
            'cod' =>  '35',
            'desc' =>  'Cheque fraudado(adulterado), emitido sem prévio controle ou responsabilidade do estabelecimento bancário ("cheque universal")',
        ),
        '20' => array( 
            'cod' =>  '36',
            'desc' =>  'Cheque emitido com mais de um endosso',
        ),
        '21' => array( 
            'cod' =>  '37',
            'desc' =>  'Registro inconsistente - CEL',
        ),
        '22' => array( 
            'cod' =>  '40',
            'desc' =>  'Moeda inválida',
        
        ),
        '23' => array( 
            'cod' =>  '41',
            'desc' =>  'Cheque apresentado a banco que não o sacado',
        
        ),
        '25' => array( 
            'cod' =>  '42',
            'desc' =>  'Cheque não compensável na sessão ou sistema de compensação em que apresentado e o recibo bancário trocado em sessão indevida',
        ),
        '26' => array( 
            'cod' =>  '43',
            'desc' =>  'Cheque devolvido anteriormente pelos motivos 21, 22, 23, 24, 31 e 34, persistindo o vetorMotivo de devolução',
        ),
        '27' => array( 
            'cod' =>  '44',
            'desc' =>  'Cheque prescrito',
        ),
        '28' => array( 
            'cod' =>  '45',
            'desc' =>  'Cheque emitido por entidade obrigada a emitir ordem bancária',
        ),
        '29' => array( 
            'cod' =>  '46',
            'desc' =>  'CR - Comunicação de remessa cujo cheque correspondente não for entregue no prazo devido',
        ),
        '30' => array( 
            'cod' =>  '47',
            'desc' =>  'CR - Comunicação de remessa com ausência ou inconsistância de dados obrigatórios',
        ),
        '31' => array( 
            'cod' =>  '48',
            'desc' =>  'Cheque de valor superior a R$ 100,00 sem identificação do beneficiário',
        ),
        '32' => array( 
            'cod' =>  '49',
            'desc' =>  'Remessa nula, caracterizada pela reapresentação de cheque devolvido pelos motivos 12, 13, 14, 20, 25, 35, 43, 44 e 45',
        ),
        '33' => array( 
            'cod' =>  '71',
            'desc' =>  'Inadimplemento contratual da cooperativa de crédito no acordo de compensação',
        ),
        '34' => array( 
            'cod' =>  '72',
            'desc' =>  'Contrato de compensação encerrado (Cooperativas de crédito)',
        )
    );

 //   $rowObs = $model->selectObservacaoByIdPedido($id);

  //  $data = array('rows' => utf8ize($rows),  'rowsObs' => utf8ize($rowObs));

    $data = array('rows' => utf8ize($rows),  'motivos' => utf8ize($arrayMotivo));

    echo json_encode($data);
}

/*
if ($action == 'findByIdItem') {

    $id = $_REQUEST['id'];

    $model = new Model();

    $rows = $model->findByIdItem($id);

    $data = array('rows' => utf8ize($rows));

    echo json_encode($data);
}
if ($action == 'cancelarPedido') {

    $id = $_REQUEST['idPedido'];

    $model = new Model();

    if ($model->cancelarPedido($id)) {

        $data = array('res' => 'success', 'msg' => 'Pedido Cancelado');
    } else {

        $data = array('res' => 'error', 'msg' => 'Erro para cancelar');
    }
    echo json_encode($data);
}
if ($action == 'cancelarItem') {

    $id = $_REQUEST['idItem'];

    $model = new Model();

    if ($model->cancelarItem($id)) {

        $data = array('res' => 'success', 'msg' => 'Item Cancelado');
    } else {

        $data = array('res' => 'error', 'msg' => 'Erro para cancelar');
    }
    echo json_encode($data);
}
if ($action == 'alterarItem') {

    $id = $_REQUEST['idItem'];
    $quantidade = $_REQUEST['quantidade'];

    $model = new Model();

    if ($model->alterarQtdeItem($id, $quantidade)) {

        $data = array('res' => 'success', 'msg' => 'Alterado Com Sucesso');
    } else {

        $data = array('res' => 'error', 'msg' => 'Erro para alterar');
    }
    echo json_encode($data);
}
if ($action == 'addObservacao') {

    $id = $_REQUEST['idPedido'];
    $observacao = limpaObservacao($_REQUEST['observacao']);


    $model = new Model();

    if ($model->insertObservacao($id, $usuarioLogado, $observacao)) {

        $data = array('res' => 'success', 'msg' => 'Alterado Com Sucesso');
    } else {

        $data = array('res' => 'error', 'msg' => 'Erro para alterar');
    }
    echo json_encode($data);
}
if ($action == 'alterarStatus') {

    $id = $_REQUEST['idPedido'];
    $status = $_REQUEST['status'];

    if ($status == 'NOVO') {
        $status = 'ENVIADO';
    } elseif ($status == 'ENVIADO') {
        $status = 'FINALIZADO';
    }

    $model = new Model();

    if ($model->alterarStatus($id, $status)) {

        $data = array('res' => 'success', 'msg' => 'Alterado Com Sucesso');
    } else {

        $data = array('res' => 'error', 'msg' => 'Erro para alterar');
    }

    echo json_encode($data);
}
