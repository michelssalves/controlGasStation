<!--MODAL INCLUIR CHEQUE-->
<div class="modal fade" id="incluirChequeModal" tabindex="-1" aria-labelledby="incluirChequeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="fundo-cabecalho">
                <h1>INCLUIR CHEQUE</h1>
            </div>    
                <div class="modal-body">
                <form method="POST" enctype="multipart/form-data">
                      <input type="hidden" name="p" value="2" required>
                      <input type="hidden" value="incluir-cheque" name="action" required>
                        <div class="mb-3">
                          <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Filial:</span>
                              <select name="idMed" class="form-select" aria-label="Default select example" required>
                              <option selected disabled value=''>Filial</option>
                                <?= $cbFilialI?>
                              </select>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Banco:</span>
                              <select name="codigoBanco" class="form-select" aria-label="Default select example" required>
                              <option selected disabled value=''>Bancos</option>
                                <?= $cboBancos ?>
                              </select>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                              <span class="input-group-text" id="inputGroup-sizing-sm">NOME/RZ SOCIAL(CHEQUE):</span>
                              <input name="rzSocialCheque" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                              <span class="input-group-text" id="inputGroup-sizing-sm">NOME/RZ SOCIAL(CLIENTE):</span>
                              <input name="rzSocialCliente" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                              <span class="input-group-text" id="inputGroup-sizing-sm">Telefone::</span>
                              <input name="telefone" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                              <span class="input-group-text" id="inputGroup-sizing-sm">Nº do Cheque::</span>
                              <input name="nrCheque" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                              <span class="input-group-text" id="inputGroup-sizing-sm">Valor Do Cheque:</span>
                              <input onkeypress="return soNumeros();" name="valor" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Motivo:</span>
                              <select name="motivo" class="form-select" aria-label="Default select example" required>
                              <option selected disabled value=''>Motivo</option>
                                  <?= $cboMotivos ?>  
                              </select>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                              <span class="input-group-text" id="inputGroup-sizing-sm">Data Cheque:</span>
                              <input name="dataCheque" type="date" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                              <span class="input-group-text" id="inputGroup-sizing-sm">Data Devolução:</span>
                              <input name="dataDevol" type="date" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                              <span class="input-group-text" id="inputGroup-sizing-sm">Cpf/Cnpj:</span>
                              <input name="cpfcnpj" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                              <span class="input-group-text" id="inputGroup-sizing-sm">Cheque Frente:</span>
                              <input name="chequeFrente" type="file" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                              <span class="input-group-text" id="inputGroup-sizing-sm">Cheque Verso:</span>
                              <input name="chequeVerso" type="file" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary btn-sm" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="this.form(submit)">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>  
<!--/MODAL INCLUIR CHEQUE-->
<!--MODAL CANCELAR CHEQUE-->
<div class="modal fade" id="cancelarChequeModal" tabindex="-1" aria-labelledby="cancelarChequeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="fundo-cabecalho">
                <h1>CANCELAR CHEQUE</h1>
            </div>    
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data">
                      <input type="hidden" name="p" value="2" required>
                      <input type="hidden" value="cancelar-cheque" name="action" required>
                        <div class="mb-3">
                            <label  for="descricao" class="col-form-label">Id do Cheque:</label>
                            <input type="text" name="idCheque" class="form-control" id="id_cheque_cancelar" placeholder="Id" readonly required>
                            <label  for="motivoCancelamento" class="col-form-label">Motivo:</label>
                            <input type="text" name="motivoCancelamento" class="form-control" id="motivoCancelamento" placeholder="Motivo" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary btn-sm" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-outline-danger btn-sm">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>  
<!--/MODAL CANCELAR CHEQUE-->
