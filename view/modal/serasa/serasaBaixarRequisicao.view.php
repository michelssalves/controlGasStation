<!--MODAL BAIXAR REQUISICAO-->
<div class="modal fade" id="baixarRequisicaoModal" tabindex="-1" aria-labelledby="baixarRequisicaoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="fundo-cabecalho">
        <h1>BAIXAR REQUISIÇÃO</h1>
      </div>
      <div class="modal-body">
        <form method="POST">
          <input type="hidden" name="p" value="5" required>
          <input type="hidden" id="id_requisicao1" name="id_requisicao" required>
          <div class="input-group input-group-sm mb-3">
              <span class="input-group-text" id="inputGroup-sizing">Status:</span>
              <input readonly id="statusCliente1" name="status" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
            </div>
            <div class="input-group input-group-sm mb-3">
              <span class="input-group-text" id="inputGroup-sizing">Documento:</span>
              <input readonly id="tipo1" name="tipo" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
            </div>
            <div class="input-group input-group-sm mb-3">
              <span class="input-group-text" id="inputGroup-sizing">Descricao:</span>
              <input readonly id="cliente1" name="nomeCliente" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Numero do Documento" required>
            </div>
            <div class="input-group input-group-sm mb-3">
              <span class="input-group-text" id="inputGroup-sizing">Valor Inicial:</span>
              <input readonly id="valor1" name="valor" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary btn-sm" data-bs-dismiss="modal">Fechar</button>
        <button type="submit" value="baixarRequisicao" name="action" class="btn btn-outline-success btn-sm" onclick="return confirm('Confirmar a SOLICITAÇÃO DE BAIXA?')">Salvar</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!--/MODAL BAIXAR REQUISICAO-->
