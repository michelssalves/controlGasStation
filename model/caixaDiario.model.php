<?php 

$action = $_REQUEST['action'];

if($action == 'editarModal'){

    //quando é realizado um requisiçao ajax precisa ser incluido no escopo 
    include '../controller/functionsBD.php';

    $id_requisicao = $_REQUEST['id'];
  
    $row = selectFechamentoCaixaById($id_requisicao);
   
    function utf8ize($d) {
        if (is_array($d)) {
            foreach ($d as $k => $v) {
                $d[$k] = utf8ize($v);
            }
        } else if (is_string ($d)) {
            return utf8_encode($d);
        }
        return $d;
    }
    $return = ['dados' =>  utf8ize($row)];
  
    echo json_encode($return);

}
if($action == 'fecharCxDiario' && $_REQUEST['concBancariaSim'] == 'on' &&  $_REQUEST['fechamentoSim'] == 'on'){

    ECHO $id_requisicao = $_REQUEST['id_requisicao'];

   /* $observacao = "ALTEROU O STATUS PARA FECHADO";
    $sql = "INSERT INTO ccp_fechamentoCaixa_obs (id_requisicao, datahora, usuario, obs, gerado)
            VALUES ('$id_requisicao', '$datahora', '$usuarioLogado', '$observacao', 'USUARIO')";
    odbc_exec($connP, $sql);
    
    $sql = "UPDATE ccp_fechamentoCaixa SET concBancaria = 'SIM', fechaCaixa = 'SIM', statys = 'FECHADO' WHERE id = '$id_requisicao'";
    odbc_exec($connP, $sql);*/

    ECHO 'FECHOU O CAIXA';

}
if($action == 'abrirCxDiario'){

    ECHO $id_requisicao = $_REQUEST['id_requisicao'];

    /* $observacao = "ALTEROU O STATUS PARA ABERTO";
     $sql = "INSERT INTO ccp_fechamentoCaixa_obs (id_requisicao, datahora, usuario, obs, gerado)
             VALUES ('$id_requisicao', '$datahora', '$usuarioLogado', '$observacao', 'USUARIO')";
     odbc_exec($connP, $sql);*/

     ECHO 'ABRIU O CAIXA';

}
if($action == 'reabrirCxDiario'){

    ECHO $id_requisicao = $_REQUEST['id_requisicao'];

    /* $observacao = "ALTEROU O STATUS PARA ABERTO";
     $sql = "INSERT INTO ccp_fechamentoCaixa_obs (id_requisicao, datahora, usuario, obs, gerado)
             VALUES ('$id_requisicao', '$datahora', '$usuarioLogado', '$observacao', 'USUARIO')";
     odbc_exec($connP, $sql);*/

     ECHO 'REABRIU O CAIXA';

}
if($action == 'gravarAnexo'){


}
if($action == 'cancelarCaixa'){

    echo $id_requisicao  = $_REQUEST['id_requisicao'];
    $usuario        = $_SESSION['login'];
    $datahora       = date('Y-m-d H:i:s');

    $sqlCancelar    = "UPDATE ccp_fechamentoCaixa SET status = 'CANCELADO' WHERE id = '".$id_requisicao."'";
    //$execCancelar   = odbc_exec($conectar, $sqlCancelar) or die(odbc_error());
    $sqlObs = "INSERT INTO ccp_fechamentoCaixa_obs (id, id_requisicao, datahora, usuario, obs, gerado) VALUES (null, '".$id_requisicao."', '".$datahora."', '".$usuario."', 'ALTEROU O STATUS PARA CANCELADO', 'SISTEMA')";
    //$obsExec = odbc_exec($conectar, $sqlObs) or die(odbc_errormsg());
    echo 'caixa cancelado';
    
}
if($action == 'gravarObservacao'){

    $observacao = $_REQUEST['observacao'];
    $id_requisicao = $_REQUEST['id_requisicao'];
    $usuario = $_SESSION['login'];

    insertFechamentoCaixaObservacao($observacao,$id_requisicao, $usuarioLogado);

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
        $id = $row['id']; 
        $title = $row['obs'];

    //atribui um id a todos os modais gerados no loop
	$modalAlterar = "modalAlterar$x";
	$modalObservacao = "modalObservacao$x";
	//gatilho para ativação do modal
	$linkModalAlterar = "data-bs-toggle='modal' data-bs-target='#$modalAlterar' style='cursor:pointer'";
	$linkModalObservacao = "data-bs-toggle='modal' data-bs-target='#$modalObservacao' style='cursor:pointer'";

     

        $link = "<a href='index.php?m=Indice&a=visualizarRequisicao&id_requisicao=$id' style='color: black;'>";
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