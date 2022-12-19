<?php include('model/caixaDiario.model.php');?>
<div class='row'>
    <div class='col-md-12'>
        <div class='d-grid gap-2 d-md-flex mt-4 justify-content-md-start'>
            <form method='POST' id='formulario-cheques'>
                <input type='hidden' name='p' value='3'>
                <input type='hidden' id='action' name='action' value='filtrar-cheques-devolvidos'>
                <button name='filtrar-cheques' class='btn btn-info btn-sm'>Filtrar</button>
                <button class='btn btn-danger btn-sm' data-toggle="sem-solucao">Limpar</button>
        </div>
        <div class='table-responsive'>
            <table class='table mb-0 table-sm table-hover fs-6 fst-italic'>
                <tr>
                    <th colspan='10' style='background-color:#009688'>
                        <center>FILTROS</center>
                    </th>
                </tr>
                <tr>
                <td>
                    <select required id='filial' name='filial' class='form-select' aria-label='Default select example'>
                        <option selected disabled value="<?= $med; ?>"><?= $nome_f[$med]; ?></option>
                        <?= $cbFilialI ?>
                        <option = "-1">PERIODO</option>
                    </select>
                </td>
                <td>
                    <select required id='contaDeposito' name='contaDeposito' class='form-select' aria-label='Default select example'>
                        <option selected disabled><?= $contaDeposito; ?></option>
                        <option>CONTA</option>
                        <option>BB</option>
                        <option>BB MEDS</option>
                        <option>BB PROPRIO</option>
                        <option>ITAU</option>
                        <option>BRINKS</option>
                        <option>PROSEGUR</option>
                    </select>
                </td>
                </tr>
                <tr>
                    <td><input class='form-control' type='date' name='data1' id='data1' value='<?= $dataIni ?>'></td>
                    <td><input class='form-control' type='date' name='data2' id='data2' value='<?= $dataFim ?>'></td>
                </tr>
            </table>
        </div>
        </form>
        <hr class='border-dark'>
        <div class="table-responsive">
            <div class="tabela-ver-todos-os-cheques">
                <table data-tablesaw-sortable data-tablesaw-sortable-switch class="tablesaw table-sm table-hover table-striped fs-6 mb-0" data-tablesaw-mode="columntoggle" data-tablesaw-minimap>

                    <thead>
                        <tr style='background-color:#009688'>
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
                        </tr>
                    </thead>
                    <tbody>
                        <?= $txtTab ?>
            </div>
        </div>
    </div>
</div>