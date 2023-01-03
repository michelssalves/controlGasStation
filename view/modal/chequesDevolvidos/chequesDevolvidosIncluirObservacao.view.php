<!--MODAL INCLUIR OBSERVAÇÃO-->
<div class="modal fade" id="incluirObservacaoModal" tabindex="-1" aria-labelledby="incluirObservacaoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="fundo-cabecalho">
                <h1>INCLUIR OBSERVAÇÃO</h1>
            </div>    
                <div class="modal-body">
                    <form id="incluirObservacaoForm" method="POST">
                    <input type="hidden" name="p" value="2" required>
                      <input  type="hidden" id="id_observacao" name="idCheque" required>
                       <input type="hidden" value="gravarObservacao" name="action">
                        <div class="mb-3">
                          <p class="texto-de-advertencia">REGISTRE AQUI ALGUMA ATUALIZAÇÃO SOBRE ESTE CLIENTE</p>
                            <textarea name="observacao" cols="50" lines="5" style="white-space: pre;"></textarea>
                            <input type="checkbox" name="enviarEmail" id="enviarEmail">Enviar notificaçao por email&nbsp;&nbsp;&nbsp;
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary btn-sm" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-outline-success btn-sm">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>  
<!--/MODAL INCLUIR OBSERVAÇÃO-->
