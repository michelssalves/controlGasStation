<?php 
include('model/ChequesDevolvidos.php'); 
include('controller/chequesDevolvidos.php'); 
?>
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-auto mt-4">
            <form method='POST' id='formulario-cheques'>
                <input type='hidden' name='p' value='2'>
                <input type='hidden' id='action' name='action' value='filtrar-cheques-devolvidos'>
                <button type="button" class='btn btn-warning btn-sm' onclick="incluirCheque()">Incluir</button>
                <button type="submit" name='action' value='filtrar-cheques-devolvidos'  class='btn btn-info btn-sm'>Filtrar</button>
                <button type="submit" name='action' value='limpar-cheques-devolvidos' class='btn btn-danger btn-sm'>Limpar</button>
        </div>
    </div>
</div>
    <table class='table mb-0 table-sm table-hover fs-6 fst-italic'>
        <thead class="header-tabela">
            <tr>
                <th colspan='10'>
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
                </td>
                <td colspan='2'>
                    <select id='tipoData' name='tipoData' class='form-select' aria-label='Default select example'>
                        <option selected value='0'>Data Inclusão</option>
                        <option value='1'>Data Cheque</option>
                        <option value='2'>Data Devolução</option>
                        <option value='3'>Data Quitação</option>
                    </select>
                </td>
                <td colspan='2'>
                    <select id='id_med' name='id_med' class='form-select' aria-label='Default select example'>
                        <option selected value="<?= ($id_med ? $id_med : ''); ?>"><?= ($nome_f[$id_med] ? $nome_f[$id_med] : 'Filial'); ?></option>
                        <?= $cboMed ?>
                    </select>
                </td>
                <td colspan='2'>
                    <div class='input-group input-group mb-3'>
                        <input type='text' name='cliente' id='cliente' value="<?= $cliente ?>" placeholder='Cliente' class='form-control' aria-label='Sizing example input' aria-describedby='inputGroup-sizing-sm'>
                    </div>
                </td colspan='2'>

                <td>
                    <div class='input-group input-group mb-3'>
                        <input type='text' name='idChq' id='idChq' value="<?= $idChq ?>" placeholder='Id' class='form-control' aria-label='Sizing example input' aria-describedby='inputGroup-sizing-sm'>
                    </div>
                </td>
                <td>
                    <div class='input-group input-group mb-3'>
                        <input type='text' name='banco' id='banco' value="<?= $banco ?>" placeholder='Banco' class='form-control' aria-label='Sizing example input' aria-describedby='inputGroup-sizing-sm'>
                    </div>
                </td>
                <td><input class='form-control' type='date' name='data1' id='data1' value='<?= $data1 ?>'></td>
                <td><input class='form-control' type='date' name='data2' id='data2' value='<?= $data2 ?>'></td>
            </tr>
        </tbody>
    </table>
    </form>
<div class="table-responsive">
    <div class="tabela-ver-todos-os-cheques">
        <table data-tablesaw-sortable data-tablesaw-sortable-switch class="tablesaw table-sm table-hover table-striped fs-6 mb-0" data-tablesaw-mode="columntoggle" data-tablesaw-minimap>

            <thead>
                <tr style='background-color:#009688'>
                    <th data-tablesaw-sortable-col data-tablesaw-priority="5">Id</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority="5">Dt Reg</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority="5">Banco</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority="1">Cliente</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority="1">Nr Cheque</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority="5">Motivo</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority="5">Dt Cheque</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority="1">Valor</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority="5">Dt Devol</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority="5">Dias</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority="1">$ Corr</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority="5">Dt Quit</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority="1">Med</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority="5">Stat</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority="5">UltAlt</th>
                </tr>
            </thead>
            <tbody>
                <?= $txtTab ?>
            </tbody>
        </table>
    </div>
</div>
