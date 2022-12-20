<?php 
$action = $_REQUEST['action'];
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT); 
$data1 = $_REQUEST['data1'];
$data2 = $_REQUEST['data2'];
$concBancaria = $_REQUEST['concBancaria'];
$definitivo = $_REQUEST['definitivo'];
$controleMed = $_REQUEST['controleMed'];
$id_med = $_REQUEST['id_med'];
$statusPesquisas ="";

if(!empty($dados['filtro'])){
    foreach($dados['filtro'] as $filtros){
            $statusPesquisas .= "$filtros,";
    }
}

foreach($arrayStatusCaixa as $key => $row){
                    
    $descricao = $row['descricao']; 
    $cod = $row['cod']; 
    $result_valor = mb_strpos($statusPesquisas, $cod);
    if($result_valor === false){
        $checked = "";
    }else{
        $checked = "checked";
    }       

   $checkBox.="<td>
        <div class='form-check'>
            <input class='form-check-input' type='checkbox' $checked name='filtro[]' value='$cod'>
            <label class='form-check-label' for='flexCheckChecked'>$descricao</label>
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
var_dump($fStatus);
if ($data1 == '') { $data1 ='2017-08-01'; }
if ($data2 == '') { $data2 = date('Y-m-d'); }

    $dia[0] = 'Domingo';
    $dia[1] = 'Segunda-Feira';
    $dia[2] = 'Terca-Feira';
    $dia[3] = 'Quarta-Feira';
    $dia[4] = 'Quinta-Feira';
    $dia[5] = 'Sexta-Feira';
    $dia[6] = 'Sabado';

   $fStatus = "AND status IN ($fStatus)";

    $qry = selectFechamentoCaixa($fStatus);
    
    while($row = odbc_fetch_array($qry)){
        
        $id = $row['id']; 
        $title = $row['obs'];
        if($title == ""){
            $obs = "Não";
        }else{
            $obs = "Sim";
        }

        $link = "<a href='index.php?m=Indice&a=visualizarRequisicao&id_requisicao=$id' style='color: black;'>";
        $total = $row['dep_dinheiro'] + $row['dep_cheque'] + $row['dep_brinks']  + $row['pix'];

        $txtTab.= "<tr class='".$row['status']."'>
        <td class='center'>".$link.$row['loginName']."</a></td>
        <td class='center'>".$link.date('d/m/Y', strtotime($row['data_caixa']))."</a></td>
        <td class='center'>".$dia[date('w',strtotime($row['data_caixa']))]."</td>
        <td class='direita'>".v2($row['dep_dinheiro'])."</td>
        <td class='direita'>".v2($row['dep_cheque'])."</td>
        <td class='direita'>".v2($row['dep_brinks'])."</td>
        <td class='direita'>".v2($row['pix'])."</td>
        <td class='direita'>".v2($total)."</td>
        <td class='center'>".$row['turnos_definitivo']."</td>
        <td class='center' title='".$title."'>$obs</td>
        </tr>";
    
    }





























?>