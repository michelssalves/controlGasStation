<!--MODAL INCLUIR ANEXO OK-->
<div class="modal fade" id="incluirAnexoModal" tabindex="-1" aria-labelledby="incluirAnexoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="fundo-cabecalho">
        <h1>INCLUIR ANEXO</h1>
      </div>
      <div class="modal-body">
        <form method="POST" enctype="multipart/form-data">
          <input type="hidden" name="p" value="4" required>
          <input type="text" id="id_anexo" name="id_requisicao" required>
          <div class="mb-3">
            <div class="input-group input-group-sm mb-3">
              <span class="input-group-text" id="inputGroup-sizing">Descrição:</span>
              <select id="descricao" name="descricao" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                <option selected disabled value=''> SELECIONE O TIPO DE ANEXO</option>
                <option>ABASTECE AÍ</option>
                <option>CAIXA GERAL</option>
                <option>CAIXA</option>
                <option>CHEQUE A VISTA</option>
                <option>CHEQUE PRÉ</option>
                <option>COMPROVANTE DE DEPÓSITO</option>
                <option>DECLARAÇÃO DE ENTREGA DE CUPOM</option>
                <option>DESPESAS</option>
                <option>PLANILHA DE DEPÓSITO</option>
                <option>POS</option>
                <option>REDUÇÃO Z</option>
                <option>RELATÓRIO DE DESCONTOS</option>
                <option>RESIDUAL</option>
                <option>TEF</option>
                <option>VALES</option>
              </select>
            </div>
            <br>
            <input type="file" name="file" class="form-control" required>
          </div>
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
