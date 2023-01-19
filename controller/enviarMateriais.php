<?php
$action = $_REQUEST['action'];

//if ($action <> 'excluirProduto' && $action <> 'cadastrarProduto' && $action <> 'excluirProduto'&&$action <> 'excluirClasse' && $action <> 'alterarClasse' && $action <> 'buscarClasse' && $action <> 'incluirClasse' && $action <> 'verClasses' && $action  <> 'verProduto' && $action <> 'verEstoque'  &&  $action <> 'visualizarRequisicao' && $action <> 'atualizarQuantidades' &&  $action <> 'alterarRequisicao' && $action <> 'novoProdutoNoPedido' && $action <> 'excluirProdutoNoPedido' && $action <> 'confirmarEnvio' && $action <> 'alterarProdutoNoPedido' && $action <> 'verItemDoPedido') {
if($action == '' || $action == 'filtrar-materiais' || $action == 'limpar'){

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
  include 'view/modal/enviarMateriais/enviarMateriaisIncluirNoPedidoModal.view.php';
  include 'view/modal/enviarMateriais/enviarMateriaisAltExcNoPedidoModal.view.php';
  include 'view/modal/enviarMateriais/enviarMateriaisVisualizarEstoque.view.php';
  include 'view/modal/enviarMateriais/enviarMateriaisAltVerProdutoModal.view.php';
  include 'view/modal/enviarMateriais/enviarMateriaisCriarProdutoModal.view.php';
  include 'view/modal/enviarMateriais/enviarMateriaisCriarClasseModal.view.php';
  include 'view/modal/enviarMateriais/enviarMateriaisAltExcClasseModal.view.php';
   
}
if ($action == 'visualizarRequisicao') {

  include 'controllerAux/validaLogin.php';
  include 'controllerAux/functionsAuxiliar.php';
  include '../model/EnviarMateriais.php';


  $id_pedido = $_REQUEST['id'];

  $sql = "SELECT i.id AS id_item, * FROM REQ_ItemPedido AS i 
    LEFT JOIN REQ_Produto AS p ON i.id_produto = p.id
    WHERE id_pedido = $id_pedido AND status_item IS NULL";
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

    $sqlSaldo = "SELECT sum(qtde_baixada)AS baixas, 
    (SELECT TOP 1 data_da_baixa FROM REQ_BaixarProduto ORDER BY  data_da_baixa DESC) as dataDaBaixa 
    FROM REQ_BaixarProduto WHERE id_item = $id_item
    GROUP BY dataDaBaixa";
    $qrySaldo =  odbc_exec($connP, $sqlSaldo);
    $rowSaldo = odbc_fetch_array($qrySaldo);
    extract($rowSaldo);

    $saldo = $quant - $baixas;

    $linkAlterarProduto = "data-bs-dismiss='modal' onclick='excluirOuAlterar(this.id)'";
    $linkAlteraSaldo = "onkeyup='alterarQuantideMateriais(this.id, this.value)'";

    if ($saldo == 0) {

      $linkAlterarProduto = "";
      $linkAlteraSaldo = "readonly";
    }

    $txtTable .= "<tr>
                <input type='hidden' id='idPedidoVisualizar'value='$id_pedido'>
                <td id='$id_item' $linkAlterarProduto >$desc_produto</td>
                <td id='$id_item' $linkAlterarProduto >$quant</td>
                <td id='$id_item' $linkAlterarProduto >" . ($baixas) . "</td>
                <td id='$id_item' $linkAlterarProduto >$saldo</td>
                <td id='$id_item' $linkAlterarProduto >$qtde_atual</td>
                <td id='$id_item' $linkAlterarProduto >" . dma($dataDaBaixa) . "</td>
                <td id='$id_item' $linkAlterarProduto >$data_recebido</td>
                <td>
                <input id='$id_item' $linkAlteraSaldo type='text' class='form-control-sm' name='quantidade' value='$quant' style='width:60px'></td>
                </tr>";
  }
  $txtTable .= "
    </tbody>
  </table>
  ";

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
            <td>" . dma($data_hora) . "</td>
            <td>$usuario</td>
            <td>$obs</td>
            </tr>";
  }

  $txtTable .= "</tbody></table>"; echo utf8ize($txtTable);
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
    $sql1 = "INSERT INTO REQ_Pedido_obs (id_pedido, usuario, data_hora, obs) VALUES ('$id_pedido', '$usuarioLogado', '" . date('Y-m-d H:i') . "', '$obsNova')";
    odbc_exec($connP, $sql1);
  }

  /*$return = ['dados' =>  ($sql0)];

    echo json_encode($return);*/
}
if ($action == 'novoProdutoNoPedido') {

  include 'controllerAux/validaLogin.php';
  include 'controllerAux/functionsAuxiliar.php';
  include '../model/EnviarMateriais.php';

  $idProduto = $_REQUEST['idProduto'];
  $produto = $_REQUEST['produto'];
  $qtde = $_REQUEST['qtde'];
  $idPedido = $_REQUEST['idPedido'];

  $sql = "INSERT INTO REQ_ItemPedido (id_pedido, id_produto, desc_produto, quant) 
  VALUES ($idPedido, $idProduto, '$produto', $qtde)";
  $qry = odbc_exec($connP, $sql);

  $obsNova = 'Ítem Incluido (' . $produto . ') em ' . date('Y-m-d');
  $sqlObs = "INSERT INTO REQ_Pedido_obs (id_pedido, usuario, data_hora, obs) 
  VALUES ('$idPedido', '$usuarioLogado', '" . date('Y-m-d Hi') . "', '$obsNova')";
  $qryObs = odbc_exec($connP, $sqlObs);
}
if ($action == 'excluirProdutoNoPedido') {

  $idItem = $_REQUEST['idItem'];

  include 'controllerAux/validaLogin.php';
  include 'controllerAux/functionsAuxiliar.php';
  include '../model/EnviarMateriais.php';

  $sql = "UPDATE REQ_ItemPedido SET status_item = 'EXCLUIDO' WHERE id = $idItem";
  odbc_exec($connP, $sql);
}
if ($action == 'alterarProdutoNoPedido') {

  $idItem = $_REQUEST['idItem'];

    // falta fazer

  include 'controllerAux/validaLogin.php';
  include 'controllerAux/functionsAuxiliar.php';
  include '../model/EnviarMateriais.php';
}
if ($action == 'confirmarEnvio') {

  include 'controllerAux/validaLogin.php';
  include 'controllerAux/functionsAuxiliar.php';
  include '../model/EnviarMateriais.php';

  $idPedido = $_REQUEST['idPedido'];
  $descProduto = $_REQUEST['descProduto'];
  $idProduto = $_REQUEST['idProduto'];
  $idItem = $_REQUEST['idItem'];
  $qtdeOriginal = $_REQUEST['qtdeOriginal'];
  $qtde = $_REQUEST['qtde'];

  $sql = ("INSERT INTO REQ_BaixarProduto (id_pedido, id_item, id_produto, qtde_baixada, data_da_baixa) 
  VALUES('$idPedido', '$idItem', '$idProduto', '$qtde', '" . date('Y-m-d') . "')");
  odbc_exec($connP, $sql);

  $obsNova = "Enviado $qtde $descProduto em " . date('Y-m-d') . " ";
  $sqlObs = "INSERT INTO REQ_Pedido_obs (id_pedido, usuario, data_hora, obs) values ('$idPedido', '$usuarioLogado', '" . date('Y-m-d') . "', '$obsNova')";
  odbc_exec($connP, $sqlObs);


  // falta atualizar o saldo do estoque

}
if ($action == 'verItemDoPedido') {

  $idItem = $_REQUEST['idItem'];

  include 'controllerAux/validaLogin.php';
  include 'controllerAux/functionsAuxiliar.php';
  include '../model/EnviarMateriais.php';

  $sql =  "SELECT  RP.id AS idProduto, RP.descricao AS produto, RP.classe,RC.id AS idClasse, RC.descricao AS classe, RI.quant 
  FROM REQ_Produto AS RP
  JOIN REQ_ClasseProduto AS RC
  ON RP.classe = RC.id
  JOIN REQ_ItemPedido AS RI
  ON RP.id = RI.id_produto 
  WHERE RI.id = $idItem";
  $qry = odbc_exec($connP, $sql);
  $row = odbc_fetch_array($qry);

  $return = ['dados' =>  utf8ize($row)];

  echo json_encode($return);
}
if($action == 'verEstoque'){

  include 'controllerAux/validaLogin.php';
  include 'controllerAux/functionsAuxiliar.php';
  include '../model/EnviarMateriais.php';

  $sql = "SELECT  p.id AS idProduto, p.descricao AS produto, c.descricao AS classe, unidade, P.qtde_atual, P.qtde_min, P.status
  FROM REQ_Produto AS P 
  LEFT JOIN REQ_ClasseProduto AS C ON p.classe = c.id 
  WHERE p.descricao IS NOT NULL AND status = 'ATIVO' AND qtde_atual > 0 
  ORDER BY Produto";
  $qry = odbc_exec($connP, $sql);

 $txtTable .= "<table class='table table-sm table-bordered border-dark'>
 <thead class='header-tabela'>
    	<tr>
        <th>Id</th>
        <th>Produto</th>
        <th>Saldo</th>
        <th>Min</th>
        <th>UN</th>
        <th>Classe</th>
        <th>Status</th>
        </tr>
    </thead>
    <tbody>";

    while ($row = odbc_fetch_array($qry)){
      
      extract($row);

      $txtTable .= "<tr id='$idProduto' data-bs-dismiss='modal' onclick='verAlterarProduto(this.id)' style='cursor:pointer'>
			<td>$idProduto</td>
			<td>$produto</td>
			<td>$qtde_atual</td>
			<td>$qtde_min</td>
			<td>$unidade</td>
			<td>$classe</td>
			<td>$status</td>
      </tr>";

  }
	
  $txtTable .= "</tbody></table>";echo utf8ize($txtTable);

}
if($action == 'verProduto'){

  include 'controllerAux/validaLogin.php';
  include 'controllerAux/functionsAuxiliar.php';
  include '../model/EnviarMateriais.php';

  $idProduto = $_REQUEST['idProduto'];

  $sql = "SELECT  p.id as idProduto, p.descricao AS produto, c.id as idClasse , c.descricao AS classe, unidade, P.qtde_atual, P.qtde_min, P.status
  FROM REQ_Produto AS P 
  LEFT JOIN REQ_ClasseProduto AS C ON p.classe = c.id 
  WHERE p.descricao IS NOT NULL AND idProduto = $idProduto";
  $qry = odbc_exec($connP, $sql);
  $row = odbc_fetch_array($qry);

  $return = ['dados' =>  utf8ize($row)];

  echo json_encode($return);

}
if($action == 'cadastrarProduto'){

  include 'controllerAux/validaLogin.php';
  include 'controllerAux/functionsAuxiliar.php';
  include '../model/EnviarMateriais.php';

   $unidadeCad = $_REQUEST['unidadeCad'];
   $produtoCad = $_REQUEST['produtoCad'];
   $idClasseCad = $_REQUEST['idClasseCad'];
   $statusCad = $_REQUEST['statusCad'];
   $qtdeAtualCad = $_REQUEST['qtdeAtualCad'];
   $qtdeMinCad = $_REQUEST['qtdeMinCad'];

   $sql = ("INSERT INTO REQ_Produto (unidade, descricao, classe, status, qtde_atual, qtde_min)
   VALUES('$unidadeCad','$produtoCad','$idClasseCad','$statusCad','$qtdeAtualCad','$qtdeMinCad')");
   odbc_exec($connP, $sql);

 

}
if($action == 'alterarProduto'){

  include 'controllerAux/validaLogin.php';
  include 'controllerAux/functionsAuxiliar.php';
  include '../model/EnviarMateriais.php';

  $unidadeAltProd = $_REQUEST['unidadeAltProd'];
  $produtoAltProd = $_REQUEST['produtoAltProd'];
  $classeAltProd = $_REQUEST['classeAltProd'];
  $statusAltProd = $_REQUEST['statusAltProd'];
  $qtdeAtualAltProd = $_REQUEST['qtdeAtualAltProd'];
  $qtdeMinAltProd = $_REQUEST['qtdeMinAltProd'];
  $idProdutoAltProd = $_REQUEST['idProdutoAltProd'];

  $sql = ("UPDATE REQ_Produto SET unidade = '$unidadeAltProd', descricao = '$produtoAltProd', classe = '$classeAltProd' , 
  status = '$statusAltProd' , qtde_atual = '$qtdeAtualAltProd', qtde_min = '$qtdeMinAltProd' WHERE id = '$idProdutoAltProd'");
  odbc_exec($connP, $sql);

  
}
if($action == 'verClasses'){

  include 'controllerAux/validaLogin.php';
  include 'controllerAux/functionsAuxiliar.php';
  include '../model/EnviarMateriais.php';

  $txtTable .="<table class='table table-sm table-bordered border-dark'>
  <thead class='header-tabela'>
        <th><center>ID</th>
        <th><center>DESCRICAO</th>
        <th><center>ITENS TOTAL</th>
        <th><center>ITENS ATIVOS</th>
    </tr>
 </thead>
  <tbody>";

  $sql = "SELECT DISTINCT c.id, c.descricao AS classe, 
  (SELECT count() FROM REQ_Produto AS p WHERE p.classe = c.id ) AS total,
  (SELECT count() FROM REQ_Produto AS p WHERE p.classe = c.id AND STATUS = 'ATIVO') AS ativos
  FROM REQ_ClasseProduto AS c WHERE statusClasse IS NULL
  ORDER BY classe" ;
  $qry = odbc_exec($connP, $sql) or die('Erro:'.$sql);

    while ($row = odbc_fetch_array($qry)) { 

      extract($row);

      $txtTable .="<tr id='$id' data-bs-dismiss='modal' onclick='AltExcClasse(this.id)' style='cursor:pointer'>
        <td>$id</td>
        <td>$classe</td>
        <td>$total</td>
        <td>$ativos</td>
        </tr>";

    } 

    $txtTable .="</tbody>
    </table>";

    echo utf8ize($txtTable);

}
if($action == 'incluirClasse'){

  include 'controllerAux/validaLogin.php';
  include 'controllerAux/functionsAuxiliar.php';
  include '../model/EnviarMateriais.php';

  $classe = strtoupper($_REQUEST['classe']);
	$sql = "INSERT INTO REQ_ClasseProduto (descricao) VALUES ('$classe')";
	odbc_exec($connP, $sql) or die('Erro:'.$sql);

}
if($action == 'buscarClasse'){

  include 'controllerAux/validaLogin.php';
  include 'controllerAux/functionsAuxiliar.php';
  include '../model/EnviarMateriais.php';

  $idClasse = $_REQUEST['idClasse'];

	$sql = "SELECT descricao FROM REQ_ClasseProduto WHERE id = $idClasse";
	$qry = odbc_exec($connP, $sql) or die('Erro:'.$sql);
  $row = odbc_fetch_array($qry);
  extract($row);

  $return = ['dados' => utf8ize($descricao) ];

  echo json_encode($return);

}
if($action == 'alterarClasse'){

  include 'controllerAux/validaLogin.php';
  include 'controllerAux/functionsAuxiliar.php';
  include '../model/EnviarMateriais.php';

  $idClasse = $_REQUEST['idClasse'];
  $classe = $_REQUEST['classe'];

  $sql = "UPDATE REQ_ClasseProduto SET descricao = '$classe' WHERE id = $idClasse";
  odbc_exec($connP, $sql) or die('Erro:'.$sql);


}
if($action == 'excluirClasse'){

  include 'controllerAux/validaLogin.php';
  include 'controllerAux/functionsAuxiliar.php';
  include '../model/EnviarMateriais.php';

  $idClasse = $_REQUEST['idClasse'];

  $sql = "UPDATE REQ_ClasseProduto SET statusClasse = 'INATIVO' WHERE id = $idClasse";
  odbc_exec($connP, $sql) or die('Erro:'.$sql);

}
