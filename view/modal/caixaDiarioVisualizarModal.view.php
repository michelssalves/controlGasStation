<!--MODAL ALTERAR CX DIÁRIO-->
<div class="modal fade" id="<?= $modalAlterar ?>" tabindex="-1" aria-labelledby="incluirChequeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="fundo-cabecalho">
                <div class="modal-header">
                  <h3>ALTERAR CAIXA DIÁRIO</h3>
                </div>
            </div>    
                <div class="modal-body">
                <form method="get">
                      <input type="hidden" name="p" value="3" required>
                      <input type="hidden" value="<?= $row['id_reg']?>" name="id" required>
                      <input type="hidden" value="alterar-cx-diario" name="action" required>
                        <div class="mb-3">
                        <p class="texto-de-advertencia">Se necessário corrija os valores e clique em gravar.</p> 
                            <div class="input-group input-group-sm mb-3">
                              <span class="input-group-text" id="inputGroup-sizing">Filial:</span>
                              <input readonly value="<?= $row['loginName'] ?>" name="med" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                              <span class="input-group-text" id="inputGroup-sizing">Debitos de Clientes:</span>
                              <input readonly value="<?= $row['debito']  ?>" name="debitos" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                              <span class="input-group-text" id="inputGroup-sizing-sm">Dinheiro:</span>
                              <input value="<?= v2($row['dinheiro']) ?>" name="debito" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                              <span class="input-group-text" id="inputGroup-sizing">Banco:</span>
                              <select required id='conta' name='conta' class='form-select' aria-label='Default select example'>
                                <option selected ><?= $row['conta']; ?></option>
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
                              <span class="input-group-text" id="inputGroup-sizing">Cheque:</span>
                              <input value="<?= $row['cheque']; ?>"name="cheque" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                              <span class="input-group-text" id="inputGroup-sizing">Banco:</span>
                              <select id='contaCh' name='contaCh' class='form-select' aria-label='Default select example'>
                              <option selected><?= $row['contaCh']; ?></option> 
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
                              <input value="<?= $row['DATA']  ?>" name="dataMovimento" type="date" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                            </div>
                            <div class="input-group input-group-sm mb-3">
                              <span class="input-group-text" id="inputGroup-sizing">Data Devolução:</span>
                              <input value="<?= dmaHLocal($row['datahoraReg'])  ?>" name="dataInclusao" type="datetime-local" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>      
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary btn-sm" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-outline-danger btn-sm">Gravar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>  
<!--/MODAL ALTERAR CX DIÁRIO-->
<!--MODAL INLCUIR OBS CX DIÁRIO-->
<div class="modal fade" id="<?= $modalObservacao ?>" tabindex="-1" aria-labelledby="incluirChequeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="fundo-cabecalho">
                <div class="modal-header">
                  <h3>INCLUIR OBSERVAÇÃO</h3>
                </div>
            </div>    
                <div class="modal-body">
                <form method="get">
                      <input type="hidden" name="p" value="3" required>
                      <input type="hidden" value="<?= $row['id_reg']?>" name="id_reg" required>
                      <input type="hidden" value="observacao-cx-diario" name="action" required>
                        <div class="mb-3">
                            <div class="input-group input-group-sm mb-3">
                              <span class="input-group-text" id="inputGroup-sizing">Observação:</span>
                              <textarea required rows="4" cols="50"class="form-control" name="textoObs" placeholder="Inclua aqui as informações e clique em gravar"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary btn-sm" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-outline-danger btn-sm">Gravar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>  
<!--/MODAL INLCUIR OBS CX DIÁRIO-->
