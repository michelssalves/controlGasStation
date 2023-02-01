<?php
include('model/Depositos.php');
include('controller/depositos.php');
?>
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-auto mt-4">
            <form method='POST' id='formulario-caixa-diario'>
                <input type='hidden' name='p' value='3'>
                <button type="submit" name='action' value='filtrar-depositos' class='btn btn-info btn-sm'>Filtrar</button>
                <button type="submit" name='action' value='limpar-filtrar-depositos' class='btn btn-danger btn-sm'>Limpar</button>
        </div>
    </div>
</div>
<div class='table-responsive mt-1'>
    <table class='table mb-0 table-sm table-hover fs-6 fst-italic'>
        <tr>
            <th colspan='10' style='background-color:#009688'>
                <center>FILTROS</center>
            </th>
        </tr>
        <tr>
            <td>
                <div class="container">
                    <div class="row justify-content-md-center">
                        <div class="col-md-auto">
                            <select id='id_med' name='id_med' class='form-select-sm' aria-label='Default select example'>
                                <option selected value="<?= ($id_med ? $id_med : ''); ?>"><?= ($nome_f[$id_med] ? $nome_f[$id_med] : 'Filial'); ?></option>
                                <?= $cboMed ?>
                                <option="-1">PERIODO</option>
                            </select>
                            <select required id='contaDeposito' name='contaDeposito' class='form-select-sm' aria-label='Default select example'>
                                <option selected disabled><?= $contaDeposito; ?></option>
                                <option>CONTA</option>
                                <option>BB</option>
                                <option>BB MEDS</option>
                                <option>BB PROPRIO</option>
                                <option>ITAU</option>
                                <option>BRINKS</option>
                                <option>PROSEGUR</option>
                            </select>
                            <input class='form-control-sm' type='date' name='dataIni' id='dataIni' value='<?= $dataIni ?>'>
                            <input class='form-control-sm' type='date' name='dataFim' id='dataFim' value='<?= $dataFim ?>'>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        
    </table>
    </form>
</div>
<div class="table-responsive">
    <div class="tabela-ver-todos-os-cheques">
        <table data-tablesaw-sortable data-tablesaw-sortable-switch class="tablesaw table-sm table-hover table-striped fs-6 mb-0" data-tablesaw-mode="columntoggle" data-tablesaw-minimap>
            <thead class="header-tabela">
                <tr>
                <th data-tablesaw-sortable-col data-tablesaw-priority="5">DT MOV</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority="5">DT MOV</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority="5">DIA SEM</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority="1">MED</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority="1">DINHEIRO</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority="5">CONTA DIN</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority="5">CHEQUE</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority="5">CONTA CH</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority="1">TOTAL DEP</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority="1">DÉBITO</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority="5">DT REG</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority="1">OBS</th>
                </tr>
            </thead>
            <tbody>
                <?= $txtTab ?>
    </div>
</div>