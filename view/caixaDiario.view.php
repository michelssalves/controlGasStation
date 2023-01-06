<?php
include('model/CaixaDiario.php');
include('controller/caixaDiario.php');
?>
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
<div class='table-responsive'>
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
                <?= $checkBox ?>
            </tr>
            <tr>
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
</div>
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
