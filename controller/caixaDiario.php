<?php 

$action = $_REQUEST['action'];

if($action == 'editarModal'){

    //quando é realizado um requisiçao ajax precisa ser incluido no escopo 
    include '../model/CaixaDiario.php';
    include '../controller/controllerAux/functionsAuxiliar.php';

    $id_requisicao = $_REQUEST['id'];
  
    $row = selectFechamentoCaixaById($id_requisicao);

    $return = ['dados' =>  utf8ize($row)];

    echo json_encode($return);

}
if($action  == 'salvarAlteracoes'){

    $id_requisicao = $_REQUEST['id_requisicao'];
    $obs = limpaObservacao($_REQUEST['obs']);
    $caixa = $_REQUEST['caixa'];
    $conc = $_REQUEST['conc'];
    $turnos_definitivo = $_REQUEST['turnos_definitivo'];
    $data_caixa = $_REQUEST['data_caixa'];
    $dep_brinks = $_REQUEST['dep_brinks'];
    $dep_cheque = $_REQUEST['dep_cheque'];
    $dep_dinheiro = $_REQUEST['dep_dinheiro'];

    $row = verificarUltimoRegistro($id_requisicao);
 
    updateFechamentoCaixaAlteracao($id_requisicao, $dep_dinheiro, $dep_cheque, $dep_brinks, $data_caixa, $turnos_definitivo,$conc, $caixa, $obs);

    $obs = "<b>Alterou o caixa para:</b> <br>
    Depósito Dinheiro: $dep_dinheiro <br>
    Depósito Cheque: $dep_cheque <br>
    Depósito Brinks: $dep_brinks <br>
    Turnos definitivo: $turnos_definitivo <br>
    Observações: $obs <br>
    <br>
    <b>Antes os campos eram:</b> <br>
    Depósito Dinheiro: ".$row['dep_dinheiro']."  <br>
    Depósito Cheque: ".$row['dep_cheque']." <br>
    Depósito Brinks: ".$row['dep_brinks']." <br>
    Turnos definitivo: ".$row['turnos_definitivo']." <br>
    Observações: ".$row['obs']."<br>";

    insertFechamentoCaixaObservacao($id_requisicao, $usuarioLogado, $obs);
}

if($action == 'fecharCxDiario' && $_REQUEST['concBancariaSim'] == 'on' &&  $_REQUEST['fechamentoSim'] == 'on'){

    $id_requisicao = $_REQUEST['id_requisicao'];
    $obs = 'ALTEROU O STATUS PARA FECHADO';
    $status = 'FECHADO';
    $confirmarConciliacao = "'concBancaria = 'SIM', fechaCaixa = 'SIM',";

    updateFechamentoCaixa($id_requisicao, $status, $confirmarConciliacao);

    insertFechamentoCaixaObservacao($id_requisicao, $usuarioLogado, $obs);

}
if($action == 'abrirCxDiario'){

    $status = 'ABERTO';
    $id_requisicao = $_REQUEST['id_requisicao'];
    $obs = 'ALTEROU O STATUS PARA ABERTO';

    updateFechamentoCaixa($id_requisicao, $status, $confirmarConciliacao);

    insertFechamentoCaixaObservacao($id_requisicao, $usuarioLogado, $obs);
}
if($action == 'reabrirCxDiario'){

    $id_requisicao = $_REQUEST['id_requisicao'];
    $status = 'ABERTO';
    $obs = 'REABRIU O CAIXA';

    updateFechamentoCaixa($id_requisicao, $status, $confirmarConciliacao);

    insertFechamentoCaixaObservacao($id_requisicao, $usuarioLogado, $obs);

}
if($action == 'cancelarCaixa'){

    $id_requisicao  = $_REQUEST['id_requisicao'];
    $obs = 'ALTEROU O STATUS PARA CANCELADO';
    $status = 'CANCELADO';

    updateFechamentoCaixa($id_requisicao, $status, $confirmarConciliacao);

    insertFechamentoCaixaObservacao($id_requisicao, $usuarioLogado, $obs);
 
}
if($action == 'gravarObservacao'){

    $obs = limpaObservacao($_REQUEST['observacao']);
    $id_requisicao = $_REQUEST['id_requisicao'];

    insertFechamentoCaixaObservacao($id_requisicao, $usuarioLogado, $obs);

}
if($action == 'gravarAnexo'){

    $descricao = $_REQUEST['descricao'];
    $id_requisicao = $_REQUEST['id_requisicao'];

    if($_FILES['file']['name'] <> ''){

    $extensao = strtolower(end(explode('.', $_FILES['file']['name'])));

    insertFechamentoCaixaAnexo($id_requisicao, $descricao, $extensao);

    $temp = $_FILES['file']['tmp_name'];
    $localDeArmazenagem = "assets/docs/fechamentoCaixa/";
    $tabela = "ccp_fechamentoCaixa_anexo";

    uploadArquivo($temp, $extensao, $tabela, $localDeArmazenagem);

    }

}
if($action <> 'editarModal'){
    
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT); 
$data1 = $_REQUEST['data1'];
$data2 = $_REQUEST['data2'];
$concBancaria = $_REQUEST['concBancaria'];
$turnoDefinitivo = $_REQUEST['turnoDefinitivo'];
$controleMed = $_REQUEST['controleMed'];
$id_med = $_REQUEST['id_med'];

