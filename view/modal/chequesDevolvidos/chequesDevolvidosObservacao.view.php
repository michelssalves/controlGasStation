<!--MODAL INCLUIR OBSERVA��O-->
<div class="modal fade" id="incluirObservacaoModal" tabindex="-1" aria-labelledby="incluirObservacaoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="fundo-cabecalho">
                <h1>OBSERVA��O</h1>
            </div>    
                <div class="modal-body">
                    <form id="incluirObservacaoForm" method="POST">
                    <input type="hidden" name="p" value="2" required>
                      <input  type="hidden" id="idChequeObs" name="idChequeObs" required>
                       <input type="hidden" value="gravarObservacao" id="action">
                        <div class="mb-3">
                          <p class="texto-de-advertencia">REGISTRE AQUI ALGUMA ATUALIZA��O SOBRE ESTE CLIENTE</p>
                            <textarea id="observacao" name="observacao" cols="50" lines="5" style="white-space: pre;"></textarea>
                            <br>
                            <input id="enviarEmail" type="checkbox" name="enviarEmail" id="enviarEmail">Enviar notifica�ao por email&nbsp;&nbsp;&nbsp;
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary btn-sm" data-bs-dismiss="modal">Fechar</button>
                            <button type="button" class="btn btn-outline-success btn-sm" data-bs-dismiss="modal" onclick="gravarObservacao()">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>  
<!--/MODAL INCLUIR OBSERVA��O-->
