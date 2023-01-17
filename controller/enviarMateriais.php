<?php
$action = $_REQUEST['action'];

if ($action <> 'visualizarRequisicao' && $action <> 'atualizarQuantidades') {

  $page =  $_REQUEST['page'];
  $statusNovo =  $_REQUEST['statusNovo'];
  $statusParcial =  $_REQUEST['statusParcial'];
  $statusEnviado =  $_REQUEST['statusEnviado'];
  $statusFinalizado =  $_REQUEST['statusFinalizado'];
  $statusCancelado =  $_REQUEST['statusCancelado'];
  $flagNovo = $statusNovo <> '' ? 'checked' : '';
  $flagParcial = $statusParcial <> '' ? 'checked' : '';
  $flagEnviado = $statusEnviado <> '' ? 'checked' : '';
  $flagFinalizado = $statusFinalizado <> '' ? 'checked' : '';
  $flagCancelado = $statusCancelado <> '' ? 'checked' : '';
  $med =  $_REQUEST['med'];
  $produto = $_REQUEST['produto'];

  if ($action == 'limpar') {

    $cliente = '0';
    $produto = '';
    $flagNovo = 'checked';
    $flagParcial = 'checked';
    $flagEnviado = '';
    $flagFinalizado = '';
    $flagCancelado = '';
  }
  if ($statusNovo == '' && $statusParcial == '' && $statusEnviado == '' && $statusFinalizado == '' && $statusCancelado == '') {
    $Fstatus =  "AND status = 'NOVO'";
  } else {
    $Fstatus =  "AND status IN ('" . $statusNovo . "','" . $statusParcial . "','" . $statusEnviado . "','" . $statusFinalizado . "','" . $statusCancelado . "')";
  }
  if (isset($med) && $med <> '0') {
    $Fmed = "AND codcliente = '$med' ";
  }
  if ($produto <> '') {
    $Fproduto = "AND lista LIKE '%$produto%' ";
  }

  $sql = "SELECT *, p.id AS id_pedido, 
        (SELECT count() FROM REQ_ItemPedido WHERE id_pedido = p.id) AS itens, 
        (SELECT list(desc_produto)FROM REQ_ItemPedido WHERE id_pedido = p.id) AS lista
    FROM REQ_Pedido AS p 
    LEFT JOIN ti_clientes AS u ON p.codcliente = u.id
    WHERE status <> 'CRIADO' AND p.id > 0  $Fstatus $Fmed $Fproduto";
  $qry = odbc_exec($connP, $sql) or die('Erro.:' . $sql);
  var_dump($sql);
  while ($row = odbc_fetch_array($qry)) {

    extract($row);

    $txtTable .=  "<tr id='$id_pedido' onclick='verRequisicaoMaterial(this.id)'>
				    <td>$id_pedido</td>
				    <td>$loginName</td>
				    <td>" . dma($row['data']) . "</td>
				    <td>" . ($data_entrega <> '' ? dma($data_entrega) : '') . "</td>
					<td>" . l50($row['lista']) . "</td>
					<td>" . l35($row['itens']) . "</td>
					<td>$itens_parcial</td>
					<td>$status</td>
				  </tr>";
  }
  include 'view/modal/enviarMateriais/enviarMateriaisVisualizarModal.view.php';
}
if ($action == 'visualizarRequisicao') {

  include 'controllerAux/validaLogin.php';
  include 'controllerAux/functionsAuxiliar.php';
  include '../model/EnviarMateriais.php';


  $id_pedido = $_REQUEST['id'];

  $sql = "SELECT i.id AS id_item, * FROM REQ_ItemPedido AS i 
    LEFT JOIN REQ_Produto AS p ON i.id_produto = p.id
    WHERE id_pedido = $id_pedido";
  $qry =  odbc_exec($connP, $sql) or die('Erro.:' . $sql);


  $sqlObs = "SELECT TOP 15 * FROM REQ_Pedido_obs WHERE id_pedido = $id_pedido ORDER BY id DESC";
  $qryObs = odbc_exec($connP, $sqlObs);

  $txtTable .= "<table class='table table-sm table-bordered border-dark'>
    <thead class='header-tabela'>
      <tr>
        <th>Material</th>
        <th>Qtde</th>
        <th>Entregue</th>
        <th>Saldo</th>
        <th>Estoque</th>
        <th>Dt Envio</th>
        <th>Dt Receb</th>
        <th>Qtde</th>
      </tr>
    </thead>
    <tbody>";


  while ($row = odbc_fetch_array($qry)) {

    extract($row);

    $saldo = $quant - $parcial;

    $txtTable .= "<tr >
                <form>
                <input type='hidden' id='id_pedido_alterar' name='id_pedido' value='$id_pedido'>
                <input type='hidden' name='id_produto' value='$id_produto'>
                <input type='hidden' name='id_item' value='$id_item'>
                <input type='hidden' name='desc_produto' value='$desc_produto'>
                <input type='hidden' name='quant_ant' value='$quant'>

                <td>$desc_produto</td>
                <td><center>$quant</td>
                <td><center>$parcial</td>
                <td><center>$saldo</td>
                <td><center>$qtde_atual</td>
                <td><center>$data_envio</td>
                <td><center>$data_recebido</td>
                <td><center>
                <input id='$id_item' onkeyup='teste(this.id, this.value)' type='text' class='form-control-sm' name='quantidade' value='$quant' style='width:60px'></td>
                </form>
                </tr>";
  }
  $txtTable .= "
    </tbody>
  </table>";

  $txtTable .= " <hr><br><table class='table table-sm table-bordered border-dark'>
  <thead class='header-tabela'>
    <tr>
      <th>Data Hora</th>
      <th>Usuario</th>
      <th>Alteração</th>
    </tr>
  </thead>
  <tbody>";

  while ($rowObs = odbc_fetch_array($qryObs)) {

    extract($rowObs);

    $txtTable .= "<tr >
            <td>".dma($data_hora)."</td>
            <td>$usuario</td>
            <td>$obs</td>
            </tr>";
  }

  $txtTable .= "
  </tbody>
</table>";

  echo utf8ize($txtTable);
}
if ($action == 'atualizarQuantidades') {

  include 'controllerAux/validaLogin.php';
  include 'controllerAux/functionsAuxiliar.php';
  include '../model/EnviarMateriais.php';

  $id_pedido = $_REQUEST['id_pedido'];
  $iditem = $_REQUEST['iditem'];
  $qtde = $_REQUEST['qtde'];

  $sql0 = "SELECT desc_produto, quant FROM REQ_ItemPedido AS i 
    LEFT JOIN REQ_Produto AS p ON i.id_produto = p.id
    WHERE i.id = $iditem";
  $qry0 = odbc_exec($connP, $sql0);
  $row0 = odbc_fetch_array($qry0);

  $desc_produto = $row0['desc_produto'];
  $quant_ant = $row0['quant'];

  $sql = "UPDATE REQ_ItemPedido SET quant = $qtde WHERE id = $iditem";
  $qry = odbc_exec($connP, $sql);
  if ($quant_ant <> $qtde) {
    $obsNova = 'Alterada a quantidade do item "' . $desc_produto . '" de ' . $quant_ant . ' para ' . $qtde;
    $sql1 = "INSERT INTO REQ_Pedido_obs (id_pedido, usuario, data_hora, obs) values ('$id_pedido', '$usuarioLogado', '" . date('Y-m-d H:i') . "', '$obsNova')";
    odbc_exec($connP, $sql1);
  }

  /*$return = ['dados' =>  ($sql0)];

    echo json_encode($return);*/
}
