<!--MODAL VISUALIZAR CX DIÁRIO-->
<div class="modal fade" id="<?= $modalAlterar ?>" tabindex="-1" aria-labelledby="incluirChequeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
            <div class="fundo-cabecalho">
                  <h1>STATUS CAIXA</h1>
            </div>    
                <div class="modal-body">
                <form id="<?= $id_requisicao?>" method="POST">
                      <input type="hidden" name="p" value="4" required>
                      <input type="hidden" value="<?= $id_requisicao?>" name="id_requisicao" required>
                      <input type="hidden" value="alterar-cx-diario" name="action" required>
                        <div class="mb-3">
                            <div class="input-group input-group-sm mb-3">
                              <span class="input-group-text" id="inputGroup-sizing">Depósito dinheiro:</span>
                              <input readonly value="<?= v2($dep_dinheiro) ?>" name="dep_dinheiro" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Depósito Cheque:</span>
                              <input readonly value="<?= v2($dep_cheque) ?>" name="dep_cheque" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Depósito Brinks:</span>
                              <input readonly value="<?= v2($dep_brinks)  ?>" name="dep_brinks" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Data do Caixa:</span>
                              <input readonly value="<?= date('d/m/Y', strtotime($data_caixa))  ?>" name="data_caixa" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Dia da semana:</span>
                              <input readonly value="<?= $vetorDiaSem[w($data_caixa)] ?>" name="data_caixa_dia_semana" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Turno em definitivo:</span>
                              <input readonly value="<?= ($turnos_definitivo? $turnos_definitivo:'Não')  ?>" name="turnos_definitivo" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Observações:</span>
                              <textarea disabled name="obs" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"><?= $obs ?></textarea>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Concialiação bancaria:</span>
                              <input readonly value="<?= $conc  ?>" name="conc" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Fechamento caixa geral definitivo:</span>
                              <input readonly value="<?= $caixa  ?>" name="caixa" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="table-responsive">
                            <div class="tabela-ver-todos-os-cheques">
                            <table class="table table-hover table-striped fs-6 mb-0">
                                <thead>
                                  <tr>
                                      <th>Arquivo</th>
                                      <th>Extensão</th>
                                      <th>Data/Hora</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <?= selectFechamentoCaixaAnexos($id_requisicao) ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                          </br>
                          <div class="table-responsive">
                          <div class="tabela-ver-todos-os-cheques">
                              <table class="table table-hover table-striped fs-6 mb-0">
                                <thead>
                                  <tr>
                                      <th>Data/Hora</th>
                                      <th>Usuário</th>
                                      <th>Eventos</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <?= selectFechamentoCaixaObservacao($id_requisicao) ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                        </div>
                        <div class="modal-footer">
                            <div class="d-flex gap-2 d-sm-flex mb-2 justify-content-md-center">
                              <button type="button" class="btn btn-outline-primary btn-sm" data-bs-dismiss="modal">Fechar</button>
                              <button type="button" class="btn btn-outline-warning btn-sm" data-bs-dismiss="modal" onclick="editarForm(this.form.id)">Editar</button>
                              <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal" onclick="cancelarCheque(this.form.id)">Cancelar</button>
                              <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal" onclick="incluirObservacao(this.form.id)">Observação</button>
                              <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal" onclick="incluirAnexo(this.form.id)">Anexos</button>
                            </div>    
                          </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>  
<!--/MODAL VISUALIZAR CX DIÁRIO-->
<!--MODAL INCLUIR ANEXO OK-->
<div class="modal fade" id="incluirAnexoModal" tabindex="-1" aria-labelledby="incluirAnexoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="fundo-cabecalho">
                <h1>INCLUIR ANEXO</h1>
            </div>    
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data">
                      <input type="hidden" name="p" value="2" required>
                      <input type="hidden" id="id_anexo" name="idCheque" value="" required>
                      <input type="hidden" value="gravarAnexo" name="action" required>
                        <div class="mb-3">
                          <p class="texto-de-advertencia">AQUI SERÁ INCLUIDO TODA A DOCUMENTAÇÃO REFERENTE A ESTE CLIENTE</p>
                            <label for="descricao" class="col-form-label">Comprovante:</label>
                            <input type="file" name="file" class="form-control">
                            <select id='descricao' name='descricao' class='form-select' aria-label='Default select example'>
                            <option selected> SELECIONE O TIPO DE ANEXO</option>
                            <option>ABASTECE AÍ</option>
                            <option>CAIXA GERAL</option>
                            <option>CAIXA</option>
                            <option>CHEQUE A VISTA</option>
                            <option>CHEQUE PRÉ</option>
                            <option>COMPROVANTE DE DEPÓSITO</option>
                            <option>DECLARAÇÃO DE ENTREGA DE CUPOM</option>
                            <option>DESPESAS</option>
                            <option>PLANILHA DE DEPÓSITO</option>
                            <option>POS</option>
                            <option>REDUÇÃO Z</option>
                            <option>RELATÓRIO DE DESCONTOS</option>
                            <option>RESIDUAL</option>
                            <option>TEF</option>
                            <option>VALES</option>
                        </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary btn-sm" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-outline-success btn-sm">Incluir Anexo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>  
