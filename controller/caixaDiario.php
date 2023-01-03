<?php 

$action = $_REQUEST['action'];

if($action == 'editarModal'){

    //quando é realizado um requisiçao ajax precisa ser incluido no escopo 
    include '../controller/functionsBD.php';

    $id_requisicao = $_REQUEST['id'];
  
    $row = selectFechamentoCaixaById($id_requisicao);
   
    $return = ['dados' =>  utf8ize($row)];
  
    echo json_encode($return);

}
if($action == 'fecharCxDiario' && $_REQUEST['concBancariaSim'] == 'on' &&  $_REQUEST['fechamentoSim'] == 'on'){

    ECHO $id_requisicao = $_REQUEST['id_requisicao'];

    $observacao = "ALTEROU O STATUS PARA FECHADO";
    $sql = "INSERT INTO ccp_fechamentoCaixa_obs (id_requisicao, datahora, usuario, obs, gerado)
            VALUES ('$id_requisicao', '".date('Y-m-d H:i')."', '$usuarioLogado', '$observacao', 'USUARIO')";
             var_dump($sql);
    //odbc_exec($connP, $sql);
    
    $sql1 = "UPDATE ccp_fechamentoCaixa SET concBancaria = 'SIM', fechaCaixa = 'SIM', status = 'FECHADO' WHERE id = '$id_requisicao'";
    var_dump($sql1);
    //odbc_exec($connP, $sql);


}
if($action == 'abrirCxDiario'){

    $id_requisicao = $_REQUEST['id_requisicao'];

    $sql = "UPDATE ccp_fechamentoCaixa SET status = 'ABERTO' WHERE id = $id_requisicao";
    //odbc_exec($connP, $sql);

     $observacao = "ALTEROU O STATUS PARA ABERTO";
     $sql = "INSERT INTO ccp_fechamentoCaixa_obs (id_requisicao, datahora, usuario, obs, gerado)
             VALUES ('$id_requisicao', '".date('Y-m-d H:i')."', '$usuarioLogado', '$observacao', 'USUARIO')";

             var_dump($sql);
     //odbc_exec($connP, $sql) or die(odbc_error());;

     ECHO 'ABRIU O CAIXA';

}
if($action == 'reabrirCxDiario'){

    ECHO $id_requisicao = $_REQUEST['id_requisicao'];

    $sql = "UPDATE ccp_fechamentoCaixa SET status = 'ABERTO' WHERE id = $id_requisicao";
    var_dump($sql);
    //odbc_exec($connP, $sql) or die(odbc_error());


    $sql1 = "INSERT INTO ccp_fechamentoCaixa_obs (id_requisicao, datahora, usuario, obs, gerado) VALUES ('$id_requisicao', '".date('Y-m-d H:i')."', '$usuarioLogado', 'REABRIU O CAIXA', 'USUARIO')";
    //odbc_exec($connP, $sql) or die(odbc_error());
    var_dump($sql1);

     ECHO 'REABRIU O CAIXA';

}
if($action == 'cancelarCaixa'){

    $id_requisicao  = $_REQUEST['id_requisicao'];

    $sql    = "UPDATE ccp_fechamentoCaixa SET status = 'CANCELADO' WHERE id = $id_requisicao ";
    //odbc_exec($connP, $sql) or die(odbc_error());
    var_dump($sql);
    $sql1 = "INSERT INTO ccp_fechamentoCaixa_obs (id_requisicao, datahora, usuario, obs, gerado) VALUES ('$id_requisicao', '".date('Y-m-d H:i:s')."', '".$usuarioLogado."', 'ALTEROU O STATUS PARA CANCELADO', 'USUARIO')";
    //odbc_exec($connP, $sql) or die(odbc_error());
    var_dump($sql1);
    echo 'caixa cancelado';
    
}
if($action == 'gravarObservacao'){

    $descricao = $_REQUEST['descricao'];
    $id_requisicao = $_REQUEST['id_requisicao'];
 
     var_dump($sql);
    //insertFechamentoCaixaObservacao($observacao,$id_requisicao, $usuarioLogado);

}
if($action == 'gravarAnexo'){

    $descricao = $_REQUEST['descricao'];
    $id_requisicao = $_REQUEST['id_requisicao'];

    if($_FILES['file']['name'] <> ''){

    $extensao = strtolower(end(explode('.', $_FILES['file']['name'])));

    $sql = "INSERT INTO ccp_fechamentoCaixa_anexo (id_requisicao, descricao, extensao, dthr_anexo) 
    VALUES ('$id_requisicao','$descricao','$extensao', '".date('Y-m-d H:i:s')."')";
    var_dump($sql);

    $temp = $_FILES['file']['tmp_name'];

    uploadArquivoFechamentoCaixa($temp, $extensao);

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