<!--MODAL INCLUIR PRODUTO NA RM-->
<div class="modal fade bd-example-modal" id="altVerProdutoEstoque" tabindex="-1" aria-labelledby="altVerProdutoEstoqueModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="fundo-cabecalho">
        <h1>PRODUTO</h1>
      </div>
      <div class="modal-body">
        <form method="POST">
          <input type="hidden" name="p" value="5" required>
          <input type="text" name="idProdutoAltProd" id="idProdutoAltProd" required>
          <div class="input-group input-group-sm mb-3">
            <div class="input-group input-group-sm mb-3 ">
              <span class="input-group-text" id="inputGroup-sizing">Produto:</span>
              <input id="produtoAltProd" name="produtoAltProd" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            </div>
            <span class="input-group-text" id="inputGroup-sizing">Unidade:</span>
            <select id='unidadeAltProd' name='unidadeAltProd' class='form-select' aria-label='Default select example'>
              <option>UNI</option>
              <option>KG</option>
              <option>M</option>
              <option>M2</option>
              <option>M3</option>
              <option>CX</option>
              <option>PCT</option>
            </select>
          </div>
          <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Classe:</span>
            <select id='classeAltProd' name='classeAltProd' class='form-select' aria-label='Default select example'>
              <?= $cboClasseProdutos; ?>
            </select>
          </div>
          <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Status:</span>
            <select id='statusAltProd' name='statusAltProd' class='form-select' aria-label='Default select example'>
              <option>ATIVO</option>
              <option>INATIVO</option>
            </select>
          </div>
          <div class="input-group input-group-sm mb-3 ">
            <span class="input-group-text" id="inputGroup-sizing">Saldo:</span>
            <input id="qtdeAtualAltProd" name="qtdeAtualAltProd" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
          </div>
          <div class="input-group input-group-sm mb-3 ">
            <span class="input-group-text" id="inputGroup-sizing">Qtde:</span>
            <input id="qtdeMinAltProd" name="qtdeMinAltProd" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
          </div>
      </div>
      <div class="modal-footer">
        <div class="d-flex gap-2 d-sm-flex mb-2 justify-content-md-center">
        <button type="button" class="btn btn-success btn-sm" data-bs-dismiss="modal" onclick="salvarAlteracaoProduto()">Alterar</button>
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" onclick="verEstoque()">Fechar</button>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>
<!--MODAL INCLUIR PRODUTO NA RM-->