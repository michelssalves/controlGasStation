<?php
session_start();
$id = $_SESSION['id_u'];

$volumeMensalProjetado = new VolumeMensalProjetado();

$usuario = $volumeMensalProjetado->selectUserById($id);
//var_dump($usuario);

if ($usuario['nomeCompleto']) {
//pega valores passados
$acao = $_REQUEST['acao'];
$periodo = $_REQUEST['periodo'];

//include 'admin/filtrosAnalitico.php';

$mostraGNV = $_REQUEST['mostraGNV'];
$w = '5%';
if ($mostraGNV == 'checked') { $w = '4%'; }

if ($periodo == '') { $periodo = $mmm[intval(date('m'))].'-'.date('Y'); } 


//se botao limpar , coloca os valores padrão
if ($acao == 'limpar') 
{
	$periodo = $mmm[intval(date('m'))].'-'.date('Y');  
}
if($usuario['idXpert'] != 0){
	$filtroFilial = "AND id_filial = ".$usuario['idXpert'];
}
$mesP1 = '';
$anoP1 = substr($periodo, 4,4);
//acha numero do mes
for ($d=1;$d<=12;$d++)
{
    
	if ($mmm[$d] == substr($periodo, 0,3))
	{
		$mesP1 = $d;
	}

}

$mesP2 =  intval(date("m", strtotime("-1 month", strtotime($anoP1.'-'.$mesP1.'-01'))));
$anoP2 =  date("Y", strtotime("-1 month", strtotime($anoP1.'-'.$mesP1.'-01')));
$mesP3 =  intval(date("m", strtotime("-1 year", strtotime($anoP1.'-'.$mesP1.'-01'))));
$anoP3 =  date("Y", strtotime("-1 year", strtotime($anoP1.'-'.$mesP1.'-01')));

//mes atual/ano atual
$sql = "SELECT * FROM comprovantes_xpert WHERE data = '$anoP1-$mesP1-01' $filtroFilial ORDER BY id_filial, id_produtos";
$qry = odbc_exec($connP, $sql);
while ($row = odbc_fetch_array($qry))
{
	$f = $row['id_filial'];
	$p = $row['id_produtos'];
	$q1[$f][$p] = $row['quantidade'];
	$v1[$f][$p] = $row['valor'];
	$data_atu = $row['data_atu'];
	
}

//mes anterior
$sql = "SELECT * FROM comprovantes_xpert WHERE data = '$anoP2-$mesP2-01' $filtroFilial ORDER BY id_filial, id_produtos";
$qry = odbc_exec($connP, $sql);
while ($row = odbc_fetch_array($qry))
{
	$f = $row['id_filial'];
	$p = $row['id_produtos'];
	$q2[$f][$p] = $row['quantidade'];
	$v2[$f][$p] = $row['valor'];
}
//ano anterior
$sql = "SELECT * FROM comprovantes_xpert WHERE data = '$anoP3-$mesP3-01' $filtroFilial ORDER BY id_filial, id_produtos";
//echo "<center>".$sql;
$qry = odbc_exec($connP, $sql);
while ($row = odbc_fetch_array($qry))
{
	$f = $row['id_filial'];
	$p = $row['id_produtos'];
	$q3[$f][$p] = $row['quantidade'];
	$v3[$f][$p] = $row['valor'];
}
$x = date('Y-m-d'); 
//echo $data_atu;
//echo intval(substr($x,8,2));
//echo 'oi';
//calcula previsão
$atu_dia = intval(substr($data_atu,8,2));// esta pegando o dia da data atual
$ult_dia = date("t"); // Mágica, plim!//Consegue o ultimo dia do mes atual

$m = intval(date('m'));
$a = date('Y');
$mes_atu = $mmm[$m].'-'.$a;
//echo "<center>".$periodo ;
//echo "<br>".$mes_atu ;
$cols = 3;
$estilo = 'style="border-right:double;"';
echo $periodo;
if ($periodo == $mes_atu)
{
	$cb1 = '<th width="'.$w.'" Title="Mês Atual/Ano Atual Estimativa"    style="border-right:double;"bgcolor="#A0522D"><center>'.$mmm[$mesP1].'/'.substr($anoP1,2,2).'</th>';
	$cb2 = '<th width="'.$w.'" Title="Mês Atual/Ano Atual Estimativa"    style="border-right:double;"bgcolor="#A0522D"><center>'.$mmm[$mesP1].'/'.substr($anoP1,2,2).'</th>';
	$cb3 = '<th width="'.$w.'" Title="Mês Atual/Ano Atual Estimativa"    style="border-right:double;"bgcolor="#A0522D"><center>'.$mmm[$mesP1].'/'.substr($anoP1,2,2).'</th>';
	$cb4 = '<th width="'.$w.'" Title="Mês Atual/Ano Atual Estimativa"    style="border-right:double;"bgcolor="#A0522D"><center>'.$mmm[$mesP1].'/'.substr($anoP1,2,2).'</th>';
	$cb5 = '<th width="'.$w.'" Title="Mês Atual/Ano Atual Estimativa"    style="border-right:double;"bgcolor="#A0522D"><center>'.$mmm[$mesP1].'/'.substr($anoP1,2,2).'</th>';
	$cb6 = '<th width="'.$w.'" Title="Mês Atual/Ano Atual Estimativa"    style="border-right:double;"bgcolor="#A0522D"><center>'.$mmm[$mesP1].'/'.substr($anoP1,2,2).'</th>';
	$cb7 = '<th width="'.$w.'" Title="Mês Atual/Ano Atual Estimativa"    style="border-right:double;"bgcolor="#A0522D"><center>'.$mmm[$mesP1].'/'.substr($anoP1,2,2).'</th>';
	$cols = 4;
	$estilo = '';
	
}

//combo periodo
$sql = "SELECT DISTINCT data FROM comprovantes_xpert ORDER BY data DESC";
$qry = odbc_exec($connP, $sql);
while ($row = odbc_fetch_array($qry))
{	
	$m = intval(substr($row['data'],5,2));
	$a = substr($row['data'],0,4);
	$cbPeriodo =  $cbPeriodo."<option>$mmm[$m]-$a</option>";
}

//query principal
$fator = $atu_dia / $ult_dia; // fator  =  dia atual / ultimo dia do mes conseguimos esse valores na linha 89 e 90 

$sql = "SELECT id, loginName, id_xpert AS id_filial, * FROM rh_usuario 
			WHERE id_xpert > 0  AND gerenteDeRede IS NOT NULL
			$filtroFilial $frede
			ORDER BY loginName";
//echo "<pre><center>".$sql;
$qry = odbc_exec($connP, $sql);
while ($row = odbc_fetch_array($qry))
{
	$i = $row['id_xpert'];
	$ix = $row['id_xpert'] ;

if ($periodo == $mes_atu)
{
for ($p=1;$p<=6;$p++)
{ 
	$cb[$p] = '<th title="L: '.v0($q1[$i][$p]/$fator).'" ><center>'.v0(($q1[$i][$p]/$fator/1000)).'</th>';}
}

		$tm3 = $q3[$i][1] + $q3[$i][2] + $q3[$i][3] + $q3[$i][4] + $q3[$i][5];
		$tm2 = $q2[$i][1] + $q2[$i][2] + $q2[$i][3] + $q2[$i][4] + $q2[$i][5];
		$tm1 = $q1[$i][1] + $q1[$i][2] + $q1[$i][3] + $q1[$i][4] + $q1[$i][5];

		$tv3 = $v3[$i][1] + $v3[$i][2] + $v3[$i][3] + $v3[$i][4] + $v3[$i][5];
		$tv2 = $v2[$i][1] + $v2[$i][2] + $v2[$i][3] + $v2[$i][4] + $v2[$i][5];
		$tv1 = $v1[$i][1] + $v1[$i][2] + $v1[$i][3] + $v1[$i][4] + $v1[$i][5];



$txtTabela .= '
	<tr class="versalete12Azul">
		<th width="50"><center>'.$row['loginName'].'</th>';

//TOTAL
$txtTabela .= '
		<th title="L: '.v0($tm3).'&#13;$: '.v0($tv3).'" style="border-left:double;" > <center>'.v0(($tm3/1000)).'</th>
	    <th title="L: '.v0($tm2).'&#13;$: '.v0($tv2).'">                              <center>'.v0(($tm2/1000)).'</th>
	    <th title="L: '.v0($tm1).'&#13;$: '.v0($tv1).'">                              <center>'.v0(($tm1/1000)).'</th>';
if ($periodo == $mes_atu)
{
$txtTabela .= '
		<th title="'.v0(($tm1 / $atu_dia * $ult_dia)).'">                             <center>'.v0((($tm1 / $atu_dia * $ult_dia)/1000)).'</th>';
}


//GASOLINA COMUM		
$txtTabela .= '
	    <th title="L: '.v0($q3[$i][1]).'&#13;$: '.v0($v3[$i][1]).'" style="border-left:double;" > <center>'.v0(($q3[$i][1]/1000)).'</th>
	    <th title="L: '.v0($q2[$i][1]).'&#13;$: '.v0($v2[$i][1]).'">                              <center>'.v0(($q2[$i][1]/1000)).'</th>
	    <th title="L: '.v0($q1[$i][1]).'&#13;$: '.v0($v1[$i][1]).'">                              <center>'.v0(($q1[$i][1]/1000)).'</th>
		'.$cb[1];		

//GASOLINA ADITIVADA	
$txtTabela .= '
	    <th title="L: '.v0($q3[$i][2]).'&#13;$: '.v0($v3[$i][2]).'" style="border-left:double;" > <center>'.v0(($q3[$i][2]/1000)).'</th>
	    <th title="L: '.v0($q2[$i][2]).'&#13;$: '.v0($v2[$i][2]).'">                              <center>'.v0(($q2[$i][2]/1000)).'</th>
	    <th title="L: '.v0($q1[$i][2]).'&#13;$: '.v0($v1[$i][2]).'">                              <center>'.v0(($q1[$i][2]/1000)).'</th>
		'.$cb[2];	

//ETANOL 
$txtTabela .= '
	    <th title="L: '.v0($q3[$i][3]).'&#13;$: '.v0($v3[$i][3]).'" style="border-left:double;" > <center>'.v0(($q3[$i][3]/1000)).'</th>
	    <th title="L: '.v0($q2[$i][3]).'&#13;$: '.v0($v2[$i][3]).'">                              <center>'.v0(($q2[$i][3]/1000)).'</th>
	    <th title="L: '.v0($q1[$i][3]).'&#13;$: '.v0($v1[$i][3]).'">                              <center>'.v0(($q1[$i][3]/1000)).'</th>
		'.$cb[3];	

//DISELE S50
$txtTabela .= '
	    <th title="L: '.v0($q3[$i][4]).'&#13;$: '.v0($v3[$i][4]).'" style="border-left:double;" > <center>'.v0(($q3[$i][4]/1000)).'</th>
	    <th title="L: '.v0($q2[$i][4]).'&#13;$: '.v0($v2[$i][4]).'">                              <center>'.v0(($q2[$i][4]/1000)).'</th>
	    <th title="L: '.v0($q1[$i][4]).'&#13;$: '.v0($v1[$i][4]).'">                              <center>'.v0(($q1[$i][4]/1000)).'</th>
		'.$cb[4];	
		
//DIESEL S10		
$txtTabela .= '
	    <th title="L: '.v0($q3[$i][5]).'&#13;$: '.v0($v3[$i][5]).'" style="border-left:double;" > <center>'.v0(($q3[$i][5]/1000)).'</th>
	    <th title="L: '.v0($q2[$i][5]).'&#13;$: '.v0($v2[$i][5]).'">                              <center>'.v0(($q2[$i][5]/1000)).'</th>
	    <th title="L: '.v0($q1[$i][5]).'&#13;$: '.v0($v1[$i][5]).'">                              <center>'.v0(($q1[$i][5]/1000)).'</th>
		'.$cb[5];

		
if ($mostraGNV == 'checked') 
	{ 

//GNV
	$txtTabela .= '
		<th title="L: '.v0($q3[$i][6]).'&#13;$: '.v0($v3[$i][6]).'" style="border-left:double;" > <center>'.v0(($q3[$i][6]/1000)).'</th>
	    <th title="L: '.v0($q2[$i][6]).'&#13;$: '.v0($v2[$i][6]).'">                              <center>'.v0(($q2[$i][6]/1000)).'</th>
	    <th title="L: '.v0($q1[$i][6]).'&#13;$: '.v0($v1[$i][6]).'">                              <center>'.v0(($q1[$i][6]/1000)).'</th>
		'.$cb[6];
		
		$tm3 = $tm3 + $q3[$i][6];
		$tm2 = $tm2 + $q2[$i][6];
		$tm1 = $tm1 + $q1[$i][6];

		$tv3 = $tv3 + $v3[$i][6];
		$tv2 = $tv2 + $v2[$i][6];
		$tv1 = $tv1 + $v1[$i][6];

	}

	$txtTabela .= '</tr>';
		$tq3_1 = $tq3_1 + $q3[$i][1];
        $tq2_1 = $tq2_1 + $q2[$i][1];
        $tq1_1 = $tq1_1 + $q1[$i][1];
        $tq3_2 = $tq3_2 + $q3[$i][2];
        $tq2_2 = $tq2_2 + $q2[$i][2];
        $tq1_2 = $tq1_2 + $q1[$i][2];
        $tq3_3 = $tq3_3 + $q3[$i][3];
        $tq2_3 = $tq2_3 + $q2[$i][3];
        $tq1_3 = $tq1_3 + $q1[$i][3];
        $tq3_4 = $tq3_4 + $q3[$i][4];
        $tq2_4 = $tq2_4 + $q2[$i][4];
        $tq1_4 = $tq1_4 + $q1[$i][4];
        $tq3_5 = $tq3_5 + $q3[$i][5];
        $tq2_5 = $tq2_5 + $q2[$i][5];
        $tq1_5 = $tq1_5 + $q1[$i][5];
        $tq3_6 = $tq3_6 + $q3[$i][6];
        $tq2_6 = $tq2_6 + $q2[$i][6];
        $tq1_6 = $tq1_6 + $q1[$i][6];
		
		$ttm3 = $ttm3 + $tm3;
		$ttm2 = $ttm2 + $tm2;
		$ttm1 = $ttm1 + $tm1;

	}
 
//totais
	$base_1 = $tq1_1 ;
	$base_2 = $tq1_2 ;
	$base_3 = $tq1_3 ;
	$base_4 = $tq1_4 ;
	$base_5 = $tq1_5 ;
	$base_6 = $tq1_6 ;
	$base_7 = $ttm1;

if ($periodo == $mes_atu)
{

	$base_1 = $tq1_1 / $atu_dia * $ult_dia;
	$base_2 = $tq1_2 / $atu_dia * $ult_dia;
	$base_3 = $tq1_3 / $atu_dia * $ult_dia;
	$base_4 = $tq1_4 / $atu_dia * $ult_dia;
	$base_5 = $tq1_5 / $atu_dia * $ult_dia;
	$base_6 = $tq1_6 / $atu_dia * $ult_dia;
	$base_7 = $ttm1  / $atu_dia * $ult_dia;

	$cb1 = '<th  bgcolor="#6699CC" title="'.v0($base_1).'" ><center>'.v0(($base_1/1000)).'</th>';
	$cb2 = '<th  bgcolor="#6699CC" title="'.v0($base_2).'" ><center>'.v0(($base_2/1000)).'</th>';
	$cb3 = '<th  bgcolor="#6699CC" title="'.v0($base_3).'" ><center>'.v0(($base_3/1000)).'</th>';
	$cb4 = '<th  bgcolor="#6699CC" title="'.v0($base_4).'" ><center>'.v0(($base_4/1000)).'</th>';
	$cb5 = '<th  bgcolor="#6699CC" title="'.v0($base_5).'" ><center>'.v0(($base_5/1000)).'</th>';
	$cb6 = '<th  bgcolor="#6699CC" title="'.v0($base_6).'" ><center>'.v0(($base_6/1000)).'</th>';
	$cb7 = '<th  bgcolor="#6699CC" title="'.v0($base_7).'" ><center>'.v0(($base_7/1000)).'</th>';


	$p1 = '<th  bgcolor="#8FBC8F" title="'.v0($base_1).'" ><center>100,0</th>';
	$p2 = '<th  bgcolor="#8FBC8F" title="'.v0($base_2).'" ><center>100,0</th>';
	$p3 = '<th  bgcolor="#8FBC8F" title="'.v0($base_3).'" ><center>100,0</th>';
	$p4 = '<th  bgcolor="#8FBC8F" title="'.v0($base_4).'" ><center>100,0</th>';
	$p5 = '<th  bgcolor="#8FBC8F" title="'.v0($base_5).'" ><center>100,0</th>';
	$p6 = '<th  bgcolor="#8FBC8F" title="'.v0($base_6).'" ><center>100,0</th>';
	$p7 = '<th  bgcolor="#8FBC8F" title="'.v0($base_7).'" ><center>100,0</th>';

	$t1 = 'title="'.v0($base_1/1000).' é '.v1($base_1/($ttm1/ $atu_dia * $ult_dia)*100).'% de '.v0($ttm1/ $atu_dia * $ult_dia/1000).'"';
	$t2 = 'title="'.v0($base_2/1000).' é '.v1($base_2/($ttm1/ $atu_dia * $ult_dia)*100).'% de '.v0($ttm1/ $atu_dia * $ult_dia/1000).'"';
	$t3 = 'title="'.v0($base_3/1000).' é '.v1($base_3/($ttm1/ $atu_dia * $ult_dia)*100).'% de '.v0($ttm1/ $atu_dia * $ult_dia/1000).'"';
	$t4 = 'title="'.v0($base_4/1000).' é '.v1($base_4/($ttm1/ $atu_dia * $ult_dia)*100).'% de '.v0($ttm1/ $atu_dia * $ult_dia/1000).'"';
	$t5 = 'title="'.v0($base_5/1000).' é '.v1($base_5/($ttm1/ $atu_dia * $ult_dia)*100).'% de '.v0($ttm1/ $atu_dia * $ult_dia/1000).'"';
	$t6 = 'title="'.v0($base_6/1000).' é '.v1($base_6/($ttm1/ $atu_dia * $ult_dia)*100).'% de '.v0($ttm1/ $atu_dia * $ult_dia/1000).'"';
	$t7 = 'title="'.v0($base_7/1000).' é '.v1($base_7/($ttm1/ $atu_dia * $ult_dia)*100).'% de '.v0($ttm1/ $atu_dia * $ult_dia/1000).'"';


}

//TOTAIS
	$txtTabela .='<tr>
		<th bgcolor="#6699CC" ><center>TOTAIS</th>
		<th bgcolor="#6699CC" title="'.v0($ttm3).'" style="border-left:double;" > <center>'.v0(($ttm3/1000)).'</th>
	    <th bgcolor="#6699CC" title="'.v0($ttm2).'">                              <center>'.v0(($ttm2/1000)).'</th>
	    <th bgcolor="#6699CC" title="'.v0($ttm1).'">                              <center>'.v0(($ttm1/1000)).'</th>
		'.$cb7;


	$txtTabela.='
		<th bgcolor="#6699CC" title="'.v0($tq3_1).'" style="border-left:double;" > <center>'.v0(($tq3_1/1000)).'</th>
	    <th bgcolor="#6699CC" title="'.v0($tq2_1).'">                              <center>'.v0(($tq2_1/1000)).'</th>
	    <th bgcolor="#6699CC" title="'.v0($tq1_1).'">                              <center>'.v0(($tq1_1/1000)).'</th>
		'.$cb1.'
		';
		
	$txtTabela.='
		<th bgcolor="#6699CC" title="'.v0($tq3_2).'" style="border-left:double;" > <center>'.v0(($tq3_2/1000)).'</th>
	    <th bgcolor="#6699CC" title="'.v0($tq2_2).'">                              <center>'.v0(($tq2_2/1000)).'</th>
	    <th bgcolor="#6699CC" title="'.v0($tq1_2).'">                              <center>'.v0(($tq1_2/1000)).'</th>
		'.$cb2.'
		';
		
	$txtTabela.='
		<th bgcolor="#6699CC" title="'.v0($tq3_3).'" style="border-left:double;" > <center>'.v0(($tq3_3/1000)).'</th>
	    <th bgcolor="#6699CC" title="'.v0($tq2_3).'">                              <center>'.v0(($tq2_3/1000)).'</th>
	    <th bgcolor="#6699CC" title="'.v0($tq1_3).'">                              <center>'.v0(($tq1_3/1000)).'</th>
		'.$cb3.'
		';
		
	$txtTabela .='
		<th bgcolor="#6699CC" title="'.v0($tq3_4).'" style="border-left:double;" > <center>'.v0(($tq3_4/1000)).'</th>
	    <th bgcolor="#6699CC" title="'.v0($tq2_4).'">                              <center>'.v0(($tq2_4/1000)).'</th>
	    <th bgcolor="#6699CC" title="'.v0($tq1_4).'">                              <center>'.v0(($tq1_4/1000)).'</th>
		'.$cb4.'
		';
		
	$txtTabela.='
		<th bgcolor="#6699CC" title="'.v0($tq3_5).'" style="border-left:double;" > <center>'.v0(($tq3_5/1000)).'</th>
	    <th bgcolor="#6699CC" title="'.v0($tq2_5).'">                              <center>'.v0(($tq2_5/1000)).'</th>
	    <th bgcolor="#6699CC" title="'.v0($tq1_5).'">                              <center>'.v0(($tq1_5/1000)).'</th>
		'.$cb5.'';

if ($mostraGNV == 'checked') 
	{ 
	$txtTabela .= '<th bgcolor="#6699CC" title="'.v0($tq3_6).'" style="border-left:double;" > <center>'.v0(($tq3_6/1000)).'</th>
	    <th bgcolor="#6699CC" title="'.v0($tq2_6).'">                              <center>'.v0(($tq2_6/1000)).'</th>
	    <th bgcolor="#6699CC" title="'.v0($tq1_6).'">                              <center>'.v0(($tq1_6/1000)).'</th>
		'.$cb6.'
		';
	}		

	$txtTabela .= '</tr>';


//Percentual sobre o volume do produto vendido no mes de referência
	$txtTabela .='<tr>
		<th bgcolor="#8FBC8F" title="Percentual sobre o volume do produto vendido no mes de referência"><center>%Mes/Prod</th>
		<th bgcolor="#8FBC8F" title="'.v0($ttm3).'" style="border-left:double;" > <center>'.v0(($ttm3/$ttm1*100),1,',','.').'</th>
	    <th bgcolor="#8FBC8F" title="'.v0($ttm2).'">                              <center>'.v0(($ttm2/$ttm1*100),1,',','.').'</th>
	    <th bgcolor="#8FBC8F" title="'.v0($ttm1).'"  ><center>'.v0(($ttm1/$base_7*100),1,',','.').'</th>
		'.$p7.'';

	$txtTabela .='<th bgcolor="#8FBC8F" title="'.v0($tq3_1).'" style="border-left:double;" > <center>'.v0(($tq3_1/$base_1*100),1,',','.').'</th>
	    <th bgcolor="#8FBC8F" title="'.v0($tq2_1).'">                              <center>'.v0(($tq2_1/$base_1*100),1,',','.').'</th>
	    <th bgcolor="#8FBC8F" title="'.v0($tq1_1).'"  ><center>'.v0(($tq1_1/$base_1*100),1,',','.').'</th>
		'.$p1.'';
		
	$txtTabela .='<th bgcolor="#8FBC8F" title="'.v0($tq3_2).'" style="border-left:double;" > <center>'.v0(($tq3_2/$base_2*100),1,',','.').'</th>
	<th bgcolor="#8FBC8F" title="'.v0($tq2_2).'">                              <center>'.v0(($tq2_2/$base_2*100),1,',','.').'</th>
	<th bgcolor="#8FBC8F" title="'.v0($tq1_2).'"><center>'.v0(($tq1_2/$base_2*100),1,',','.').'</th>
	'.$p2.'
	';
	
	$txtTabela .='<th bgcolor="#8FBC8F" title="'.v0($tq3_3).'" style="border-left:double;" > <center>'.v0(($tq3_3/$base_3*100),1,',','.').'</th>
	<th bgcolor="#8FBC8F" title="'.v0($tq2_3).'">                              <center>'.v0(($tq2_3/$base_3*100),1,',','.').'</th>
	<th bgcolor="#8FBC8F" title="'.v0($tq1_3).'"  ><center>'.v0(($tq1_3/$base_3*100),1,',','.').'</th>
	'.$p3.'';
	
	$txtTabela .='<th bgcolor="#8FBC8F" title="'.v0($tq3_4).'" style="border-left:double;" > <center>'.v0(($tq3_4/$base_4*100),1,',','.').'</th>
	<th bgcolor="#8FBC8F" title="'.v0($tq2_4).'">                              <center>'.v0(($tq2_4/$base_4*100),1,',','.').'</th>
	<th bgcolor="#8FBC8F" title="'.v0($tq1_4).'" ><center>'.v0(($tq1_4/$base_4*100),1,',','.').'</th>
	'.$p4.'';
	
	$txtTabela .='<th bgcolor="#8FBC8F" title="'.v0($tq3_5).'" style="border-left:double;" > <center>'.v0(($tq3_5/$base_5*100),1,',','.').'</th>
		<th bgcolor="#8FBC8F" title="'.v0($tq2_5).'">                              <center>'.v0(($tq2_5/$base_5*100),1,',','.').'</th>
		<th bgcolor="#8FBC8F" title="'.v0($tq1_5).'" ><center>'.v0(($tq1_5/$base_5*100),1,',','.').'</th>
		'.$p5.'
		';

if ($mostraGNV == 'checked') 
	{ 
	$txtTabela .='
		<th bgcolor="#8FBC8F" title="'.v0($tq3_6).'" style="border-left:double;" > <center>'.v0(($tq3_6/$base_6*100),1,',','.').'</th>
	    <th bgcolor="#8FBC8F" title="'.v0($tq2_6).'">                              <center>'.v0(($tq2_6/$base_6*100),1,',','.').'</th>
	    <th bgcolor="#8FBC8F" title="'.v0($tq1_6).'" ><center>'.v0(($tq1_6/$base_6*100),1,',','.').'</th>
		'.$p6.'
		';
	}		

	$txtTabela .='</tr>';

	if ($periodo == $mes_atu)
	{
	$pp1 = '<th  bgcolor="#98FB98" '.$t1.' ><center>'.v1($base_1/($ttm1/ $atu_dia * $ult_dia)*100).'</th>';
	$pp2 = '<th  bgcolor="#98FB98" '.$t2.' ><center>'.v1($base_2/($ttm1/ $atu_dia * $ult_dia)*100).'</th>';
	$pp3 = '<th  bgcolor="#98FB98" '.$t3.' ><center>'.v1($base_3/($ttm1/ $atu_dia * $ult_dia)*100).'</th>';
	$pp4 = '<th  bgcolor="#98FB98" '.$t4.' ><center>'.v1($base_4/($ttm1/ $atu_dia * $ult_dia)*100).'</th>';
	$pp5 = '<th  bgcolor="#98FB98" '.$t5.' ><center>'.v1($base_5/($ttm1/ $atu_dia * $ult_dia)*100).'</th>';
	$pp6 = '<th  bgcolor="#98FB98" '.$t6.' ><center>'.v1($base_6/($ttm1/ $atu_dia * $ult_dia)*100).'</th>';
	$pp7 = '<th  bgcolor="#98FB98" '.$t7.' ><center>'.v1($base_7/($ttm1/ $atu_dia * $ult_dia)*100).'</th>';
	}
	//Percentual do produto sobre o volume Total

	$t1_1 = 'title="'.v0($tq1_1/1000).' é '.v1($tq1_1/($ttm1)*100).'% de '.v0($ttm1/1000).'"';
	$t1_2 = 'title="'.v0($tq2_1/1000).' é '.v1($tq2_1/($ttm2)*100).'% de '.v0($ttm2/1000).'"';
	$t1_3 = 'title="'.v0($tq3_1/1000).' é '.v1($tq3_1/($ttm3)*100).'% de '.v0($ttm3/1000).'"';

	$txtTabela .='<tr >
		<th bgcolor="#98FB98" title="Percentual do produto sobre o volume Total"><center>%Prod/Total</th>
		<th bgcolor="#98FB98" title="'.v0($ttm3).'" style="border-left:double;" > <center>'.v1(($ttm3/$ttm3*100),1,',','.').'</th>
	    <th bgcolor="#98FB98" title="'.v0($ttm2).'">                              <center>'.v1(($ttm2/$ttm2*100),1,',','.').'</th>
	    <th bgcolor="#98FB98" title="'.v0($ttm1).'">							  <center>'.v1(($ttm1/$ttm1*100),1,',','.').'</th>
		'.$pp7.'
		';

	$txtTabela .='
		<th bgcolor="#98FB98" '.$t1_3.' style="border-left:double;" > <center>'.v1(($tq3_1/$ttm3*100),1,',','.').'</th>
	    <th bgcolor="#98FB98" '.$t1_3.'>                              <center>'.v1(($tq2_1/$ttm2*100),1,',','.').'</th>
	    <th bgcolor="#98FB98" '.$t1_1.'>                              <center>'.v1(($tq1_1/$ttm1*100),1,',','.').'</th>
		'.$pp1.'
		';

	$t2_1 = 'title="'.v0($tq1_2/1000).' é '.v1($tq1_2/($ttm1)*100).'% de '.v0($ttm1/1000).'"';
	$t2_2 = 'title="'.v0($tq2_2/1000).' é '.v1($tq2_2/($ttm2)*100).'% de '.v0($ttm2/1000).'"';
	$t2_3 = 'title="'.v0($tq3_2/1000).' é '.v1($tq3_2/($ttm3)*100).'% de '.v0($ttm3/1000).'"';
		
	$txtTabela .='
		<th bgcolor="#98FB98" '.$t2_3.' style="border-left:double;" > <center>'.v1(($tq3_2/$ttm3*100),1,',','.').'</th>
	    <th bgcolor="#98FB98" '.$t2_2.'>                              <center>'.v1(($tq2_2/$ttm2*100),1,',','.').'</th>
	    <th bgcolor="#98FB98" '.$t2_1.'>                              <center>'.v1(($tq1_2/$ttm1*100),1,',','.').'</th>
		'.$pp2.'
		';
		
	$t3_1 = 'title="'.v0($tq1_3/1000).' é '.v1($tq1_3/($ttm1)*100).'% de '.v0($ttm1/1000).'"';
	$t3_2 = 'title="'.v0($tq2_3/1000).' é '.v1($tq2_3/($ttm2)*100).'% de '.v0($ttm2/1000).'"';
	$t3_3 = 'title="'.v0($tq3_3/1000).' é '.v1($tq3_3/($ttm3)*100).'% de '.v0($ttm3/1000).'"';
	
	$txtTabela .='
		<th bgcolor="#98FB98" '.$t3_3.' style="border-left:double;" > <center>'.v1(($tq3_3/$ttm3*100),1,',','.').'</th>
	    <th bgcolor="#98FB98" '.$t3_2.'>                              <center>'.v1(($tq2_3/$ttm2*100),1,',','.').'</th>
	    <th bgcolor="#98FB98" '.$t3_1.'>                              <center>'.v1(($tq1_3/$ttm1*100),1,',','.').'</th>
		'.$pp3.'
		';
		
	$t4_1 = 'title="'.v0($tq1_4/1000).' é '.v1($tq1_4/($ttm1)*100).'% de '.v0($ttm1/1000).'"';
	$t4_2 = 'title="'.v0($tq2_4/1000).' é '.v1($tq2_4/($ttm2)*100).'% de '.v0($ttm2/1000).'"';
	$t4_3 = 'title="'.v0($tq3_4/1000).' é '.v1($tq3_4/($ttm3)*100).'% de '.v0($ttm3/1000).'"';
	
	$txtTabela .='
		<th bgcolor="#98FB98" '.$t4_3.' style="border-left:double;" > <center>'.v1(($tq3_4/$ttm3*100),1,',','.').'</th>
	    <th bgcolor="#98FB98" '.$t4_2.'>                              <center>'.v1(($tq2_4/$ttm2*100),1,',','.').'</th>
	    <th bgcolor="#98FB98" '.$t4_1.'>                              <center>'.v1(($tq1_4/$ttm1*100),1,',','.').'</th>
		'.$pp4.'
		';
		
	$t5_1 = 'title="'.v0($tq1_5/1000).' é '.v1($tq1_5/($ttm1)*100).'% de '.v0($ttm1/1000).'"';
	$t5_2 = 'title="'.v0($tq2_5/1000).' é '.v1($tq2_5/($ttm2)*100).'% de '.v0($ttm2/1000).'"';
	$t5_3 = 'title="'.v0($tq3_5/1000).' é '.v1($tq3_5/($ttm3)*100).'% de '.v0($ttm3/1000).'"';
	
	$txtTabela .='
		<th bgcolor="#98FB98" '.$t5_3.' style="border-left:double;" > <center>'.v1(($tq3_5/$ttm3*100),1,',','.').'</th>
	    <th bgcolor="#98FB98" '.$t5_2.'>                              <center>'.v1(($tq2_5/$ttm2*100),1,',','.').'</th>
	    <th bgcolor="#98FB98" '.$t5_1.'>                              <center>'.v1(($tq1_5/$ttm1*100),1,',','.').'</th>
		'.$pp5.'
		';

if ($mostraGNV == 'checked') 
	{ 
	$t6_1 = 'title="'.v0($tq1_6/1000).' é '.v1($tq1_6/($ttm1)*100).'% de '.v0($ttm1/1000).'"';
	$t6_2 = 'title="'.v0($tq2_6/1000).' é '.v1($tq2_6/($ttm2)*100).'% de '.v0($ttm2/1000).'"';
	$t6_3 = 'title="'.v0($tq3_6/1000).' é '.v1($tq3_6/($ttm3)*100).'% de '.v0($ttm3/1000).'"';
	
	$txtTabela .='
		<th bgcolor="#98FB98" '.$t6_3.' style="border-left:double;" > <center>'.v1(($tq3_6/$ttm3*100),1,',','.').'</th>
	    <th bgcolor="#98FB98" '.$t6_2.'>                              <center>'.v1(($tq2_6/$ttm2*100),1,',','.').'</th>
	    <th bgcolor="#98FB98" '.$t6_1.'>                              <center>'.v1(($tq1_6/$ttm1*100),1,',','.').'</th>
		'.$pp6.'
		';
	}		

	$txtTabela .='</tr>';

}else{

    header("https://www.rdppetroleo.com.br/medwebnovo/?p=12");
    
}
