<!--MODAL ALTERAR CX DIÁRIO-->
<div class="modal fade" id="<?= $modalAlterar ?>" tabindex="-1" aria-labelledby="incluirChequeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="fundo-cabecalho">
                <div class="modal-header">
                  <h3>STATUS CAIXA</h3>
                </div>
            </div>    
                <div class="modal-body">
                <form method="POST">
                      <input type="hidden" name="p" value="4" required>
                      <input type="hidden" value="<?= $row['id_reg']?>" name="id" required>
                      <input type="hidden" value="alterar-cx-diario" name="action" required>
                        <div class="mb-3">
                          <p class="texto-de-advertencia">...</p> 
                            <div class="input-group input-group-sm mb-3">
                              <span class="input-group-text" id="inputGroup-sizing">Depósito dinheiro:</span>
                              <input readonly value="<?= v2($dep_dinheiro) ?>" name="med" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Depósito Cheque:</span>
                              <input readonly value="<?= v2($dep_cheque) ?>" name="debitos" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Depósito Brinks:</span>
                              <input readonly value="<?= v2($dep_brinks)  ?>" name="debitos" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Data do Caixa:</span>
                              <input readonly value="<?= date('d/m/Y', strtotime($data_caixa))  ?>" name="debitos" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Dia da semana:</span>
                              <input readonly value="<?= $vetorDiaSem[w($data_caixa)] ?>" name="debitos" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Turno em definitivo:</span>
                              <input readonly value="<?= ($caixa?'Sim':'Não')  ?>" name="debitos" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Observações:</span>
                              <input readonly value="<?= $obs ?>" name="debitos" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Concialiação bancaria:</span>
                              <input readonly value="<?= $conc  ?>" name="debitos" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Fechamento caixa geral definitivo:</span>
                              <input readonly value="<?= $caixa  ?>" name="debitos" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
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