<!--MODAL INLCUIR OBS DEPOSITO-->
<div class="modal fade" id="incluirObservacaoModal" tabindex="-1" aria-labelledby="incluirObservacaoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="fundo-cabecalho">
                <h1>INCLUIR OBSERVAÇÃO</h1>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <input type="hidden" name="p" value="3" required>
                    <input type="hidden" id="id_observacao" name="id_reg" required>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Observação:</span>
                        <textarea required rows="4" cols="50" class="form-control" name="textoObs" placeholder="Inclua aqui as informações e clique em gravar"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary btn-sm" data-bs-dismiss="modal">Fechar</button>
                <button type="submit" value="observacaoDeposito" name="action" class="btn btn-outline-danger btn-sm">Gravar</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!--/MODAL INLCUIR OBS DEPOSITO-->