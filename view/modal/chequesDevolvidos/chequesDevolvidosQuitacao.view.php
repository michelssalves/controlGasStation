<!--MODAL CONFIRMA��O DE QUITA��O ENTEDER PFIN E OUTRO-->
<div class="modal fade" id="comfirmarQuitacaoModal" tabindex="-1" aria-labelledby="comfirmarQuitacaoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="fundo-cabecalho">
                <h1>QUITAR?</h1>
            </div>
            <div class="modal-body">
                <form id="confirmarQuitacaoForm" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="p" value="2" required>
                    <input type="hidden" value="quitacao" name="action">
                    <input type="hidden" id="id_cheque_quitacao" name="idCheque" value="" required>
                    <div class="mb-3">
                        <p class="texto-de-alerta">� OBRIGAT�RIO ANEXAR O DOCUMENTO COMPROVAT�RIO DA EXCLUS�O NO SPC</p>
                        <label for="file" class="col-form-label">Comprovante:</label>
                        <input type="file" name="file" class="form-control" id="file" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-success btn-sm">Confirmar Quita��o?</button>
                        <button type="button" class="btn btn-outline-primary btn-sm" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--/MODAL CONFIRMA��O DE QUITA��O-->