<?php
include('model/CaixaDiario.php');
include('controller/caixaDiario.php');
?>
<div id="app">

<div class="modal fade" id="visualizarCaixaDiario" tabindex="-1" aria-labelledby="visualizarCaixaDiarioModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header fundo-cabecalho">
      <h1>Visualizar</h1>
        <hr>
        <div class="d-flex gap-2 d-sm-flex mb-2 justify-content-md-left">
          <button onmouseenter="mudarTexto1(this.title, this.id)"  onmouseleave="mudarTexto2(this.title,this.id)" id="btn-finalizar-cx" type="button" title="Finalizar Caixa" class="btn btn-primary btn" data-bs-dismiss="modal"><i  class="fa-regular fa-circle-check"></i></button>
          <button type="button" title="Abrir Caixa" class="btn btn-primary btn" data-bs-dismiss="modal"><i class="fa-solid fa-box-open"></i></button>
          <button type="button" title="Editar Caixa" class="btn btn-secondary btn" data-bs-dismiss="modal"><i class="fa-solid fa-file-pen"></i></button>
          <button type="button" title="Observação" class="btn btn-secondary btn" data-bs-dismiss="modal"><i class="fa-solid fa-eye"></i></button>
          <button type="button" title="Anexo" class="btn btn-secondary btn" data-bs-dismiss="modal"><i class="fa-solid fa-paperclip"></i></button>
          <button type="button" title="Cancelar Caixa" class="btn btn-secondary btn" data-bs-dismiss="modal"><i class="fa-regular fa-trash-can"></i></button>
        </div>
        
        <div class="d-flex gap-2 d-sm-flex mb-2 justify-content-md-right">
        <button type="button" title="Fechar" class="btn btn-danger btn" data-bs-dismiss="modal"><i class="fa-solid fa-rectangle-xmark"></i></button>
        </div>
      </div>
      <div class="modal-body">
        <form id="visualizarCaixaDiario" method="POST">
          <input type="text" id="idRequisicaoVisualizar" v-model="id" :value="id" type="text">
            {{ id }}
          <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Depósito dinheiro:</span>
            <input readonly id="depDinheiroVisualizar" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
            <span class="input-group-text" id="inputGroup-sizing">Depósito Cheque:</span>
            <input readonly id="depChequeVisualizar" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
            <span class="input-group-text" id="inputGroup-sizing">Depósito Brinks:</span>
            <input readonly id="depBrinksVisualizar" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
          </div>
          <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Data do Caixa:</span>
            <input readonly id="dataCaixaVisualizar" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>

            <span class="input-group-text" id="inputGroup-sizing">Turno em definitivo:</span>
            <input readonly id="turnosDefinitivoVisualizar" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
          </div>
          <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Concialiação bancaria:</span>
            <input readonly id="concVisualizar" name="conc" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
            <span class="input-group-text" id="inputGroup-sizing">Fechamento caixa geral definitivo:</span>
            <input readonly id="caixaVisualizar" name="caixa" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
          </div>
          <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Observações:</span>
            <textarea disabled id="obsVisualizar" cols="60" rows="7" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"><?= $obs ?></textarea>
          </div>
          <div class="table-responsive">
            <div class="tabela-ver-todos-os-cheques">
              <div class="tabelaCxDiarioAnexos">

              </div>
            </div>
          </div>
          </br>
          <div class="table-responsive">
            <div class="tabela-ver-todos-os-cheques">
              <div class="tabelaCxDiarioEventos">

              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
      </div>
      </form>
    </div>
  </div>
</div>
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-auto mt-4">
            <form method='POST' id='formulario-fechamento-caixa'>
                <input type='hidden' name='p' value='4'>
                <input type='hidden' id='action' name='action' value='filtrar-fechamento-caixa'>
                <button name='filtrar-fechamento-caixa' class='btn btn-info btn-sm'>Filtrar</button>
                <button type="submit" class='btn btn-danger btn-sm'>Limpar</button>
        </div>
    </div>
</div>

    <table class='table mb-0 table-sm table-hover fs-6 fst-italic'>
        <thead>
            <tr>
                <th colspan='10' style='background-color:#009688'>
                    <center>FILTROS</center>
                  
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="dropdown">
                        <button class="form-select " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Status
                        </button>
                        <ul class="dropdown-menu p-3">
                            <li><input <?= $flagNovo ?> type="checkbox" id="statusNovo" name="statusNovo" value="NOVO" /> NOVO</label></li>
                            <li><input <?= $flagFechado ?> type="checkbox" id="statusFechado" name="statusFechado" value="FECHADO" /> FECHADO</label></li>
                            <li><input <?= $flagFechadoDefinitivo ?> type="checkbox" id="statusFechadoDefinitivo" name="statusFechadoDefinitov" value="DEFINITIVO" /> DEFINITIVO</label></li>
                            <li><input <?= $flagCancelado ?> type="checkbox" id="statusCancelado" name="statusCancelado" value="CANCELADO" /> CANCELADO</label></li>
                        </ul>
                    </div>
                </td>
                <td>
                    <select id='controleMed' name='controleMed' class='form-select' aria-label='Default select example'>
                        <option><?php echo ($controleMed ? $controleMed : 'Controle'); ?></option>
                        <option>Controle01</option>
                        <option>Controle02</option>
                        <option>Controle03</option>
                    </select>
                </td>
                <td>
                    <select id='id_med' name='id_med' class='form-select' aria-label='Default select example'>
                        <option selected value="<?= ($id_med ? $id_med : ''); ?>"><?= ($nome_f[$id_med] == '' ? $nome_f[$id_med] : 'Filial'); ?></option>
                        <?= $cboMed ?>
                    </select>
                </td>
                <td>
                    <input class='form-control' type='date' name='data1' id='data1' value='<?= $data1 ?>'>
                </td>
                <td>
                    <input class='form-control' type='date' name='data2' id='data2' value='<?= $data2 ?>'>
                </td>
                <td>
                    <select id='turnoDefinitivo' name='turnoDefinitivo' class='form-select' aria-label='Default select example'>
                        <option><?php echo ($turnoDefinitivo ? $turnoDefinitivo : 'Turno Definitivo'); ?></option>
                        <option>Sim</option>
                        <option>Não</option>
                    </select>
                </td>
                <td>
                    <select id='concBancaria' name='concBancaria' class='form-select' aria-label='Default select example'>
                        <option><?php echo ($concBancaria ? $concBancaria : 'Conciliação Bancaria'); ?></option>
                        <option>Conciliação Bancaria</option>
                        <option>Sim</option>
                        <option>Não</option>
                    </select>
                </td>
            </tr>
        </tbody>
    </table>
    </form>

<div class="table-responsive">
    <div class="tabela-ver-todos-os-cheques">
        <table data-tablesaw-sortable data-tablesaw-sortable-switch class="tablesaw table-sm table-hover  fs-6 mb-0" data-tablesaw-mode="columntoggle" data-tablesaw-minimap>
            <thead class="header-tabela">
                <tr>
                    <th data-tablesaw-sortable-col data-tablesaw-priority="1">MED</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority="1">DATA</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority="5">DIA SEMANA</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority="5">DINHEIRO</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority="5">CHEQUE</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority="5">BRINKS</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority="5">PIX</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority="1">TOTAL</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority="5" title="TURNOS EM DEFINITIVO">TURNOS D</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority="5">OBS</th>
                </tr>
            </thead>
            <tbody>
                <?= $txtTab ?>
            </tbody>
        </table>
    </div>
</div>
