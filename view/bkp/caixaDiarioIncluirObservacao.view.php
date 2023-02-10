<!--MODAL INCLUIR OBSERVA플O-->
<div class="modal fade" id="incluirObservacaoModal" tabindex="-1" aria-labelledby="incluirObservacaoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="fundo-cabecalho">
        <h1>INCLUIR OBSERVA플O</h1>
      </div>
      <div class="modal-body">
        <form id="incluirObservacaoForm" method="POST">
          <input type="hidden" name="p" value="4" required>
          <input type="hidden" id="id_observacao" name="id_requisicao" value="" required>
          <div class="mb-3">
            <p class="texto-de-advertencia">REGISTRE AQUI ALGUMA OBSERVA플O SOBRE ESTE CAIXA</p>
            <textarea name="observacao" cols="50" rows="10" style="white-space: pre;"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary btn-sm" data-bs-dismiss="modal">Fechar</button>
        <button value="gravarObservacao" name="action" type="submit" class="btn btn-outline-success btn-sm">Salvar</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!--/MODAL INCLUIR OBSERVA플O-->