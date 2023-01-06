<?php

    $sql = ("SELECT TOP 50 u.id, u.loginName, f.id_requisicao, f.tipo, f.cnpj, f.nomeCliente, f.status, f.obs, f.valor, f.valorJuros, f.id_cliente, f.dataEmissao, f.dataVencimento, f.id_med
            FROM ccp_serasa AS f
            JOIN rh_usuario AS u ON f.id_med = u.id
            WHERE matriz = 0 AND id_requisicao > 0 ORDER  BY f.id_requisicao DESC ");
    $qry = odbc_exec($connP, $sql);
    
    while($row = odbc_fetch_array($qry)){

       $txtTable .= "<tr>
            <td>".$row['loginName']."</a></td>
            <td>".$row['tipo']."</a></td>
            <td>".$row['nomeCliente']."</a></td>
            <td>".v2($row['valor'])."</td>
            <td>".dma($row['dataEmissao'])."</td>
            <td>".dma($row['dataVencimento'])."</td>
            <td>".$matriz."</td>
        </tr>";
    }
