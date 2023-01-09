<?php

    $sql = ("SELECT TOP 50 u.id, u.loginName, f.id_requisicao, f.tipo, f.cnpj, f.nomeCliente, f.status, f.obs, f.valor, f.valorJuros, f.id_cliente, f.dataEmissao, f.dataVencimento, f.id_med
           ,* FROM ccp_serasa AS f
            JOIN rh_usuario AS u ON f.id_med = u.id
            WHERE matriz = 0 AND id_requisicao > 0  AND status = 'PEFIN' ORDER  BY f.id_requisicao DESC ");
    $qry = odbc_exec($connP, $sql);
    $x=0;
    while($row = odbc_fetch_array($qry)){

    extract($row);
    //atribui um id a todos os modais gerados no loop
	$modalVisualizar= "modalVisualizar$x";
	//gatilho para ativação do modal
	$linkModalVisualizar = "data-bs-toggle='modal' data-bs-target='#$modalVisualizar' style='cursor:pointer'";

       $txtTable .= "<tr $linkModalVisualizar>
            <td>".$loginName."</a></td>
            <td>".$tipo."</a></td>
            <td>".$nomeCliente."</a></td>
            <td>".v2($valor)."</td>
            <td>".dma($dataEmissao)."</td>
            <td>".dma($dataVencimento)."</td>
            <td>".($matriz == 1 ? 'Sim' : 'Não' )."</td>
        </tr>";

       include 'view/modal/serasa/serasaVisualizar.view.php';   

        $x++;
    }

       // include 'view/modal/serasa/serasaIncluirObservacao.view.php';   
       // include 'view/modal/serasa/serasaIncluirAnexo.view.php';   
       // include 'view/modal/serasa/serasaEditar.view.php'; 