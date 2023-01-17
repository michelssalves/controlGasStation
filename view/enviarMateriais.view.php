<?php
include('model/EnviarMateriais.php');
include('controller/enviarMateriais.php');
?>
<form method="POST">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-auto mt-4">
                <input type='hidden' name='p' value='6'>
                <input type='hidden' name='page' value='1'>
                <button type="submit" name="action" value="filtrar-materiais" class='btn btn-info btn-sm'>Filtrar</button>
                <button type="submit" name="action" value="limpar" class='btn btn-danger btn-sm'>Limpar</button>
                <button type="button" data-bs-toggle='modal' data-bs-target='#verEstoque' style='cursor:pointer' class='btn btn-primary btn-sm'>Estoque</button>
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
                        <button class="form-select" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Status
                        </button>
                        <ul class="dropdown-menu">
                            <li><input class="ml-3" <?= $flagNovo ?> type="checkbox" id="statusNovo" name="statusNovo" value="NOVO" /> NOVO</label></li>
                            <li><input class="ml-3" <?= $flagParcial ?> type="checkbox" id="statusParcial" name="statusParcial" value="PARCIAL" /> PARCIAL</label></li>
                            <li><input class="ml-3" <?= $flagEnviado ?> type="checkbox" id="statusEnviado" name="statusEnviado" value="ENVIADO" /> ENVIADO</label></li>
                            <li><input class="ml-3" <?= $flagFinalizado ?> type="checkbox" id="statusFinalizado" name="statusFinalizado" value="FINALIZADO" /> FINALIZADO</label></li>
                            <li><input class="ml-3" <?= $flagCancelado ?> type="checkbox" id="statusCancelado" name="statusCancelado" value="CANCELADO" /> CANCELADO</label></li>
                        </ul>
                    </div>
                </td>
                <td>
                    <select id="medFiltro" name="med" class='form-select' aria-label='Default select example'>
                        <option disabled selected value="0">Med</option>
                        <?= $cboMed ?>
                    </select>
                </td>
                <td><input type="text" class='form-control' id="produto" name="produto" value="<?= $produto ?>"placeholder="Item do Pedido"></td>
            </tr>
        </tbody>
    </table>
</form>
<div class="table-responsive">
    <div class="tabela-ver-todos-os-cheques">
        <table data-tablesaw-sortable data-tablesaw-sortable-switch class='tablesaw table-sm table-hover  fs-6 mb-0' data-tablesaw-mode='columntoggle' data-tablesaw-minimap>
            <thead class='header-tabela'>
                <tr>
                    <th data-tablesaw-sortable-col data-tablesaw-priority='5'>ID</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority='1'>Filial</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority='5'>Dt Ped</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority='5'>Dt Fec</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority='1'>Obs</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority='1'>Itens Total</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority='1'>Itens Parcial</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority='1'>Status</th>
                </tr>
            </thead>
            <tbody>
            <?= $txtTable ?>
    </div>
</div>