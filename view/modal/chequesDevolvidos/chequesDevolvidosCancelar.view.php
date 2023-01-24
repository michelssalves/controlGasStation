<!--MODAL CANCELAR CHEQUE-->
<div class="modal fade" id="cancelarChequeModal" tabindex="-1" aria-labelledby="cancelarChequeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="fundo-cabecalho">
                <h1>CANCELAR?</h1>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="p" value="2" required>
                    <input type="hidden" value="cancelar-cheque" id="actionCancelar" required>
                    <div class="input-group input-group-sm mb-3 ">
                        <span class="input-group-text" id="inputGroup-sizing">Id do Cheque:</span>
                        <input type="text" id="idChequeCancelar" name="idChequeCancelar" class="form-control" placeholder="Id" readonly required>
                    </div> 
                    <div class="input-group input-group-sm mb-3 ">
                        <span class="input-group-text" id="inputGroup-sizing">Observação:</span>
                        <textarea name="motivoCancelamento" id="motivoCancelamento" cols="60" rows="10" style="white-space: pre;" placeholder="Escreva o motivo" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" onclick="salvarCancelamento()">Cancelar</button>
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" onclick="fecharModal(this.form.idChequeCancelar.value)">Fechar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--/MODAL CANCELAR CHEQUE-->