<!--MODAL PAGOU REQUISICAO-->
<div class="modal fade" id="acoesRequisicaoModal" tabindex="-1" aria-labelledby="acoesRequisicaoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="fundo-cabecalho">
        <h1>AÇÕES</h1>
      </div>
      <div class="modal-body">
        <form method="POST" enctype="multipart/form-data">
          <input type="hidden" name="p" value="5" required>
          <input type="hidden" id="id_requisicaoAcoes" name="id_requisicao" required>
          <div class="input-group input-group-sm mb-3">
              <span class="input-group-text" id="inputGroup-sizing">Descrição:</span>
              <select id="statusAcao" name="statusAcao" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                <option selected disabled value=''> SELECIONE O STATUS</option>
                <option value="1">P/ BAIXADO</option>
                <option value="2">P/ PFIN</option>
                <option value="3">P/ PAGO</option>
                <option value="4">P/ CANCELADO</option>
              </select>
            </div>
            <div class="input-group input-group-sm mb-3">
              <span class="input-group-text" id="inputGroup-sizing">Status:</span>
              <input readonly id="statusClienteAcoes" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
            </div>
            <div class="input-group input-group-sm mb-3">
              <span class="input-group-text" id="inputGroup-sizing">Documento:</span>
              <input readonly id="tipoAcoes" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
            </div>
            <div class="input-group input-group-sm mb-3">
              <span class="input-group-text" id="inputGroup-sizing">Descricao:</span>
              <input readonly id="clienteAcoes" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Numero do Documento" required>
            </div>
            <div class="input-group input-group-sm mb-3">
              <span class="input-group-text" id="inputGroup-sizing">Valor Inicial:</span>
              <input readonly id="valorAcoes" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
            </div>
            <input type="file" name="file" class="form-control" required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary btn-sm" data-bs-dismiss="modal">Fechar</button>
        <button type="submit" value="alterarStatus" name="action" class="btn btn-outline-success btn-sm">Confirmar</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!--/MODAL PAGOU REQUISICAO-->