<!--/MODAL INCLUIR ANEXO-->
<!--MODAL INCLUIR OBSERVAÇÃO-->
<div class="modal fade" id="incluirObservacaoModal" tabindex="-1" aria-labelledby="incluirObservacaoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="fundo-cabecalho">
                <h1>INCLUIR OBSERVAÇÃO</h1>   
            </div>    
                <div class="modal-body">
                    <form id="incluirObservacaoForm" method="POST">
                    <input type="hidden" name="p" value="4" required>
                      <input  type="hidden" id="id_observacao" name="id_requisicao" value="" required>
                       <input type="hidden" value="gravarObservacao" name="action">
                        <div class="mb-3">
                          <p class="texto-de-advertencia">REGISTRE AQUI ALGUMA OBSERVAÇÃO SOBRE ESTE CAIXA</p>
                            <textarea name="observacao" cols="50" lines="5" style="white-space: pre;"></textarea>
                            <input type="checkbox" name="enviarEmail" id="enviarEmail">Enviar notificaçao por email
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
<!--MODAL EDITAR CX DIÁRIO-->
<div class="modal fade" id="editarInformacoesModal" tabindex="-1" aria-labelledby="editarInformacoesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
            <div class="fundo-cabecalho">
                <h1>EDITAR CAIXA</h1>
            </div>    
                <div class="modal-body">
                <form method="POST">
                      <input type="hidden" name="p" value="4" required>
                      <input type="hidden" id="edit_form" name="id_requisicao" required>
                      <input type="hidden" value="alterar-cx-diario" name="action" required>
                        <div class="mb-3">
                            <div class="input-group input-group-sm mb-3">
                              <span class="input-group-text" id="inputGroup-sizing">Depósito dinheiro:</span>
                              <input onkeypress="return soNumeros();" id="dep_dinheiro" name="dep_dinheiro" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Depósito Cheque:</span>
                              <input onkeypress="return soNumeros();" id="dep_cheque" name="dep_cheque" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Depósito Brinks:</span>
                              <input onkeypress="return soNumeros();" id="dep_brinks" name="dep_brinks" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Data do Caixa:</span>
                              <input id="data_caixa" name="data_caixa"  type="date" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                             <span class="input-group-text" id="inputGroup-sizing">Turno em definitivo:</span>
                              <select id="turnos_definitivo" name="turnos_definitivo" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                <option></option>
                                <option>SIM</option>
                                <option>NÃO</option>
                              </select>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Observações:</span>
                              <textarea id="obs" name="obs" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"><?= $obs ?></textarea>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Concialiação bancaria:</span>
                              <select id="conc" name="conc" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                <option></option>
                                <option>SIM</option>
                              </select>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                              <span class="input-group-text" id="inputGroup-sizing">Fechamento caixa geral definitivo:</span>
                              <select id='caixa' name='caixa' class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                <option>SIM</option>
                                <option>NÃO</option>
                              </select>
                            </div>
                        </div>
                        </div>
                        <div class="modal-footer">
                            <div class="d-flex gap-2 d-sm-flex mb-2 justify-content-md-center">
                              <button type="button" class="btn btn-outline-primary btn-sm" data-bs-dismiss="modal">Fechar</button>
                              <button type="button" class="btn btn-outline-success btn-sm">Salvar</button>
                            </div>    
                          </div>  
                    </form>
                </div>
            </div>
        </div>
    </div>  
<!--/MODAL EDITAR CX DIÁRIO-->