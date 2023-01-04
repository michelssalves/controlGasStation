<!--MODAL EDITAR CX DIÁRIO-->
<div class="modal fade" id="editarInformacoesModal" tabindex="-1" aria-labelledby="editarInformacoesModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="fundo-cabecalho">
        <h1>EDITAR CAIXA</h1>
      </div>
      <div class="modal-body">
        <form method="POST">
          <input type="hidden" name="p" value="4" required>
          <input type="hidden" id="edit_form" name="id_requisicao" required>
            <div class="input-group input-group-sm mb-3">
              <span class="input-group-text" id="inputGroup-sizing">Depósito dinheiro:</span>
              <input onkeypress="return soNumeros();" id="dep_dinheiro" name="dep_dinheiro" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
            </div>
            <div class="input-group input-group-sm mb-3">
              <span class="input-group-text" id="inputGroup-sizing">Depósito Cheque:</span>
              <input onkeypress="return soNumeros();"  id="dep_cheque" name="dep_cheque" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
            </div>
            <div class="input-group input-group-sm mb-3">
              <span class="input-group-text" id="inputGroup-sizing">Depósito Brinks:</span>
              <input onkeypress="return soNumeros();" id="dep_brinks" name="dep_brinks" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
            </div>
            <div class="input-group input-group-sm mb-3">
              <span class="input-group-text" id="inputGroup-sizing">Data do Caixa:</span>
              <input id="data_caixa" name="data_caixa" type="date" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
            </div>
            <div class="input-group input-group-sm mb-3">
              <span class="input-group-text" id="inputGroup-sizing">Turno em definitivo:</span>
              <select id="turnos_definitivo" name="turnos_definitivo" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                <option></option>
                <option>SIM</option>
                <option>NÃO</option>
              </select>
            </div>
            <div class="input-group input-group-sm mb-3">
              <span class="input-group-text" id="inputGroup-sizing">Observações:</span>
              <textarea style="white-space: pre;" cols="10" rows="5" id="obs" name="obs" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"><?= $obs ?></textarea>
            </div>
            <div class="input-group input-group-sm mb-3">
              <span class="input-group-text" id="inputGroup-sizing">Concialiação bancaria:</span>
              <select id="conc" name="conc" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                <option></option>
                <option>SIM</option>
              </select>
            </div>
            <div class="input-group input-group-sm mb-3">
              <span class="input-group-text" id="inputGroup-sizing">Fechamento caixa geral definitivo:</span>
              <select id='caixa' name='caixa' class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                <option>SIM</option>
                <option>NÃO</option>
              </select>
            </div>
      </div>
      <div class="modal-footer">
        <div class="d-flex gap-2 d-sm-flex mb-2 justify-content-md-center">
          <button type="button" class="btn btn-outline-primary btn-sm" data-bs-dismiss="modal">Fechar</button>
          <button type="submit" value="salvarAlteracoes" name="action" class="btn btn-outline-success btn-sm">Salvar</button>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>
<!--/MODAL EDITAR CX DIÁRIO-->