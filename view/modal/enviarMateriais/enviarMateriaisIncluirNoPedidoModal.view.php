<!--MODAL INCLUIR PRODUTO NA RM-->
<div class="modal fade bd-example-modal" id="incluirItem" tabindex="-1" aria-labelledby="requisicaoMaterialModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="fundo-cabecalho">
        <h1>INCLUIR NO PEDIDO</h1>
      </div>
      <div class="modal-body">
        <form method="POST">
            <input type="hidden" name="p" value="5" required>
            <input type="hidden" name="idPedido" id="idPedidoIncluirItem" required>
            <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Classe:</span>
            <select id='fabricanteIncluirItem' name='fabricante' class='form-select' aria-label='Default select example'>
              <option value="<?= $id_classe; ?>"><?= $nome_classe; ?></option>
              <?php
              $sql = "SELECT * ,
                              (SELECT count() FROM REQ_Produto AS p WHERE p.classe = c.id AND status = 'ativo') AS num
                              FROM REQ_ClasseProduto AS c 
                              WHERE num > 0
                              ORDER BY descricao";
              $qry = odbc_exec($connP, $sql);
              while ($row = odbc_fetch_array($qry)) {
                echo '<option value="' . $row['id'] . '">' . $row['descricao'] . '</option>' . PHP_EOL;
              }
              ?>
            </select>
            </div>
            <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Produtos:</span>
            <select id='produtosIncluirItem' name='produtos' class='form-select' aria-label='Default select example'></select>
            <?php
            $n = 0;
            $qry = odbc_exec($connP, $sql);

            while ($row = odbc_fetch_array($qry)) {
              
              $n++;

              $div[$n] = '<div class="hidden produtos-f' . $row['id'] . '">';

              $sqlP = "SELECT * FROM REQ_Produto WHERE status = 'ativo' AND classe = " . $row['id'];
              $qryP = odbc_exec($connP, $sqlP);

              while ($rowP = odbc_fetch_array($qryP)) {

                $div[$n] = $div[$n] . "<option value='" . $rowP['id'] . "'>" . $rowP['descricao'] . "</option>";
              }

              $div[$n] = $div[$n] . "</div>";

            };

            for ($x = 1; $x <= $n; $x++) {

              echo $div[$x];

            }

            ?>
            </div>
            <div class="input-group input-group-sm mb-3 ">
            <span class="input-group-text" id="inputGroup-sizing">Qtde:</span>
            <input id="qtdeIncluirItem" name="quant" type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            </div>
      </div>
      <div class="modal-footer">
        <div class="d-flex gap-2 d-sm-flex mb-2 justify-content-md-center">
          <button type="button" class="btn btn-outline-primary btn-sm" data-bs-dismiss="modal" onclick="salvarProdutoNoPedido()">Incluir Produto</button>
          <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal" onclick="voltarVisualizarPedido(this.form.idPedido.value)">Fechar</button>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>
<!--MODAL INCLUIR PRODUTO NA RM-->