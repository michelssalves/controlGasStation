<!--MODAL CONFIRMAÇÃO DE QUITAÇÃO ENTEDER PFIN E OUTRO-->
<div class="modal fade" id="comfirmarQuitacaoModal" tabindex="-1" aria-labelledby="comfirmarQuitacaoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="fundo-cabecalho">
                <h1>CONFIRMAR QUITAÇÃO?</h1>
            </div>    
                <div class="modal-body">
                    <form id="confirmarQuitacaoForm" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="p" value="2" required>
                    <input type="hidden" value="quitacao" name="action">
                      <input type="hidden" id="id_cheque_quitacao" name="idCheque" value="" required>
                        <div class="mb-3">
                              <p class="texto-de-alerta">É OBRIGATÓRIO ANEXAR O DOCUMENTO COMPROVATÓRIO DA EXCLUSÃO NO SPC</p> 
                            <label for="file" class="col-form-label">Comprovante:</label>
                            <input type="file" name="file" class="form-control" id="file" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary btn-sm" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-outline-success btn-sm">Confirmar Quitação?</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>  
<!--/MODAL CONFIRMAÇÃO DE QUITAÇÃO--> 
