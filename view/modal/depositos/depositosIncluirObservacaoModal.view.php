<!--MODAL INLCUIR OBS DEPOSITO-->
<div class="modal fade" id="incluirObservacaoModal" tabindex="-1" aria-labelledby="incluirObservacaoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="fundo-cabecalho">
                <h1>OBSERVAÇÃO</h1>
            </div>
            <div class="modal-body">
                <form id="obsDeposito" method="POST">
                    <input type="hidden" id="actionaObs" name="actionaObs" value="observacaoDeposito">
                    <input type="hidden" id="idDepositoObs" name="idDepositoObs" required>
                    <div class="input-group input-group-sm mb-3 ">
                        <span class="input-group-text" id="inputGroup-sizing">Observação:</span>
                        <textarea name="observacao" id="observacao" cols="60" rows="10" style="white-space: pre;" placeholder="Escreva..." required></textarea>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-sm" data-bs-dismiss="modal" onclick="salvarObservacao(this.form)">Gravar</button>
                <button type="submit" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" onclick="fecharModal(this.form.idDepositoObs.value)">Fechar</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!--/MODAL INLCUIR OBS DEPOSITO-->