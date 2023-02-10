<!--MODAL VISUALIZAR CX DIÁRIO-->
<div class="modal fade" id="<?= $modalVisualizar ?>" tabindex="-1" aria-labelledby="verCaixaDiarioModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="fundo-cabecalho">
        <h1>STATUS CAIXA</h1>
      </div>
      <div class="modal-body">
        <form id="<?= $id_requisicao ?>" method="POST">
          <!-- SE O CAIXA ESTIVER ABERTO RENDERIZA OS MENUS ABAIXO -->
          <?php if ($status == "ABERTO") {
            echo $menuCaixaAberto = "
                               <input type='hidden' name='p' value='4' required>
                               <input type='hidden' value='$id_requisicao' name='id_requisicao' required>
                
                               <span class='input-group-text mb-2' id='inputGroup-sizing'>Conciliação bancaria:
                               <div class='form-check  mt-2 ml-2'>
                                 <input class='form-check-input' type='checkbox' name='concBancariaSim' id='concBancariaSim' required>
                                 <label class='form-check-label' for='concBancariaSim'>SIM</label>
                               </div>
                               </span>
                               <span class='input-group-text mb-2' id='inputGroup-sizing'>Fechamento de caixa geral definitivo:
                               <div class='form-check  mt-2 ml-4'>
                                 <input class='form-check-input' type='checkbox' name='fechamentoSim' id='fechamentoSim' required>
                                 <label class='form-check-label' for='concBancariaSim'>SIM</label>
                               </div>
                               </span>";

            //SE O CAIXA FOR NOVO RENDERIZA OS MENUS ABAIXO
          } elseif ($status == "NOVO") {
            echo $menuCaixaNovo = "<input type='hidden' name='p' value='4' required>
                               <input type='hidden' value='$id_requisicao' name='id_requisicao' required>";
          }else {
            echo $menuCaixaFechado = "<input type='hidden' name='p' value='4' required>
            <input type='hidden' value='$id_requisicao' name='id_requisicao' required>";
          }
          ?>
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
              <input readonly value="<?= ($turnos_definitivo ? $turnos_definitivo : 'Não')  ?>" name="turnos_definitivo" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
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
                  <?= selectCaixaDiarioAnexos($id_requisicao) ?>
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
                  <?= selectCaixaDiarioObs($id_requisicao) ?>
                </tbody>
              </table>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <div class="d-flex gap-2 d-sm-flex mb-2 justify-content-md-center">
            <?php if ($status == 'ABERTO') {
              echo $buttonCaixaAberto = '<button type="submit" name="action" value="fecharCxDiario" class="btn btn-outline-primary btn-sm">Fechar Caixa</button>';
            } elseif ($status == 'NOVO') {
              echo $buttonCaixaNovo = '<button type="submit" name="action" value="abrirCxDiario" class="btn btn-outline-primary btn-sm">Abrir Caixa</button>';
            } else {
              echo $buttonReabrirCaixa = '<button type="submit" name="action" value="reabrirCxDiario" class="btn btn-outline-primary btn-sm">Reabrir Caixa</button>';
            } ?>
            <button type="button" class="btn btn-outline-primary btn-sm" data-bs-dismiss="modal" onclick="editarCaixa(this.form.id)">Editar</button>
            <button type="button" class="btn btn-outline-primary btn-sm" data-bs-dismiss="modal" onclick="incluirObservacao(this.form.id)">Observação</button>
            <button type="button" class="btn btn-outline-primary btn-sm" data-bs-dismiss="modal" onclick="incluirAnexo(this.form.id)">Anexos</button>
            <button type="submit" class="btn btn-outline-danger btn-sm" name="action" value="cancelarCaixa">Cancelar</button>
            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Fechar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!--/MODAL VISUALIZAR CX DIÁRIO-->

