<?php
include('model/ChequesDevolvidos.php');
include('controller/chequesDevolvidos.php');
?>

<div class="app">
    <form method='POST' id='formulario-cheques'>
        <div class="container text-center p-2">
            <div class="row">
                <div class="col-sm-2 p-1">
                    <div class="dropdown">
                        <button class="form-select " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Status
                        </button>
                        <ul class="dropdown-menu p-3">
                            <li><input <?= $flagNovo ?> type="checkbox" id="statusNovo" name="statusNovo" value="NOVO" /> NOVO</label></li>
                            <li><input <?= $flagNegociando ?> type="checkbox" id="statusNegociando" name="statusNegociando" value="NEGOCIANDO" /> NEGOCIANDO</label></li>
                            <li><input <?= $flagQuitado ?> type="checkbox" id="statusQuitado" name="statusQuitado" value="QUITADO" /> QUITADO</label></li>
                            <li><input <?= $flagPfin ?> type="checkbox" id="statusPfin" name="statusPfin" value="PFIN" /> PFIN</label></li>
                            <li><input <?= $flagJuridico ?> type="checkbox" id="statusJuridico" name="statusJuridico" value="JURIDICO" /> JURIDICO</label></li>
                            <li><input <?= $flagExecucao ?> type="checkbox" id="statusExecucao" name="statusExecucao" value="EXECUÇÃO" /> EXECUÇÃO</label></li>
                            <li><input <?= $flagCaducou ?> type="checkbox" id="statusCaducou" name="statusCaducou" value="CADUCOU" /> CADUCOU</label></li>
                            <li><input <?= $flagExtraviado ?> type="checkbox" id="statusExtraviado" name="statusExtraviado" value="EXTRAVIADO" /> EXTRAVIADO</label></li>
                            <li><input <?= $flagCancelado ?> type="checkbox" id="statusCancelado" name="statusCancelado" value="CANCELADO" /> CANCELADO</label></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2 p-1">
                    <select id='tipoData' name='tipoData' class='form-select' aria-label='Default select example'>
                        <option selected value='0'>Data Inclusão</option>
                        <option value='1'>Data Cheque</option>
                        <option value='2'>Data Devolução</option>
                        <option value='3'>Data Quitação</option>
                    </select>
                </div>
                <div class="col-md-2 p-1">
                    <select id='id_med' name='id_med' class='form-select' aria-label='Default select example'>
                        <option selected value="<?= ($id_med ? $id_med : ''); ?>"><?= ($nome_f[$id_med] ? $nome_f[$id_med] : 'Filial'); ?></option>
                        <?= $cboMed ?>
                    </select>

                </div>
                <div class="col-md-2 p-1">
                    <input class='form-control' type='date' name='data1' id='data1' value='<?= $data1 ?>'>
                </div>
                <div class="col-md-2 p-1">
                    <input class='form-control' type='date' name='data2' id='data2' value='<?= $data2 ?>'>,
                </div>
                <div class="col-md-2 mt-1 p-1">
                    <button type="button" class='btn btn-warning btn-sm'>Incluir</button>
                    <button type="button" class='btn btn-danger btn-sm'>Limpar</button>
                </div>
            </div>
        </div>
    </form>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="header-tabela">
                <tr>
                    <th>Id</th>
                    <th>Dt Reg</th>
                    <th>Banco</th>
                    <th>Cliente</th>
                    <th>Nr Cheque</th>
                    <th>Motivo</th>
                    <th>Dt Cheque</th>
                    <th>Valor</th>
                    <th>Dt Devol</th>
                    <th>Dias</th>
                    <th>$ Corr</th>
                    <th>Dt Quit</th>
                    <th>Med</th>
                    <th>Stat</th>
                    <th>UltAlt</th>
                </tr>
            </thead>
            <tbody>
                <?= $txtTab ?>
            </tbody>
        </table>
    </div>
</div>