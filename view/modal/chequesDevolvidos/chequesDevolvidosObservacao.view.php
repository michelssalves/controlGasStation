<!--MODAL INCLUIR OBSERVAÇÃO-->
<div class="modal fade" id="incluirObservacaoModal" tabindex="-1" aria-labelledby="incluirObservacaoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="fundo-cabecalho">
                <h1>OBSERVAÇÃO</h1>
            </div>
            <div class="modal-body">
                <form id="incluirObservacaoForm" method="POST">
                    <input type="hidden" id="idChequeObs" name="idChequeObs" required>
                    <input type="hidden" value="gravarObservacao" id="actionObs">
                    <p class="texto-de-advertencia">REGISTRE AQUI ALGUMA ATUALIZAÇÃO SOBRE ESTE CLIENTE</p>
                    <div class="input-group input-group-sm mb-3 ">
                        <span class="input-group-text" id="inputGroup-sizing">Observação:</span>
                        <textarea name="observacao" id="observacao" cols="60" rows="10" style="white-space: pre;" placeholder="Escreva o motivo" required></textarea>
                    </div>
                    <input id="enviarEmail" type="checkbox" name="enviarEmail" id="enviarEmail">Enviar notificaçao por email&nbsp;&nbsp;&nbsp;
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-sm" data-bs-dismiss="modal" onclick="gravarObservacao()">Salvar</button>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" onclick="fecharModal(this.form.idChequeObs.value)">Fechar</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!--/MODAL INCLUIR OBSERVAÇÃO-->