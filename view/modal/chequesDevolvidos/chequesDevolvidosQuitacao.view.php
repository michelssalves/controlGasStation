<!--MODAL CONFIRMAÇÃO DE QUITAÇÃO ENTEDER PFIN E OUTRO-->
<div class="modal fade" id="comfirmarQuitacaoModal" tabindex="-1" aria-labelledby="comfirmarQuitacaoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="fundo-cabecalho">
                <h1>QUITAR?</h1>
            </div>
            <div class="modal-body">
                <form id="confirmarQuitacaoForm" method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="idChequeQuitacao" name="idChequeQuitacao" required>
                    <input type="hidden" value="quitacao" name="actionQuitar" id="actionQuitar">
                    <p class="texto-de-alerta">É OBRIGATÓRIO ANEXAR O DOCUMENTO COMPROVATÓRIO DA EXCLUSÃO NO SPC</p>
                    <div class="input-group input-group-sm mb-3 ">
                        <span class="input-group-text" id="inputGroup-sizing">Comprovante:</span>
                        <input id="arquivoQuitacao" type="file" name="arquivoQuitacao" class="form-control" required />
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-sm" data-bs-dismiss="modal" onclick="salvarConfirmarQuitacao()">Quitar?</button>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" onclick="fecharModal(this.form.idChequeQuitacao.value)">Fechar</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!--/MODAL CONFIRMAÇÃO DE QUITAÇÃO-->