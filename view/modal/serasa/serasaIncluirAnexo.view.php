<!--MODAL INCLUIR ANEXO -->
<div class="modal fade" id="incluirAnexoModal" tabindex="-1" aria-labelledby="incluirAnexoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="fundo-cabecalho">
        <h1>INCLUIR ANEXO</h1>
      </div>
      <div class="modal-body">
        <form method="POST" enctype="multipart/form-data">
          <input type="hidden" name="p" value="5" required>
          <input type="hidden" id="id_anexo" name="id_requisicao" required>
          <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Descricao:</span>
            <input name="numDoc" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Numero do Documento" required>
          </div>
          <br>
          <input type="file" name="file" class="form-control" required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary btn-sm" data-bs-dismiss="modal">Fechar</button>
        <button type="submit" value="gravarAnexo" name="action" class="btn btn-outline-success btn-sm">Salvar</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!--/MODAL INCLUIR ANEXO-->