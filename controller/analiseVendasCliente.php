<?php
session_start();
$id = $_SESSION['id_u'];

$analiseVendasCliente = new AnaliseVendasCliente();

$usuario = $analiseVendasCliente->selectUserById($id);

if ($usuario['nomeCompleto']) {

    $corCL = 'style="background-color:#EEDD82;"';

    //pega valores passados
    $acao = $_REQUEST['acao'];
    
    $periodo = $_REQUEST['periodo'];
    
    $mes = $_REQUEST['mes'];
    
    $formaPgto = $_REQUEST['formaPgto'];
    
    include 'filtrosAnalitico.php';
    
    if ($periodo == '') { $periodo = date('Y'); } 
    if ($mes == '') { $mes = date('m'); } 
    if ($formaPgto == '') { $formaPgto = 'FORMA PGTO';; } 
    //se botao limpar , coloca os valores padrão
    if ($acao == 'limpar') {
        $periodo = date('Y');  
        $mes = date('m');
        $formaPgto = 'FORMA PGTO';
        
    }
    
    if ($formaPgto <> 'FORMA PGTO') {
        $fForma = "AND formaPgtoPadrao LIKE '%$formaPgto%' ";
    }
    $fmes1 = "AND month(data_cadastro) = $mes ";  
    $fmes2 = "AND month(dtaconta) = $mes ";
    
    $ano_todo = $_REQUEST['ano_todo'];
    
    if ($ano_todo == 'checked'){
        $fmes1 = "  ";  
        $fmes2 = "  ";
    }
    //mes atual/ano atual
    $sql = "SELECT year(data_cadastro) AS ano, id_med, u.loginname, u.id_xpert AS id_filial, c.idXpert, formaPgtoPadrao, 
                (SELECT TOP 1 month(dtaconta) AS mes FROM med_vendas_cliente WHERE year(dtaconta) = $periodo ORDER BY dtaconta DESC) AS ultMes
                 FROM med_cliente AS c
                LEFT JOIN rh_usuario AS u ON u.id = c.id_med
                WHERE idXpert IS NOT NULL AND ano = $periodo AND c.idXpert > 0  $ffilial  $frede $fmes1  $fForma
                ORDER BY ano, id_Med";
    //echo "<pre><center>$sql</pre>";
    
    $qry = odbc_exec($connP, $sql);
    while ($row = odbc_fetch_array($qry)){
        $f = $row['id_med'];
        $ultMes = $row['ultMes'];
    
        $v1[$f] = $v1[$f] + 1;
        $ixc[$f] = $ixc[$f].', '.$row['idXpert'];
    }
    
    //combo périodo
    
    $sql = "SELECT DISTINCT year(data_cadastro) AS ano FROM med_cliente ORDER BY ano DESC";
    $qry = odbc_exec($connP, $sql);
    while ($row = odbc_fetch_array($qry)){	
        $cbPeriodo = $cbPeriodo."<option >".$row['ano']."</option>";
    }
    
    $sql = "SELECT id, loginName, id_xpert AS id_filial, *
                FROM rh_usuario 
                WHERE id_xpert > 0  AND gerenteDeRede IS NOT NULL
                $ffilial $frede
                ORDER BY loginName
                ";
    //		echo "<pre><center>".$sql;
    //pesquisa principal			
    $qry = odbc_exec($connP, $sql);
    while ($row = odbc_fetch_array($qry)){
            $i = $row['id'];
            $ix = $row['id_xpert'] ;
    
            $sqlX = "SELECT DISTINCT id_entidade FROM med_vendas_cliente 
            WHERE id_entidade > 0 AND  id_filial = $ix 
            AND id_entidade IN (0 $ixc[$i]) AND year(dtaconta) = $periodo $fmes2";
        //		echo "<pre><center>".$sqlX;
            $qryX = odbc_exec($connP, $sqlX);
            $v2[$i] = odbc_num_rows($qryX);
    
            $sqlX = "SELECT sum(qtde) AS qtde, sum(total) AS total FROM med_vendas_cliente 
            WHERE id_entidade > 0 AND  id_filial = $ix
            AND id_entidade IN (0 $ixc[$i]) AND year(dtaconta) = $periodo $fmes2 ";
        //		echo "<pre><center>$sqlX</pre>" ;
            $qryX = odbc_exec($connP, $sqlX);
            $rowX = odbc_fetch_array($qryX);
            $v3[$i] = $rowX['qtde'];
            $v4[$i] = $rowX['qtde']/$ultMes;
            $vac[$i] = 0;
    
        if ( $v1[$i] <> 0 ) { $vac[$i] = $v2[$i]/$v1[$i]*100; }
    
        $link = "analiseVendas($ix);";
        $txtTabela = $txtTabela.'
            <tr>
                <th width="50" title="'.$ix.'"><center><a href="#void" onClick="'.$link.'">'.$row['loginName'].'</a></th>
                <th ><center>'.($v1[$i]).'</th>
                <th ><center>'.($v2[$i]).'</th>
                <th sorttable_customkey="'.$vac[$i].'"><center>'.($vac[$i]).' %</th>
                <th sorttable_customkey="'.$v3[$i].'"><center>'.($v3[$i]).'</th>
                <th sorttable_customkey="'.$v4[$i].'"><center>'.($v4[$i]).'</th>
            </tr>';
    
            $tv1 = $tv1 + $v1[$i];
            $tv2 = $tv2 + $v2[$i];
            $tv3 = $tv3 + $v3[$i];
            $tv4 = $tv4 + $v4[$i];
    }
        
        //TOTAIS
        $txtTabela = $txtTabela.'
        </tbody>
        <tfoot>
            <tr >
                <th bgcolor="#6699CC" ><center>TOTAIS</th>
                <th bgcolor="#6699CC" > <center>'.($tv1).'</th>
                <th bgcolor="#6699CC" > <center>'.($tv2).'</th>
                <th bgcolor="#6699CC" > <center>'.($tv2/$tv1*100).' %</th>
                <th bgcolor="#6699CC" > <center>'.($tv3).'</th>
                <th bgcolor="#6699CC" > <center>'.($tv4).'</th>
            </tr>
        </tfoot>';
}else{

    header("https://www.rdppetroleo.com.br/medwebnovo/?p=12");
    
}