$statusPesquisas = "";
if(!empty($dados['filtro'])){
    foreach($dados['filtro'] as $filtros){
            $statusPesquisas .= "$filtros,";
    }
}

foreach($arrayStatusCaixa as $key => $row){
                    
    $descricao = $row['descricao']; 
    $cod = $row['cod']; 

    $result_valor = mb_strpos($statusPesquisas, $cod);
    if($result_valor === false){ $checked = "";}else{$checked = "checked";}   

   $checkBox.="<td>
        <div class='form-check '>
            <input class='form-check-input ' type='checkbox' $checked name='filtro[]' value='$cod'>
            <label class='form-check-label $cod' for='flexCheckChecked'>$descricao</label>
        </div>
    </td>";
} 

$fStatus = "";
$controleDaVirgula = 1;
    if(!empty($dados['filtro'])){
        foreach($dados['filtro'] as $filtros){
            if($controleDaVirgula == 1 ){
                $fStatus .= "'$filtros'";
            }else{
                $fStatus .= ",'$filtros'";
            }
            $controleDaVirgula++;
        }
    }  

    if($controleMed === 'Controle01'){$FcontroleMed = "AND u.controladorMed = 1"; 
    }elseif($controleMed === 'Controle02'){$FcontroleMed = "AND u.controladorMed = 2"; 
    }elseif($controleMed === 'Controle03'){$FcontroleMed = "AND u.controladorMed = 3"; }   
    if($fStatus <> ''){ $fStatus = "AND status IN ($fStatus)"; }else{ $fStatus = "AND status IN ('NOVO', 'ABERTO')";}
    if ($data1 == '') { $data1 ='2017-08-01'; }
    if ($data2 == '') { $data2 = date('Y-m-d'); }
    $fData = "AND data_caixa BETWEEN '$data1' AND '$data2'";
    if($turnoDefinitivo == 'Sim'){$FCaixa = "AND caixa = 'SIM'";}
    elseif($turnoDefinitivo == 'Não'){ $FCaixa = "AND caixa = ''";}
    if($concBancaria == 'Sim'){$FConciliacao = "AND conc = 'SIM'";}
    elseif($concBancaria == 'Não'){ $FConciliacao = "AND conc = 'NÃO'";}

    $qry = selectFechamentoCaixa($fData, $fStatus, $FcontroleMed, $FCaixa, $FConciliacao);
    $x=0;
    while($row = odbc_fetch_array($qry)){

    extract($row);
    
    $title = $row['obs'];

    //atribui um id a todos os modais gerados no loop
	$modalAlterar = "modalAlterar$x";
	//gatilho para ativação do modal
	$linkModalAlterar = "data-bs-toggle='modal' data-bs-target='#$modalAlterar' style='cursor:pointer'";

        $total = $row['dep_dinheiro'] + $row['dep_cheque'] + $row['dep_brinks']  + $row['pix'];

        $txtTab.= "<tr class='$status' $linkModalAlterar>
            <td>$loginName</td>
            <td>".date('d/m/Y', strtotime($data_caixa))."</td>
            <td>".$vetorDiaSem[w($data_caixa)]."</td>
            <td>".v2($dep_dinheiro)."</td>
            <td>".v2($dep_cheque)."</td>
            <td>".v2($dep_brinks)."</td>
            <td>".v2($pix)."</td>
            <td>".v2($total)."</td>
            <td>".($caixa?'Sim':'Não')."</td>
            <td title='$title'>".($obs?'Sim':'Não')."</td>
        </tr>";

        include 'view/modal/caixaDiario/caixaDiarioVisualizar.view.php';   

        $x++;
    }

    include 'view/modal/caixaDiario/caixaDiarioIncluirObservacao.view.php';   
    include 'view/modal/caixaDiario/caixaDiarioIncluirAnexo.view.php';   
    include 'view/modal/caixaDiario/caixaDiarioeEditar.view.php';   
}

























?>