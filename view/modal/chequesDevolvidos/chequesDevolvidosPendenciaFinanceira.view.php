<!--MODAL SEM SOLUÇÃO-->
<div class="modal fade" id="pendenciaFinanceira" tabindex="-1" aria-labelledby="pendenciaFinanceiraModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="fundo-cabecalho">
                <h1>PENDENTES</h1>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <input type="hidden" value="pendenciaFinanceira" name="actionPfin" id="actionPfin">
                    <input type="hidden" id="idChequePfin" name="idChequePfin" required>
                    <div class="input-group input-group-sm mb-3 ">
                        <span class="input-group-text" id="inputGroup-sizing">Observação:</span>
                        <textarea name="motivo" id="motivo" cols="60" rows="10" style="white-space: pre;"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-sm" data-bs-dismiss="modal" onclick="salvarConfirmarPfin()">Salvar</button>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" onclick="fecharModal(this.form.idChequePfin.value)">Fechar</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!--/MODAL SEM SOLUÇÃO-->