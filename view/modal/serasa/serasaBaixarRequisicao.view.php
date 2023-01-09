<!--MODAL BAIXAR REQUISICAO-->
<div class="modal fade" id="baixarRequisicaoModal" tabindex="-1" aria-labelledby="baixarRequisicaoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="fundo-cabecalho">
        <h1>BAIXAR REQUSIÇÃO</h1>
      </div>
      <div class="modal-body">
        <form method="POST" enctype="multipart/form-data">
          <input type="hidden" name="p" value="5" required>
          <input type="hidden" id="id_requisicao" name="id_requisicao" required>
            <div class="input-group input-group-sm mb-3">
              <span class="input-group-text" id="inputGroup-sizing">Descricao:</span>
              <input name="numDoc" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Numero do Documento" required>
            </div>
            <br>
            <input type="file" name="file" class="form-control" required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary btn-sm" data-bs-dismiss="modal">Fechar</button>
        <button type="submit" value="baixarRequisicao" name="action" class="btn btn-outline-success btn-sm">Salvar</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!--/MODAL BAIXAR REQUISICAO-->
