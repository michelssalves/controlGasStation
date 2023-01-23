<!--MODAL SEM SOLUÇÃO-->
<div class="modal fade" id="semSolucaoModal" tabindex="-1" aria-labelledby="semSolucaoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="fundo-cabecalho">
                <h1>SEM SOLUÇÃO</h1>
            </div>
            <div class="modal-body">
                <form id="semSolucaoForm" method="POST">
                    <input type="hidden" name="p" value="2" required>
                    <input type="hidden" value="semsolucao" name="action">
                    <input type="hidden" id="id_cheque_solucao" name="idCheque" value="" required>
                    <div class="mb-3">
                        <p class="texto-de-alerta">ESCREVA O MOTIVO DO CANCELAMENTO</p>
                        <label for="email" class="col-form-label">Justificativa:</label>
                        <textarea name="observacao" cols="50" lines="5" style="white-space: pre;"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-danger btn-sm">Sem solução</button>
                        <button type="button" class="btn btn-outline-primary btn-sm" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--/MODAL SEM SOLUÇÃO-->