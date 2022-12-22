<?php
$action = $_REQUEST['action'];
/*

    $id_requisicao = $_REQUEST['id'];

    $row = selectFechamentoCaixaById($id_requisicao);

    $return = ['error' => false,  'dados' => $row];

    echo json_encode($return);
    */
if($action == 'editarModal'){
 
  $id_requisicao = $_REQUEST['id'];

    //include('chavesBD.php');

    $connP = odbc_connect( "sb-pedidos",'dba','rdp' );

    $sql = "SELECT 3, isnull(concBancaria, '') AS conc, isnull(f.fechaCaixa, '') AS caixa, u.id AS id_user, 
    u.loginName, u.controladorMed, f.id AS id_requisicao, f.obs, f.status, f.data_caixa, f.dep_dinheiro, f.dep_cheque, 
    f.dep_brinks, f.pix, f.turnos_definitivo, f.id_med
            FROM ccp_fechamentoCaixa AS f
            JOIN ti_clientes AS u ON f.id_med = u.id
            WHERE f.id = $id_requisicao ORDER BY f.data_caixa ASC";
           $qry = odbc_exec($connP, $sql);
           $row = odbc_fetch_array($qry);
            //var_dump($row);
           $return = ['error' => false,  'dados' => $row];

           echo json_encode($return);


}else{
    echo 'treta';
}
   

?>