<!--MODAL ALTERAR/EXCLUIR PRODUTO NA RM-->
<div class="modal fade bd-example-modal" id="excluirOuAlterarItem" tabindex="-1" aria-labelledby="excluirOuAlterarItemModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="fundo-cabecalho">
        <h1>AÇÕES NO ITEM</h1>
      </div>
      <div class="modal-body">
        <form method="POST">
            <input type="hidden" name="p" value="5" required>
            <input type="hidden" name="idPedido" id="idPedidoAltExc" required>
            <input type="hidden" name="idPedidoItem" id="idPedidoItemAltExc" required>
            <input type="hidden" name="qtdeOriginalAltExcItem" id="qtdeOriginalAltExcItem" required>
            <input type="hidden" name="idProdutoAltExcItem" id="idProdutoAltExcItem" required>
            <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Classe:</span>
            <input readonly id="fabricanteAltExcItem" name="fabricante" type="quant" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Produtos:</span>
            <input readonly id="produtosAltExcItem" name="produtos" type="quant" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="input-group input-group-sm mb-3 ">
            <span class="input-group-text" id="inputGroup-sizing">Qtde:</span>
            <input id="qtdeAltExcItem" name="quant" type="quant" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            </div>
      </div>
      <div class="modal-footer">
        <div class="d-flex gap-2 d-sm-flex mb-2 justify-content-md-center">
          <button type="button" class="btn btn-outline-success btn-sm" data-bs-dismiss="modal" onclick="confirmarEnvioItemDoPedido()">Enviado</button>
          <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal" onclick="excluirItemDoPedido()">Excluir</button>
          <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal" onclick="voltarVisualizarPedido(this.form.idPedido.value)">Fechar</button>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>
<!--MODAL ALTERAR/EXCLUIR PRODUTO NA RM-->