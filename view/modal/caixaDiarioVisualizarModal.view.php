<!--MODAL INCLUIR CHEQUE-->
<div class="modal fade" id="<?= $modal ?>" tabindex="-1" aria-labelledby="incluirChequeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="fundo-cabecalho">
                <div class="modal-header">
                  <h3>ALTERAR CAIXA DIÁRIO</h3>
                </div>
            </div>    
                <div class="modal-body">
                <form method="POST">
                      <input type="hidden" name="p" value="3" required>
                      <input type="hidden" value="incluir-cheque" name="action" required>
                        <div class="mb-3">
                        <p class="texto-de-advertencia">Se necessário corrija os valores e clique em gravar.</p> 
                            <div class="input-group input-group-sm mb-3">
                              <span class="input-group-text" id="inputGroup-sizing">Filial:</span>
                              <input name="med" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                              <span class="input-group-text" id="inputGroup-sizing">Debitos de Clientes:</span>
                              <input name="debitos" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                              <span class="input-group-text" id="inputGroup-sizing-sm">Dinheiro:</span>
                              <input name="debito" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                              <span class="input-group-text" id="inputGroup-sizing">Banco:</span>
                              <select required id='contaDeposito' name='contaDeposito' class='form-select' aria-label='Default select example'>
                                <option selected disabled><?= $contaDeposito; ?></option>
                                <option>CONTA</option>
                                <option>BB</option>
                                <option>BB MEDS</option>
                                <option>BB PROPRIO</option>
                                <option>ITAU</option>
                                <option>BRINKS</option>
                                <option>PROSEGUR</option>
                              </select>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                              <span class="input-group-text" id="inputGroup-sizing">Cheques:</span>
                              <input name="cheques" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                              <span class="input-group-text" id="inputGroup-sizing">Banco:</span>
                              <select required id='contaDeposito' name='contaDeposito' class='form-select' aria-label='Default select example'>
                                <option selected disabled><?= $contaDeposito; ?></option>
                                <option>CONTA</option>
                                <option>BB</option>
                                <option>BB MEDS</option>
                                <option>BB PROPRIO</option>
                                <option>ITAU</option>
                                <option>BRINKS</option>
                                <option>
                              </select>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                              <span class="input-group-text" id="inputGroup-sizing">Data Devolução:</span>
                              <input name="dataInclusao" type="datetime-local" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>      
                            </div>
                            <div class="input-group input-group-sm mb-3">
                              <span class="input-group-text" id="inputGroup-sizing">Data Devolução:</span>
                              <input name="dataMovimento" type="date" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary btn-sm" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="this.form(submit)">Gravar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>  
<!--/MODAL INCLUIR CHEQUE-->
