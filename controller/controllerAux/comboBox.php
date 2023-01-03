<?php
//MENU SELECT MEDS
$sql = "SELECT * FROM ti_clientes WHERE id_xpert > 0 $frede AND loginName IS NOT NULL ORDER BY loginName ";
$qry = odbc_exec($connP, $sql);
while ($row = odbc_fetch_array($qry)){

	$id_med = $row['id'];
	$nome_f[$id_med] = $row['loginName'];

	$cboMed.='<option value="'.$id_med.'">'.$nome_f[$id_med].'</option>';
}

//MENU SELECT MOTIVOS
foreach($arrayMotivo as $key => $row){

    $cod = $row['cod'];
	$desc = $row['desc'];

  $cboMotivos = $cboMotivos.'<option value="'.$cod.'">'.$desc.'</option>';
}

//MENU SELECT BANCO
foreach($arrayBanco as $key => $row){

    $cod = $row['cod'];
	$desc = $row['desc'];

  $cboBancos = $cboBancos.'<option value="'.$cod.'">'.$desc.'</option>';
}